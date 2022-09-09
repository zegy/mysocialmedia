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

    public function update()
    {
        $data = $this->request->getPost();
            
        if (session('id') != $data["user_id"])
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // Not owner
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

    public function delete($pid)
    {
        $post = $this->postModel->find($pid);

        if (empty($post))
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // NOT FOUND
        }

        if (session('id') != $post->post_fk_user)
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // NOT OWNER
        }
        
        $this->postModel->delete($pid);
        return redirect()->to('/');
    }

    public function updateForm($pid)
    {
        $post = $this->postModel->find($pid);

        if (!empty($post))
        {
            if (session('id') != $post->post_fk_user)
            {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // Not owner
            }
            else
            {
                echo view('forms/form_edit_post', ['post' => $post]);
            }
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // Post not found
        }
    }
}