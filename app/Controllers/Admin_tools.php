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
            'group' => 'required',
            'user' => 'required',
            'count' => 'required',
        ];

        // $price = $this->request->getPost('price'); //NOTE For optional with validation
        // if ($price)
        // {
        //     $rules['price'] = 'numeric'; //NOTE Then add new rule if it exist
        // }

        if (!$this->validate($rules))
        {
            $errors =
            [
                'group' => $this->validation->getError('group'),
                // 'price' => $this->validation->getError('price'), //NOTE For "example"
                'user' => $this->validation->getError('user'),
                'count' => $this->validation->getError('count'),
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
            // $this->model->save([
            //     'group' => $this->request->getPost('group'),
            //     // 'price' => $price, //NOTE For "example"
            //     'user' => $this->request->getPost('user'),
            //     // 'detail' => $this->request->getPost('detail'), //NOTE For optional without validation
            // ]);
            // echo json_encode(['status' => TRUE]);


            $group = $this->request->getPost('group');
            $user = $this->request->getPost('user');
            $count = $this->request->getPost('count');
            
            for ($x = 0; $x < $count; $x++) {
            $data[$x] =
                [
                    'post_fk_user' => $user,
                    'post_title' => 'title',
                    'post_text' => 'text',
                    'post_type' => $group,
                ];
            };

            $this->postModel->insertBatch($data);

            echo json_encode(['status' => TRUE]);
        }
    }

    public function delete_all_posts()
    {
        $post = $this->postModel->emptyTable();
        return redirect()->back();
    }
}