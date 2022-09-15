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

    protected function checkOwnership($pid)
    {
        $post = $this->postModel->find($pid);
        
        if ((empty($post)) or (session('id') != $post->post_fk_user))
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        else
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
        $this->postModel->insert($dataToSave); // In case using "save()", if it contain PK then it update the existing record or else it insert into the database (no need to create "update" method)
        return redirect()->to('/');
    }

    public function update($pid)
    {   
        $data = $this->request->getPost();
        $postData = $this->checkOwnership($pid);

        if (empty($data)) // Show update form (single route, updateForm() is removed)
        {
            echo view('forms/form_edit_post', ['post' => $postData]);
        }
        else
        {
            $dataToSave =
            [
                "post_text" => $data["text"]
            ];
            $this->postModel->update($pid, $dataToSave);        
            session()->setFlashdata('curPageHome', session()->getFlashdata('curPage')); // Used in home controller
            return redirect()->to('/');
        }                
    }

    public function delete($pid)
    {
        $this->checkOwnership($pid);
        $this->postModel->delete($pid);
        if (session()->getFlashdata('curCon') == 'search')
        {
            return redirect()->back();
        }
        else
        {
            return redirect()->to('/');
        }
    }






















    // public function updateForm($pid)
    // {
    //     session()->keepFlashdata('curPage'); // preserve flashdata from "home" to "update" method.
    //     $postData = $this->checkOwnership($pid);
    //     echo view('forms/form_edit_post', ['post' => $postData]);
    // }

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
        while ($no <= 15);
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
        while ($no <= 15);
        return redirect()->to('/');
    }

    public function deleteBatchPublic()
    {
        $post = $this->postModel->where('post_type', 'public')->findAll();        
        foreach ($post as $row) {
            $this->postModel->delete($row->post_pk);
        }
        return redirect()->to('/');
    }

    public function deleteBatchPrivate()
    {
        $post = $this->postModel->where('post_type', 'private')->findAll();        
        foreach ($post as $row) {
            $this->postModel->delete($row->post_pk);
        }
        return redirect()->to('/');
    }
}