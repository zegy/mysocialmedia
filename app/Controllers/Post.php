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
        $this->postModel->insert($dataToSave); // In case using "save()", if it contain PK then it updates the existing record else it inserts it into the database (no need create "update" method)
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
        // return redirect()->to('/');
        // return redirect()->to('/home/home_private?page=4');
        return redirect()->back(); // ZEGY OTC FOCUS ON. it's working!

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

    // =================================== ZEGY DEVELOPMENT ONLY ===================================
    public function saveBatchPublic()
    {
        $no = 1;
        do {
            $dataToSave =
            [
                "post_fk_user" => 3, // Mahasiswa
                "post_text"    => $no,
                "post_type"    => 'public',
            ];
            $this->postModel->insert($dataToSave);
            $no++;
        }
        while ($no <= 10);
        return redirect()->to('/');
    }

    public function saveBatchPrivate()
    {
        $no = 1;
        do {
            $dataToSave =
            [
                "post_fk_user" => 2, // Dosen
                "post_text"    => $no,
                "post_type"    => 'private',
            ];
            $this->postModel->insert($dataToSave);
            $no++;
        }
        while ($no <= 10);
        return redirect()->to('/');
    }
}