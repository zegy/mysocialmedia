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

    public function show($group)
    {
        return view('posts',
        [
            "posts" => $this->postModel->getAllByType($group),
            "pager" => $this->postModel->pager,
        ]);
    }

    // public function privatePosts()
    // {
    //     return view('posts',
    //     [
    //         "posts" => $this->postModel->getAllByType('private'),
    //         "pager" => $this->postModel->pager,
    //         "type"  => "dosen"
    //     ]);
    // }

    public function create()
    {
        $data = $this->request->getPost(); //GET title, text, type
        $dataToSave =
        [
            "post_fk_user" => session('id'),
            "post_title"   => $data['post_title'],
            "post_text"    => $data["post_text"],
            "post_type"    => $data['post_type']
        ];
        $this->postModel->insert($dataToSave); //NOTE In case using "save()", if it contain PK then it update the existing record or else it insert into the database (no need to create "update" method)
        return redirect()->back();
    }

    public function update()
    {   
        $data = $this->request->getPost(); //GET pid, text
        $dataToSave =
        [
            "post_text" => $data["text"]
        ];
        $this->postModel->update($data["pid"], $dataToSave);        
        return redirect()->back();
    }

    public function delete()
    {
        $data = $this->request->getPost(); //GET pid
        $this->postModel->delete($data["pid"]);
        return redirect()->back();
    }






















    

    // =================================== ZEGY DEVELOPMENT ONLY ===================================
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