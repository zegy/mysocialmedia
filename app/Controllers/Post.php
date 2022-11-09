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

    public function groupPosts($group)
    {
        $data = ["group" => $group];
        return view('post/group-posts', $data);
    }

    public function groupPostsList($group)
    {
        if ($this->request->isAJAX())
        {
            $page = $this->request->getVar('page');
            $posts = $this->postModel->getAllByGroup($group, $page);
            $pager = $this->postModel->pager;
            
            if (empty($posts))
            {
                echo json_encode(['status' => false]);
            }
            else
            {
                $data = [
                    "posts" => $posts,
                    "pager" => $pager,
                ];
                    
                echo json_encode([
                    'posts'  => view('post/group-posts-list', $data),
                    'status' => true
                ]);
            }
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function deletePostModal()
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

    public function deletePost()
    {
        $id = $this->request->getPost('id');
        $this->postModel->delete($id);
        echo json_encode(['status' => true]);
    }








    // public function get_add_post_modal() // From ci4-crud-ajax example (get_add_item_modal)
    // {
    //     if ($this->request->isAJAX())
    //     {
    //         $output = view('forms/add-post-form');
    //         echo json_encode($output);
    //     }
    //     else
    //     {
    //         throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    //     }
    // }







    
    public function groupPostDetail($group, $pid) //TODO : Use $group to limit the user who can see the post later
    {
        $post = $this->postModel->getOneById($pid);
        if (!empty($post))
        {
            $data = ["post" => $post];
            return view('post/group-post-detail', $data);
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
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