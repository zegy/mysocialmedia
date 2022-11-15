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
        $validated = $this->validate([
            'judul'     => ['required'],
            'deskripsi' => ['required'],
            'files'     => [
                'uploaded[files]',
                'mime_in[files,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[files,4096]',
            ]
        ]);

        if (!$validated) {
            $errors = [ //NOTE : "getErrors()" did not return input field that "valid", hence the "Getting a Single Error" used instead.
                'judul'     => $this->validation->getError('judul'),
                'deskripsi' => $this->validation->getError('deskripsi'),
                'files'     => $this->validation->getError('files')
            ];

            $output = [
                'errors' => $errors,
                'status' => FALSE
            ];

            echo json_encode($output);
        }
        else
        {
            $files = $this->request->getFileMultiple('files');
            foreach($files as $file) {
                if($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('uploads', $newName); //TODO
                }           
            }

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