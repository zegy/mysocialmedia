<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;

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
        $this->postModel->save($dataToSave);
        return redirect()->to('/');
    }

    public function update($pid)
    {    
        $post = $this->postModel->find($pid);
        if ((empty($post)) or (session('id') != $post->post_fk_user))
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

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
        $post = $this->postModel->find($pid);
        if ((empty($post)) or (session('id') != $post->post_fk_user))
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->postModel->delete($pid);
        return redirect()->to('/');
    }

    public function updateForm($pid)
    {
        $post = $this->postModel->find($pid);
        if ((empty($post)) or (session('id') != $post->post_fk_user))
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        echo view('forms/form_edit_post', ['post' => $post]);
    }

    // ZEGY OTC IF C CALL C (NOT DIRECT FROM UNMATCHED MODEL)
    // public function getAllByType($type)
    // {
    //     return $this->postModel->getAllByType($type);
    // }

    // public function getAllByKeyword($keyword)
    // {
    //     return $this->postModel->getAllByKeyword($keyword);
    // }

    // public function getAllByUser($user)
    // {
    //     return $this->postModel->getAllByUser($user);
    // }
}