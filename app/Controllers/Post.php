<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;
use App\Models\CommentModel; //TODO TEMP!

class Post extends BaseController
{
    function __construct()
    {
        helper('form');
        $this->postModel = new PostModel();
        $this->commentModel = new CommentModel(); //TODO TEMP!
    }

    public function showAll($group)
    {
        if ($this->request->isAJAX())
        {
            $data = [
              "posts" => $this->postModel->getAllByType($group),
              "pager" => $this->postModel->pager,
            ];
            $output = view('posts_table', $data);
            echo json_encode($output);
        }
        else
        {
            $data = ["group" => $group];
            return view('posts', $data);
        }
    }

    public function get_add_post_modal() // From ci4-crud-ajax example (get_add_item_modal)
    {
        if ($this->request->isAJAX())
        {
            $output = view('forms/add-post-form');
            echo json_encode($output);
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function get_delete_post_modal()
    {
        if ($this->request->isAJAX())
        {
            $id = $this->request->getVar('id');
            $data['item'] = ['id' => $id];

            $output = view('forms/delete-post-form', $data);
            echo json_encode($output);
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function delete_post()
    {
        $id = $this->request->getPost('id');
        $this->postModel->delete($id);
        echo json_encode(['status' => TRUE]);
    }














    
    public function detail($group, $pid) //TODO use $group
    {
        $post = $this->postModel->getOneById($pid);
        if (!empty($post))
        {
            return view('comments',
            [
                'post'     => $post,
                'comments' => $this->commentModel->getAllByPost($pid)
            ]);
        }
        else
        {
            return redirect()->to('/'); // ZEGY OTC 404 POST NOT FOUND
        }
    }

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
}