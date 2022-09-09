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

    public function Check($pid, $getPost = false) // Check post's existence and ownership
    {
        $post = $this->postModel->find($pid);
        if ((empty($post)) or (session('id') != $post->post_fk_user))
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        if ($getPost)
        {
            return $post;
        }
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
        
        $this->postModel->save($dataToSave);
        return redirect()->to('/');
    }

    public function update($pid)
    {    
        $this->check($pid);
        $data = $this->request->getPost();
        $dataToSave =
        [
            "post_text" => $data["text"]
        ];

        $this->postModel->update($pid, $dataToSave);
        return redirect()->to('/');        
    }

    public function delete($pid)
    {
        $this->check($pid);
        $this->postModel->delete($pid);
        return redirect()->to('/');
    }

    public function updateForm($pid)
    {
        $post = $this->check($pid, $getPost = true);
        echo view('forms/form_edit_post', ['post' => $post]);
    }
}