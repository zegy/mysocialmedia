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
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function list_default()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); //NOTE : This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }

        $page  = $this->request->getPost('page'); //NOTE : Optional, can be null
        $group = $this->request->getPost('group');
        $posts = $this->postModel->getAllByGroup($group, $page);
        $pager = $this->postModel->pager;

        if (!empty($posts)) {
            $dataView = [
                'posts' => $posts,
                'pager' => $pager,
            ];
                
            echo json_encode([
                'posts'  => view('post/post_list', $dataView),
                'status' => true
            ]);
        }
        else {
            echo json_encode([
                'status' => false,
            ]);
        }
    }

    public function list_search()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); //NOTE : This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }

        $keyword = $this->request->getPost('keyword');
        $page  = $this->request->getPost('page'); //NOTE : Optional, can be null
        $group = $this->request->getPost('group');
        $posts = $this->postModel->getAllByGroupAndKeyword($keyword, $group, $page);
        $pager = $this->postModel->pager;

        if (!empty($posts)) {
            $dataView = [
                'posts' => $posts,
                'pager' => $pager,
            ];
                
            echo json_encode([
                'posts'  => view('post/post_list', $dataView),
                'status' => true
            ]);
        }
        else {
            echo json_encode([
                'status' => false,
            ]);
        }
    }
        
    public function listFromUser() //NOTE : AJAX. TODO (Pending) : The result is not paginated!
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); //NOTE : This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }
        
        $user = $this->request->getPost('user');

        if (session('role') == 'mahasiswa')
        {
            $posts = $this->postModel->public_by_user($user);
        }
        else
        {
            $posts = $this->postModel->all_by_user($user);
        }
        
        if (!empty($posts))
        {
            $dataView = ['posts' => $posts];
                
            echo json_encode([
                'posts'  => view('post/post_list_from_user', $dataView),
                'status' => true
            ]);
        }
        else
        {
            echo json_encode(['status' => false]);
        }
        
    }

    public function delete() //NOTE : AJAX. TODO : Check owner before delete
    {
        if ($this->request->isAJAX())
        {
            $pid = $this->request->getPost('pid');
            $images = $this->request->getPost('images');

            if (!empty($images))
            { 
                $imgs = explode(',', $images);
                foreach ($imgs as $img)
                {
                    unlink(WRITEPATH . 'uploads/posts/' . $img);
                    unlink(WRITEPATH . 'uploads/posts/thumb' . $img);
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

    public function detail($group, $pid) //TODO : Use $group to limit the user who can see the post later
    {
        $post = $this->postModel->getOneById($pid);
        if (!empty($post))
        {
            return view('post/post_detail', ['post' => $post]);
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function save () //NOTE : AJAX. Single create + update function. TODO : Check owner before update?
    {
        if ($this->request->isAJAX())
        {
            $validated = $this->validate([
                'judul'     => ['required'],
                'deskripsi' => ['required'],
                'images'     => [ //TODO : set max 5! Problem with image names in SQL
                    'mime_in[images,image/jpg,image/jpeg,image/gif,image/png]',
                    'max_size[images,4096]',
                ]
            ]);

            if (!$validated) //NOTE : IF NOT VALID = return error array with the key and value for each input (only key with empty value for input with no error)
            {
                $errors = [ //NOTE : 'getErrors()' did not return input field that 'valid', hence the 'Getting a Single Error' used instead.
                    'judul'     => $this->validation->getError('judul'),
                    'deskripsi' => $this->validation->getError('deskripsi'),
                    'images'     => $this->validation->getError('images') //TODO (pending) : individual 'error' for each image
                ];

                $output = [
                    'errors' => $errors,
                    'status' => false
                ];

                echo json_encode($output);
            }
            else //NOTE : IF VALID
            {
                $image_man = \Config\Services::image(); //NOTE : Image Manipulation Class (TODO : Best syntax?)

                $pid = $this->request->getPost('pid'); //NOTE : To decide if it's create or update post. If no pid (null) = create post. Otherwise it's update post
                if (empty($pid)) //NOTE : Create
                {
                    $data = [
                        'post_fk_user' => session('id'),
                        'post_title'   => $this->request->getPost('judul'),
                        'post_text'    => $this->request->getPost('deskripsi'),
                        'post_group'    => $this->request->getPost('group'),
                    ];

                    $images = $this->request->getFileMultiple('images');
                    if (file_exists($images[0]))
                    {
                        $count = 0;
                        foreach($images as $image)
                        {
                            if($image->isValid() && !$image->hasMoved())
                            {
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
                        $data['post_img'] = implode(',', $imageNames);
                    }
                    $this->postModel->save($data);
                    $pid = $this->postModel->insertID(); //NOTE : Get ID from the last insert. TODO : What if other user do the insert?

                    echo json_encode([
                        'group'  => $this->request->getPost('group'),
                        'pid'    => $pid,
                        'status' => true
                    ]);
                }
                else //NOTE : Update
                {
                    $data = [
                        'post_pk'      => $pid,
                        'post_fk_user' => session('id'),
                        'post_title'   => $this->request->getPost('judul'),
                        'post_text'    => $this->request->getPost('deskripsi'),
                        'post_group'    => $this->request->getPost('group'),
                    ];
                    
                    $update_image = $this->request->getPost('cb_update_image');
                    if ($update_image == true)
                    {
                        //NOTE : Remove old images
                        $old_images = $this->request->getPost('old_images'); //NOTE : String    
                        if (!empty($old_images))
                        {
                            $old_images_to_remove = explode(',', $old_images);
                            foreach ($old_images_to_remove as $old_image_to_remove)
                            {
                                unlink(WRITEPATH . 'uploads/posts/' . $old_image_to_remove);
                                unlink(WRITEPATH . 'uploads/posts/thumb' . $old_image_to_remove);
                            }
                        }
                        
                        //NOTE : Get new images (if exists)
                        $images = $this->request->getFileMultiple('images');
                        if (file_exists($images[0]))
                        {
                            $count = 0;
                            foreach($images as $image)
                            {
                                if($image->isValid() && !$image->hasMoved())
                                {
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
                            $data['post_img'] = implode(',', $imageNames);
                        }
                        else
                        {
                            $data['post_img'] = null;
                        }
                    
                        $this->postModel->save($data);

                        echo json_encode([
                            'images' => $imageNames ?? null,
                            'images_change' => true,
                            'status' => true,
                        ]);
                    }
                    else
                    {
                        $this->postModel->save($data);

                        echo json_encode([
                            'status' => true
                        ]);
                    }
                }
            }
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}