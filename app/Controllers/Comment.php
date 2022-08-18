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
    
    public function show($un, $pid)
    {
        $poster = $this->userModel->where('user_name', $un)->first();
        if(!empty($poster))
        {
            $post = array('post_pk' => $pid, 'post_fk_user' => $poster['user_pk']);
            $postData = $this->postModel->where($post)->first();
            if(!empty($postData))
            {
                if(session('role') == 'mahasiswa')
                {
                    if($postData['post_type'] == 'private') // avoid mahasiswa to open private posts
                    {
                        return redirect()->to('/'); // ZEGY OTC 404 DOSEN'S PRIVATE POST
                    }
                }   
            }
            else
            {
                return redirect()->to('/'); // ZEGY OTC 404 POST NOT FOUND
            }
        }
        else
        {
            return redirect()->to('/'); // ZEGY OTC 404 USERNAME NOT FOUND
        }
            
        $post = $this->postModel->getSpecificPost($pid);
        $comments = $this->commentModel->getAllByPost($pid);
             
        return view('comments',
        [
            'post'     => $post[0], // ZEGY OTC WHY?
            'comments' => $comments
        ]);
    }

    public function save() // save or edit comment
    {
        $data = $this->request->getPost();
        $currentTime = new Time('now', 'America/Recife', 'pt_BR');

        if ($data["save_type"] == "new_com")
        {
            if (!empty($data["text"]))
            {
                $dataToSave =
                [
                    "comment_fk_user"   => session()->get('id'),
                    "comment_fk_post"   => $data["post_id"],
                    "comment_text"      => $data["text"],
                    "comment_date_time" => ((array)$currentTime)['date']
                ];
            }
            else
            {
                return redirect()->to('/'); // ZEGY OTC 404 COMMENT IS EMPTY (RELATED TO "REQUIRED" VIEW)
            } 
        }

        if ($data["save_type"] == "edit_com")
        {
            if ($data["com_user_id"] == session()->get('id'))
            {
                if (!empty($data["text"]))
                {
                    $dataToSave =
                    [
                        "comment_pk"    => $data["com_id"], // ZEGY OTC : CI tau method "save" update otomatos berdasarkan PK?
                        "comment_text"  => $data["text"]
                    ];
                }
                else
                {
                    return redirect()->to('/'); // ZEGY OTC 404 COMMENT IS EMPTY (RELATED TO "REQUIRED" VIEW)
                }
            }
        }

        $request = $this->commentModel->save($dataToSave);
        
        // if ($request)
        // {
        //     $fcm = new Notification();
        //     $sendNotif = $fcm->sendFCM($data); //FCM
        //     return redirect()->to('/comment/show/'. $data["post_id"]);
        // }
        // else
        // {
        //     // ZEGY OTC ERROR
        // }
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

    public function edit($cid) 
    {   
        $comment = $this->commentModel->where('comment_pk', $cid)->first();
        
        if(session()->get('id') == $comment['comment_fk_user'])
        {
            echo view('/comments/edit', ['comment' => $comment]);     
        }
        else
        {
            return redirect()->to('/');    
        }
    }     
}  
