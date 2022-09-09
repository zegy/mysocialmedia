<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;
use CodeIgniter\I18n\Time;

class Post extends BaseController
{
    function __construct()
    {
        helper('form');
        $this->postModel = new PostModel();
    }

    public function save()
    {
        $data = $this->request->getPost();
        
        if (empty($data['text'])) // Check if text is empty (related to view : input's "required")
        {
            session()->setFlashData('message','TEXT IS EMPTY!');
            return view('custom_error');
        }
        else
        {
            $dataToSave =
            [
                "post_fk_user" => session('id'),
                "post_text"    => $data["text"],
                "post_type"    => $data['type']
            ];
            
            $request = $this->postModel->save($dataToSave);
            
            if ($request)
            {
                return redirect()->to('/');
            }
        }
    }

    public function update()
    {
        $data = $this->request->getPost();
        
        if (empty($data['text'])) // Check if text is empty (related to view : input's "required")
        {
            session()->setFlashData('message','TEXT IS EMPTY!');
            return view('custom_error');
        }
        else
        {
            if (session('id') != $data["user_id"])
            {
                session()->setFlashData('message','NOT OWNER!');
                return view('custom_error');
            }
            else
            {
                $dataToSave =
                [
                    "post_text" => $data["text"]
                ];

                $request = $this->postModel->update($data["post_id"], $dataToSave);
                
                if ($request)
                {
                    return redirect()->to('/');
                }
            }
        }        
    }

    public function delete($pid)
    {
        $post = $this->postModel->find($pid);

        if (!empty($post))
        {
            if (session('id') == $post->post_fk_user)
            {
                $this->postModel->delete($pid);
                return redirect()->to('/');
            }
            else
            {
                return redirect()->to('/'); // ZEGY OTC INVALID OWNER
            }
        }
        else
        {
            return redirect()->to('/'); // ZEGY OTC 404 POST NOT FOUND
        }
    }

    public function updateForm($pid)
    {
        $post = $this->postModel->find($pid);

        if (!empty($post))
        {
            if (session('id') == $post->post_fk_user)
            {
                echo view('forms/form_edit_post', ['post' => $post]);
            }
            else
            {
                return redirect()->to('/'); // ZEGY OTC INVALID OWNER
            }
        }
        else
        {
            return redirect()->to('/'); // ZEGY OTC 404 POST NOT FOUND
        }
    }
}