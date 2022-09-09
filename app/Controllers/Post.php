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

    public function update($pid)
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
        
        $data = $this->request->getPost(); // Get text input
        $dataToSave =
        [
            "post_text" => $data["text"]
        ];

        $this->postModel->update($pid, $dataToSave);
        return redirect()->to('/');        
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

        if (empty($post))
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // NOT FOUND
        }

        if (session('id') != $post->post_fk_user)
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // NOT OWNER
        }
        
        echo view('forms/form_edit_post', ['post' => $post]);
    }
}