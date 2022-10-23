<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;

class Admin_tools extends BaseController
{
    function __construct()
    {
        $this->postModel = new PostModel();
    }

    public function saveBatchPublic()
    {
        $no = 1;
        do {
            $dataToSave =
            [
                "post_fk_user" => 3, // Mahasiswa
                "post_title"   => 'judul postingan  ' . $no,
                "post_text"    => 'detail postingan  ' . $no,
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
                "post_title"   => 'judul postingan  ' . $no,
                "post_text"    => 'detail postingan  ' . $no,
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