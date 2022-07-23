<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\PostModel;
use App\Models\NotificationModel;
use CodeIgniter\I18n\Time;


class Comment extends BaseController
{
    function __construct() 
    {
        helper('form');
        $this->db = \Config\Database::connect();
        $this->session = session();       
        $this->commentModel =  new CommentModel();          
    }
    
    public function show($pid = null) 
    {
        if (!$pid) {          
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Link inexistente");
        }
        
        $builder = $this->db->table('t_post p'); 
        $builder->select('p.post_pk as pid, p.post_text as texto, 
                        p.post_date_time as data, u.user_pk  as uid, 
                        u.user_full_name   as nome, 
                        u.user_profile_picture    as image');

        $builder->join('t_user u ', 'p.post_fk_user = u.user_pk');  
        $builder->where("p.post_pk = $pid");  
        
        $queryPost = $builder->get(); 

        //*******************************************************************************************************         
     
        $builder = $this->db->table('t_comment c');
        $builder->select('c.comment_pk  as cid,   
                        c.comment_text   as texto,
                        c.comment_date_time as data,
                        u.user_pk  as uid,
                        u.user_full_name   as nome,
                        u.user_profile_picture    as image, 
                        (select count(*) from t_like l2
                        where l2.like_fk_comment = c.comment_pk) as qtdlike');

        $builder->join('t_post p', 'p.post_pk = c.comment_fk_post');
        $builder->join('t_user u', 'c.comment_fk_user = u.user_pk');
        $builder->where("p.post_pk = $pid");

        $queryComments = $builder->get();

        //*********************************************************************************************************
              
        $post     = $queryPost->getResult();
        $comments = $queryComments->getResult();
             
        return view('comments/comments' ,  [ 'post'     => $post[0],
                                             'comments' => $comments]);
    }

    public function save() //save or edit comment
    {
        $data   = $this->request->getPost();
        $myTime = new Time('now', 'America/Recife', 'pt_BR');
        
        if (isset($data["user_id"]) && session()->get('id') != $data["user_id"]) {       
            return redirect()->to('/');
        }
          
        if (isset($data["com_id"]) && isset($data["text"])) { // update comment
            $dataToSave = [ "comment_pk"  => $data["com_id"],
                              "comment_text"   => $data["text"] ]; 
            
        } else if (isset($data["user_id"]) && isset($data["post_id"]) && isset($data["text"])) { // new comment
            
            $dataToSave = [ "comment_fk_user" => $data["user_id"],
                            "comment_fk_post" => $data["post_id"],
                            "comment_text"   => $data["text"],
                            "comment_date_time" =>  ((array)$myTime)['date'] ]; 

        } else {
            
             throw new \CodeIgniter\Exceptions\PageNotFoundException("Dados de formulario inconsistentes");

        }

        $request = $this->commentModel->save($dataToSave);
        
          if ($request) {

                $post = new PostModel();
                $poster = $post->where(array('post_pk' => $data["post_id"]))->first();
                $poster_id = $poster["post_fk_user"];



                
                $sendFCM = new NotificationModel();
                $user = $sendFCM->where(array('user_pk' => $poster_id))->first();
                $user_token = $user["user_token"];
                
                //return json_encode($user_token);
                
                $headers = [
                    'Authorization: key=AAAA6TW0j0o:APA91bFErAe4EPZ5qLRRlksCSJxqsz6P6c-TxJRghGWGgOZxSOsNelKVhKrJvsYTRX0TzaioS1OH7jiFuIgNIlhx_auLCbNsozL6HUqxMt8fFdfIGeeE-2KEl0lFhUNAdTSyZhNOeb1w',
                    'Content-Type: application/json'
                ];
                
                $title = 'Judul';
                $body = 'Isi';
                
                
                $notification = [
                    'title' => $title,
                    'body' => $body,
                    
                ];
                $request = [
                    'data' => $notification,
                    'registration_ids' => $user_token
                ];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));

                $res = curl_exec($ch);

                curl_close($ch);
                return '1';
                

         
               //return redirect()->to('/comment/show/'. $data["post_id"]);
 
        } else {

            echo view('erro');

        }

    } 

    public function delete(int $cid = null, int $pid = null)
    {
        if (!$cid && !$pid) {
               throw new \CodeIgniter\Exceptions\PageNotFoundException("Link inexistente");       
        }
                      
        if ($this->commentModel->checkOwnership( $cid, session()->get('id') )){
            if ($this->commentModel->delete($cid)) {
                
                return redirect()->to('/comment/show/' . $pid );
          
            } else {
            
                return redirect()->to('/');
            
            } 
          
        }  else {
      
            return redirect()->to('/comment/show/' . $pid );
      
        }
    }

    public function edit($cid = null) 
    {
        if (!$cid) {
        
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Link inexistente");
               
        }
           
        $comment = $this->commentModel->where('comment_pk', (int)$cid)->first();
            if(session()->get('id') == $comment['comment_fk_user']) {
                 
                 echo view('/common/edit', [ 'comment' => $comment ] );
                 
            } else {
                 
                 return redirect()->to('/');
                 
            }
    }
    
    public function like($cid, $uid) 
    {
        
        // check total amount of like for this comment
        // check total amount of user like for this comment
        // if user has 1 or more likes for this comment then returns the total amount of likes for the comment
        // otherwise insert a like from this user in this comment and send the updated amount of likes as a response
        // amount of user likes in the comment
        if (!$cid && !$uid) {
               
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Link inexistente");
               
        }
           
        if($uid != session()->get('id')) { 
               
            $qtdlikeCom = $this->commentModel->getLikesCom($cid);

            echo $qtdlikeCom;

            return;
                 
        } else {

            $qtdlikeCom = $this->commentModel->like($cid, $uid);

            echo $qtdlikeCom; 
              
        }       
    }      
}  
