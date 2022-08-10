<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\Notification; //ZEGY OTC
use App\Models\CommentModel; 
use App\Models\PostModel; //ZEGY OTC
use App\Models\UserModel; //ZEGY OTC
use CodeIgniter\I18n\Time;


class Comment extends BaseController
{
    function __construct() 
    {
        helper('form');
        $this->commentModel =  new CommentModel();          
    }
    
    public function show($pid = null, $uid) 
    {
        if (!$pid)
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        if(session('role') == 'mahasiswa') // AVOID MAHASISWA TO OPEN DOSEN'S POST
		{
            $userModel   = new UserModel();
            $poster      = $userModel->where(array('user_pk' => $uid))->first();
            $poster_role = $poster["user_role"];

            if ($poster_role == 'dosen')
            {
                throw new \CodeIgniter\Exceptions\PageNotFoundException();
            }
		}
        
        // $builder = $this->db->table('t_post p'); 
        // $builder->select('
        //                     p.post_pk as pid,
        //                     p.post_text as texto, 
        //                     p.post_date_time as data,
        //                     u.user_pk as uid,
        //                     u.user_full_name as nome,
        //                     u.user_profile_picture as image,
        //                     u.user_role as role
        //                 ');

        // $builder->join('t_user u ',
        //                'p.post_fk_user = u.user_pk');  
         
        // $builder->where("p.post_pk = $pid");  
        
        // $queryPost = $builder->get(); 

        //********************************************************************************************************         
     
        

        //*********************************************************************************************************
              
        $post     = $queryPost->getResult();
        $comments = $this->commentModel->getAllByPost($pid);
             
        return view('comments/comments',
        [
                'post'     => $post[0],
                'comments' => $comments
        ]);
    }

    public function save() //save or edit comment
    {
        $data   = $this->request->getPost();
        $myTime = new Time('now', 'America/Recife', 'pt_BR');
        
        if (isset($data["user_id"]) && session()->get('id') != $data["user_id"])
        {       
            return redirect()->to('/');
        }
          
        if (isset($data["com_id"]) && isset($data["text"])) // update comment
        {
            $dataToSave =
            [
                "comment_pk"    => $data["com_id"],
                "comment_text"  => $data["text"]
            ]; 
        }
        else if (isset($data["user_id"]) && isset($data["post_id"]) && isset($data["text"])) // new comment
        { 
            $dataToSave =
            [
                "comment_fk_user"   => $data["user_id"],
                "comment_fk_post"   => $data["post_id"],
                "comment_text"      => $data["text"],
                "comment_date_time" => ((array)$myTime)['date']
            ]; 
        }
        else
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $request = $this->commentModel->save($dataToSave);
        
        if ($request)
        {
            $fcm = new Notification();
            $sendNotif = $fcm->sendFCM($data); //FCM
            return redirect()->to('/comment/show/'. $data["post_id"]);
        }
        else
        {
            echo view('erro');
        }
    } 

    public function delete(int $cid = null, int $pid = null)
    {
        if (!$cid && !$pid)
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();       
        }
                      
        if ($this->commentModel->checkOwnership( $cid, session()->get('id') ))
        {
            if ($this->commentModel->delete($cid))
            {    
                return redirect()->to('/comment/show/' . $pid );
            }
            else
            {
                return redirect()->to('/');
            } 
        }
        else
        {
            return redirect()->to('/comment/show/' . $pid );
        }
    }

    public function edit($cid = null) 
    {
        if (!$cid)
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();      
        }
           
        $comment = $this->commentModel->where('comment_pk', (int)$cid)->first();
        
        if(session()->get('id') == $comment['comment_fk_user'])
        {
            echo view('/common/edit', [ 'comment' => $comment ] );     
        }
        else
        {
            return redirect()->to('/');     
        }
    }     
}  
