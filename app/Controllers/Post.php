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
        if ($group == 'umum') {
            return view('post/post_index', ['group' => 'umum']);
        }
        else if ($group == 'dosen' && session('role') != 'mahasiswa') {
            return view('post/post_index', ['group' => 'dosen']);
        }
        else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }
    }

    public function list_default() // AJAX
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }

        $page  = $this->request->getPost('page'); // Optional, can be null
        $group = $this->request->getPost('group');
        $posts = $this->postModel->getAllByGroup($group, $page);
        $pager = $this->postModel->pager;

        if (!empty($posts)) {
            $dataView = [
                'posts' => $posts,
                'group' => $group,
                'pager' => $pager,
            ];
                
            echo json_encode([
                'status' => true,
                'posts'  => view('post/post_list', $dataView)
            ]);
        }
        else {
            echo json_encode([
                'status' => false,
            ]);
        }
    }

    public function list_search() // AJAX
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }

        $keyword = $this->request->getPost('keyword');
        $page    = $this->request->getPost('page'); // Optional, can be null
        $group   = $this->request->getPost('group');
        $posts   = $this->postModel->getAllByGroupAndKeyword($keyword, $group, $page);
        $pager   = $this->postModel->pager;

        if (!empty($posts)) {
            $dataView = [
                'posts' => $posts,
                'pager' => $pager,
            ];
                
            echo json_encode([
                'status' => true,
                'posts'  => view('post/post_list', $dataView)
            ]);
        }
        else {
            echo json_encode([
                'status' => false,
            ]);
        }
    }
        
    public function list_from_user() // AJAX. No pagination!
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }
        
        $user = $this->request->getPost('user');

        if (session('role') == 'mahasiswa') {
            $posts = $this->postModel->getUmumByUser($user);
        }
        else {
            $posts = $this->postModel->getAllByUser($user);
        }
        
        if (!empty($posts)) {
            echo json_encode([
                'status' => true,
                'posts'  => view('post/post_list_from_user', ['posts' => $posts])
            ]);
        }
        else {
            echo json_encode(['status' => false]);
        }
    }

    public function create() // AJAX
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }

        $rules = [
            'judul'     => ['required'],
            'deskripsi' => ['required'],
            'images'    => [ //TODO : set max 5! Problem with image names in SQL
                'mime_in[images,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[images,4096]'
            ]
        ];

        if (!$this->validate($rules)) {
            foreach ($rules as $key => $value) {
                $errors[$key] = $this->validation->getError($key);
            }

            $output = [
                'status' => false,
                'errors' => $errors
            ];
        }
        else {
            $data = [
                'post_fk_user' => session('id'),
                'post_title'   => $this->request->getPost('judul'),
                'post_text'    => $this->request->getPost('deskripsi'),
                'post_group'   => $this->request->getPost('group')
            ];

            $images = $this->request->getFileMultiple('images');
            
            if (file_exists($images[0])) {
                $imageNames = $this->save_post_images($images); // Save images
                $data['post_img'] = implode(',', $imageNames);
            }

            $this->postModel->save($data);

            $output = [
                'status' => true,
                'group'  => $this->request->getPost('group'),
                'pid'    => $this->postModel->insertID() // Get ID from the last insert. TODO : What if other user do the insert?
            ];
        }
        echo json_encode($output);
    }

    public function update() // AJAX
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }

        $rules = [
            'judul'     => ['required'],
            'deskripsi' => ['required'],
            'images'    => [ //TODO : set max 5! Problem with image names in SQL
                'mime_in[images,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[images,4096]'
            ]
        ];

        if (!$this->validate($rules)) {
            foreach ($rules as $key => $value) {
                $errors[$key] = $this->validation->getError($key);
            }

            $output = [
                'status' => false,
                'errors' => $errors
            ];
        }
        else {
            $pid = $this->request->getPost('pid');
            $post = $this->postModel->find($pid);

            if ($post->post_fk_user != session('id') && session('role') != 'admin') {
                $output = ['status' => false];
            }
            else {
                $data = [
                    'post_pk'      => $pid,
                    'post_title'   => $this->request->getPost('judul'),
                    'post_text'    => $this->request->getPost('deskripsi')
                ];
                
                $isUpdateImg = $this->request->getPost('cb_update_image');
    
                if ($isUpdateImg == true) {    
                    $old_images = $this->request->getPost('old_images');
    
                    if (!empty($old_images)) {
                        $images = explode(',', $old_images);
                        $this->delete_post_images($images); // Remove images
                    }
                    
                    $images = $this->request->getFileMultiple('images');
                    
                    if (file_exists($images[0])) {
                        $imageNames = $this->save_post_images($images); // Save images
                        $imageNames_string = implode(',', $imageNames);
                    }
                    
                    $data['post_img'] = $imageNames_string ?? null;   
                
                    $output = [
                        'images_change' => true,
                        'images' => $imageNames ?? null
                    ];
                }
                
                $output['status'] = true;
    
                $this->postModel->save($data);
            }
        } 
        echo json_encode($output);
    }

    public function delete() // AJAX
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }
        
        $pid  = $this->request->getPost('pid');
        $post = $this->postModel->find($pid);

        if ($post->post_fk_user != session('id') && session('role') != 'admin') {
            echo json_encode(['status' => false]);
        }
        else {
            if (!empty($post->post_img)) {
                $images = explode(',', $post->post_img);
                $this->delete_post_images($images); // Remove images
            }
            
            $this->postModel->delete($post->post_pk);
            echo json_encode(['status' => true]);
        }
    }

    public function detail($group, $pid) // TODO : The $group (from route) is not used in here, only needed for 'active menu'.
    {
        $post = $this->postModel->getOneById($pid);
        if ( (empty($post)) || (session('role') == 'mahasiswa' && $post->post_group != 'umum') ) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }
        else {
            return view('post/post_detail', ['post' => $post]);
        }
    }

    public function save_post_images($images) // Return image names (array)
    {
        $image_man = \Config\Services::image();
        $count = 0;
        foreach($images as $image) {
            if($image->isValid() && !$image->hasMoved()) {
                // Saving image
                $name = $image->getRandomName();
                $imageNames[$count] = $name; 
                $image->move(WRITEPATH . 'uploads/posts', $name);

                // Thumbnail Creation
                $image_man
                    ->withFile(WRITEPATH . 'uploads/posts/' . $name)
                    ->fit(100, 100, 'center')
                    ->save(WRITEPATH . 'uploads/posts/thumb' . $name);
                $count++;
            }        
        }
        return $imageNames;
    }

    public function delete_post_images($images)
    {
        foreach ($images as $image) {
            unlink(WRITEPATH . 'uploads/posts/' . $image);
            unlink(WRITEPATH . 'uploads/posts/thumb' . $image);
        }
    }
}