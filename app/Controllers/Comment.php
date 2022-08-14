<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\Notification; //ZEGY OTC
use App\Models\CommentModel; 
use App\Models\PostModel;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;


class Comment extends BaseController
{
    function __construct() 
    {
        helper('form');
        $this->userModel    = new UserModel();       
        $this->postModel    = new PostModel();
        $this->commentModel = new CommentModel();
    }
    
    public function show($pid, $uid) 
    {
        if(session('role') == 'mahasiswa') // AVOID MAHASISWA TO OPEN DOSEN'S POST
		{
           if($this->postModel->isDosenPost($uid))
           {
                throw new \CodeIgniter\Exceptions\PageNotFoundException();
           }
		}
              
        $post     = $this->postModel->getSpecificPost($pid);
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
