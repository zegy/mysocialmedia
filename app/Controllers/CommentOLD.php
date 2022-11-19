<?php

namespace App\Controllers;

use App\Controllers\BaseController;
// use App\Controllers\Notification; //NOTE Needed soon
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

    public function save() //TODO save or edit comment. Okd format, sync with post controller after using javascript
    {
        $data = $this->request->getPost();

        if ($data["save_type"] == "new_com")
        {
            if (!empty($data["text"]))
            {
                $dataToSave =
                [
                    "comment_fk_user"   => session('id'),
                    "comment_fk_post"   => $data["post_id"],
                    "comment_text"      => $data["text"],
                ];
            }
            else
            {
                return redirect()->to('/'); // ZEGY OTC 404 COMMENT IS EMPTY (RELATED TO "REQUIRED" VIEW)
            }
        }

        if ($data["save_type"] == "edit_com")
        {
            if ($data["com_user_id"] == session('id'))
            {
                if (!empty($data["text"]))
                {
                    $dataToSave =
                    [
                        "comment_pk"   => $data["com_id"], // ZEGY OTC : CI tau method "save" update otomatos berdasarkan PK?
                        "comment_text" => $data["text"]
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

        return redirect()->to('/comment/show/'. $data["post_id"]); // ZEGY DANGER SEMENTARA!

    }

    public function delete($cid)
    {
        $comment = $this->commentModel->find($cid);
        
        if (!empty($comment))
        {
            if (session('id') == $comment->comment_fk_user)
            {
                $this->commentModel->delete($cid);
                return redirect()->back();
            }
            else
            {
                return redirect()->to('/'); // ZEGY OTC INVALID OWNER
            }
        }
    }

    public function edit($cid)
    {
        $comment = $this->commentModel->find($cid);

        if (!empty($comment))
        {
            if (session('id') == $comment->comment_fk_user)
            {
                echo view('forms/form_edit_comment', ['comment' => $comment]); // ZEGY OTC IT WILL USE "SAVE() COMMENT" LATER
            }
            else
            {
                return redirect()->to('/'); // ZEGY OTC INVALID OWNER
            }   
        }
        else
        {
            return redirect()->to('/'); // ZEGY OTC 404 COMMENT NOT FOUND
        }
    }
}