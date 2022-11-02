<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;

class Admin_tools extends BaseController
{
    function __construct()
    {
        helper('form');
        $this->postModel = new PostModel();
    }

    public function get_add_posts_modal() // From ci4-crud-ajax example (get_add_item_modal)
    {
        if ($this->request->isAJAX())
        {
            $output = view('dev/add-form');
            echo json_encode($output);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function create_posts() // From ci4-crud-ajax example (save_item)
    {
        $rules =
        [
            'name' => 'required',
            'category' => 'required',
        ];

        $price = $this->request->getPost('price');
        if ($price)
        {
            $rules['price'] = 'numeric';
        }

        if (!$this->validate($rules))
        {
            $errors =
            [
                'name' => $this->validation->getError('name'),
                'price' => $this->validation->getError('price'),
                'category' => $this->validation->getError('category'),
            ];

            $output =
            [
                'status' => FALSE,
                'errors' => $errors
            ];

            echo json_encode($output);
        }
        else
        {
            $this->model->save([
                'name' => $this->request->getPost('name'),
                'price' => $price,
                'category' => $this->request->getPost('category'),
                'detail' => $this->request->getPost('detail'),
            ]);
            echo json_encode(['status' => TRUE]);
        }
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

    public function deleteBatchPublic()
    {
        $post = $this->postModel->where('post_type', 'public')->findAll();        
        foreach ($post as $row) {
            $this->postModel->delete($row->post_pk);
        }
        return redirect()->to('/');
    }
}