<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index() //TODO : Check user's role first
    {
        return view('user/user_index');
    }

    public function list() //NOTE : AJAX. TODO : Check user's role first. Need to?
    {
        if ($this->request->isAJAX())
        {
            $keyword = $this->request->getPost('keyword');
            if (empty($keyword)) //NOTE : Show all users
            {
                $page  = $this->request->getPost('page'); //NOTE : Optional, can be null
                $users = $this->userModel->getAll($page);
                $pager = $this->userModel->pager;
                
                if (!empty($users))
                {
                    $dataView = [
                        "users" => $users,
                        "pager" => $pager,
                    ];
                        
                    echo json_encode([
                        'users'  => view('user/user_list', $dataView),
                        'status' => true
                    ]);
                }
                else
                {
                    echo json_encode(['status' => false]);
                }
            }
            else //NOTE : Show users based on user's search input. TODO (Pending) : The result is not paginated!
            {
                $users = $this->userModel->getAllByKeyword($keyword);
                
                if (!empty($users))
                {
                    $dataView = [
                        "users" => $users,
                    ];
                        
                    echo json_encode([
                        'users'  => view('user/user_list', $dataView),
                        'status' => true
                    ]);
                }
                else
                {
                    echo json_encode([
                        'status' => false,
                        'nomatchuser' => true
                    ]);
                }
            }
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function save () //NOTE : Based on post's save. TODO : Clean this note later after complete!
    {
        if ($this->request->isAJAX())
        {
            // $validated = $this->validate([
            //     'judul'     => ['required'],
            //     'deskripsi' => ['required'],
            //     'images'     => [ //TODO : set max 5! Problem with image names in SQL
            //         'mime_in[images,image/jpg,image/jpeg,image/gif,image/png]',
            //         'max_size[images,4096]',
            //     ]
            // ]);

            $validated = $this->validate([
                'user_name'      => ['required'],
                'user_password'  => ['required'],
                'user_full_name' => ['required'],
                'user_email'     => ['required'],
                'user_tel'       => ['required'],
                'user_sex'       => ['required'],
                'user_bio'       => ['required'],
                'user_role'      => ['required'], // NOTE DANGER : Only use if register via admin!
                'user_profile_picture' => [ //TODO : set max 5! Problem with image names in SQL. Also don't forget the "uploaded"!)
                    'mime_in[user_profile_picture,image/jpg,image/jpeg,image/gif,image/png]',
                    'max_size[user_profile_picture,4096]',
                ],
            ]);

            if (!$validated) //NOTE : IF NOT VALID = return error array with the key and value for each input (only key with empty value for input with no error)
            {
                $errors = [ //NOTE : "getErrors()" did not return input field that "valid", hence the "Getting a Single Error" used instead.
                    'user_name'      => $this->validation->getError('user_name'),
                    'user_password'  => $this->validation->getError('user_password'),
                    'user_full_name' => $this->validation->getError('user_full_name'),
                    'user_email'     => $this->validation->getError('user_email'),
                    'user_tel'       => $this->validation->getError('user_tel'),
                    'user_sex'       => $this->validation->getError('user_sex'),
                    'user_bio'       => $this->validation->getError('user_bio'),
                    'user_role'      => $this->validation->getError('user_role'),
                    'user_profile_picture' => $this->validation->getError('user_profile_picture'),
                ];

                $output = [
                    'errors' => $errors,
                    'status' => false
                ];

                echo json_encode($output);
            }
            else //NOTE : IF VALID
            {
                $data = [
                    // "user_pk"        => session('id'), //DANGER

                    'user_name'      => $this->request->getPost('user_name'),
                    'user_password'  => password_hash($this->request->getPost('user_password'), PASSWORD_DEFAULT), //NOTE Using PHP’s Password Hashing extension. https://codeigniter.com/user_guide/libraries/encryption.html#encryption-service (Just to see the "Important" note!). https://www.php.net/manual/en/function.password-hash.php
                    'user_full_name' => $this->request->getPost('user_full_name'),
                    'user_email'     => $this->request->getPost('user_email'),
                    'user_tel'       => $this->request->getPost('user_tel'),
                    'user_sex'       => $this->request->getPost('user_sex'),
                    'user_bio'       => $this->request->getPost('user_bio'),
                    'user_role'      => $this->request->getPost('user_role'),

                    // 'user_profile_picture' => 
                ];

                $image_man = \Config\Services::image(); //NOTE : Image Manipulation Class (TODO : Best syntax?)

                $user_profile_picture = $this->request->getFile('user_profile_picture');
                if (file_exists($user_profile_picture))
                {
                    if($user_profile_picture->isValid() && !$user_profile_picture->hasMoved())
                    {
                        // Saving image
                        $name = $user_profile_picture->getRandomName();
                        $user_profile_picture->move(WRITEPATH . 'uploads/users', $name);

                        // Thumbnail Creation
                        $image_man
                            ->withFile(WRITEPATH . 'uploads/users/' . $name)
                            ->fit(100, 100, 'center')
                            ->save(WRITEPATH . 'uploads/users/thumb' . $name);
                    }        
                    
                    $data["user_profile_picture"] = $name;
                }
                
                $this->userModel->save($data);
                // $pid = $this->postModel->insertID(); //NOTE : Get ID from the last insert. TODO : What if other user do the insert?

                echo json_encode([
                    // 'group'  => $this->request->getPost('group'),
                    // 'pid'    => $pid,
                    'status' => true
                ]);
            }
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function detail($uid)
    {
        $user = $this->userModel->find($uid);

        if (!empty($user))
        {
            return view('user/user_detail', ["user" => $user]);
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}