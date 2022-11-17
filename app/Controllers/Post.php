<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;

class Post extends BaseController
{
    function __construct()
    {
        $this->postModel = new PostModel();
    }

    public function index($group)
    {
        return view('post/post_index', ["group" => $group]);
    }

    public function list() //NOTE : AJAX
    {
        if ($this->request->isAJAX())
        {
            $page  = $this->request->getPost('page'); //NOTE : Optional, can be null
            $group = $this->request->getPost('group');
            $posts = $this->postModel->getAllByGroup($group, $page);
            $pager = $this->postModel->pager;
            
            if (!empty($posts))
            {
                $dataView = [
                    "posts" => $posts,
                    "pager" => $pager,
                ];
                    
                echo json_encode([
                    'posts'  => view('post/post_list', $dataView),
                    'status' => true
                ]);
            }
            else
            {
                echo json_encode(['status' => false]);
            }
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function delete() //NOTE : AJAX
    {
        if ($this->request->isAJAX())
        {
            $pid   = $this->request->getPost('pid');
            $files = $this->request->getPost('files');

            if (!empty($files))
            { 
                $imgs = explode(",", $files);
                foreach ($imgs as $img)
                {
                    unlink(WRITEPATH . 'uploads/posts/' . $img);
                }
            }
            
            $this->postModel->delete($pid);
            echo json_encode(['status' => true]);
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function detail($group, $pid)
    {
        //TODO : Use $group to limit the user who can see the post later
        $post = $this->postModel->getOneById($pid);
        if (!empty($post))
        {
            return view('post/post_detail', ["post" => $post]);
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function save () //NOTE : Single create + update function
    {    
        $validated = $this->validate([
            'judul'     => ['required'],
            'deskripsi' => ['required'],
            'files'     => [ //TODO : set max 5! Problem with file names in SQL
                'mime_in[files,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[files,4096]',
            ]
        ]);

        if (!$validated)
        {
            $errors = [ //NOTE : "getErrors()" did not return input field that "valid", hence the "Getting a Single Error" used instead.
                'judul'     => $this->validation->getError('judul'),
                'deskripsi' => $this->validation->getError('deskripsi'),
                'files'     => $this->validation->getError('files') //TODO (pending) : individual "error" for each file
            ];

            $output = [
                'errors' => $errors,
                'status' => FALSE
            ];

            echo json_encode($output);
        }
        else
        {
            $data = null; //TODO : need this?
            $type = $this->request->getPost('type'); //NOTE : To decide it's New / Edit post
            if ($type == 'add') //NOTE : TYPE = ADD
            {
                $files = $this->request->getFileMultiple('files');
                $count = 0;
                $fileNames[] = null; //NOTE (pending) : empty($files) is not working for file input to be optional. Solved (weirdly) by give "$fileNamesString" no value to begin with.
                foreach($files as $file)
                {
                    if($file->isValid() && !$file->hasMoved())
                    {
                        $name = $file->getRandomName();
                        $fileNames[$count] = $name; 
                        $file->move(WRITEPATH . 'uploads/posts', $name);
                        $count++;
                    }           
                }

                $fileNamesString = implode(",", $fileNames); 

                $data = [
                    "post_fk_user" => session('id'),
                    "post_title"   => $this->request->getPost('judul'),
                    "post_text"    => $this->request->getPost('deskripsi'),
                    "post_type"    => $this->request->getPost('group'),
                    "post_img"     => $fileNamesString
                ];
            }
            else //NOTE : TYPE = EDIT
            {
                $pid = $this->request->getPost('pid'); //NOTE : Need for "pid_redirect"

                $data = [
                    "post_pk"      => $pid,
                    "post_fk_user" => session('id'),
                    "post_title"   => $this->request->getPost('judul'),
                    "post_text"    => $this->request->getPost('deskripsi'),
                    "post_type"    => $this->request->getPost('group'),
                ];
                
                $check_replace_files = $this->request->getPost('exampleCheck1');
                if ($check_replace_files == true)
                {
                    $old_files = $this->request->getPost('old_files'); //NOTE : String    
                    if (!empty($old_files))
                    {
                        $old_files_deletes = explode(",", $old_files);
                        foreach ($old_files_deletes as $old_files_delete)
                        {
                            unlink(WRITEPATH . 'uploads/posts/' . $old_files_delete);
                        }
                    }
                    
                    $files = $this->request->getFileMultiple('files');
                    $count = 0;
                    $fileNames[] = null; //NOTE (pending) : empty($files) is not working for file input to be optional. Solved (weirdly) by give "$fileNamesString" no value to begin with.
                    foreach($files as $file)
                    {
                        if($file->isValid() && !$file->hasMoved())
                        {
                            $name = $file->getRandomName();
                            $fileNames[$count] = $name; 
                            $file->move(WRITEPATH . 'uploads/posts', $name);
                            $count++;
                        }           
                    }
                    $fileNamesString = implode(",", $fileNames); 
                
                    $data["post_img"] = $fileNamesString;
                }
            }
            
            $this->postModel->save($data);
            $pid_redirect = $pid ?? $this->postModel->insertID(); //NOTE : Get id from the last insert/save (if new post). TODO : What if other user do the insert/save?

            echo json_encode([
                'group'  => $this->request->getPost('group'),
                'pid'    => $pid_redirect,
                'status' => TRUE
            ]);
        }
    }
}