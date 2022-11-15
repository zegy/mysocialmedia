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

    public function index($group)
    {
        $data = ["group" => $group];
        return view('post/post_index', $data);
    }

    public function list()
    {
        if ($this->request->isAJAX())
        {
            $page = $this->request->getVar('page');
            $group = $this->request->getVar('group');
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
                    'posts'  => view('post/post_list', $data),
                    'status' => true
                ]);
            }
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function delete()
    {
        $pid = $this->request->getPost('pid');
        $this->postModel->delete($pid);
        echo json_encode(['status' => true]);
    }

    public function detail($group, $pid) //TODO : Use $group to limit the user who can see the post later
    {
        $post = $this->postModel->getOneById($pid);
        if (!empty($post))
        {
            $data = ["post" => $post];
            return view('post/post_detail', $data);
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function create()
    {
        $test = null; //TODO : TEMP ONLY!
        
        // ==================================== NOTE : FIXED ====================================

        $data = [
            'judul'     => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'files1'    => $this->request->getFile('files1'),
            'files2'    => $this->request->getFile('files2'),
            'files3'    => $this->request->getFile('files3'),
            'files4'    => $this->request->getFile('files4'),
        ];

        $rule = [
            'judul'     => 'required',
            'deskripsi' => 'required',
            'files1'    => 'uploaded[files1]|max_size[files1,1024]',
            'files2'    => 'uploaded[files2]|max_size[files2,1024]',
            'files3'    => 'uploaded[files3]|max_size[files3,1024]',
            'files4'    => 'uploaded[files4]|max_size[files4,1024]',
        ];

        if (!$this->validateData($data, $rule)) {
            $errors = //NOTE : "getErrors()" did not return input field that "valid", hence the "Getting a Single Error" used instead.
            [
                'judul' => $this->validation->getError('judul'),
                'deskripsi' => $this->validation->getError('deskripsi'),
                'files1' => $this->validation->getError('files1'),
                'files2' => $this->validation->getError('files2'),
                'files3' => $this->validation->getError('files3'),
                'files4' => $this->validation->getError('files4'),
            ];

            $output =
            [
                'test'   => $test, //TODO : TEMP ONLY!
                'errors' => $errors,
                'status' => FALSE
            ];

            echo json_encode($output);
        }
        else
        {
            $this->postModel->save([
                "post_fk_user" => session('id'),
                "post_title"   => $this->request->getPost('judul'),
                "post_text"    => $this->request->getPost('deskripsi'),
                "post_type"    => $this->request->getPost('group')
            ]);

            echo json_encode([
                'group'  => $this->request->getPost('group'),
                'pid'    => $this->postModel->insertID(), //NOTE : Get id from the last insert/save. TODO : What if other user do the insert/save?
                'status' => TRUE
            ]);
        }
    }
 




















    
    // public function create()
    // {
    //     $data = $this->request->getPost(); //GET title, text, type
    //     $dataToSave =
    //     [
    //         "post_fk_user" => session('id'),
    //         "post_title"   => $data['post_title'],
    //         "post_text"    => $data["post_text"],
    //         "post_type"    => $data['post_type']
    //     ];
    //     $this->postModel->insert($dataToSave); //NOTE In case using "save()", if it contain PK then it update the existing record or else it insert into the database (no need to create "update" method)
    //     return redirect()->back();
    // }

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

    // public function delete()
    // {
    //     $data = $this->request->getPost(); //GET pid
    //     $this->postModel->delete($data["pid"]);
    //     return redirect()->back();
    // }
}