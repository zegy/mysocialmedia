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
                // 'user_role'      => ['required'], // NOTE : Only used if register via admin ()
                'user_profile_picture' => [ //TODO : set max 5! Problem with image names in SQL. Also don't forget the "uploaded"!)
                    'mime_in[images,image/jpg,image/jpeg,image/gif,image/png]',
                    'max_size[images,4096]',
                ],
            ]);

            if (!$validated) //NOTE : IF NOT VALID = return error array with the key and value for each input (only key with empty value for input with no error)
            {
                $errors = [ //NOTE : "getErrors()" did not return input field that "valid", hence the "Getting a Single Error" used instead.
                    'user_name'     => $this->validation->getError('user_name'),
                ];

                $output = [
                    'errors' => $errors,
                    'status' => false
                ];

                echo json_encode($output);
            }
            else //NOTE : IF VALID
            {
                $email = $this->request->getPost('email');
                $username = $this->request->getPost('username');

                // TODO : Replace the below syntax. Use validation's "is_unique" and "matches"
                $userSameEmail = $this->userModel->where('user_email', $email)->find(); //NOTE : Get any user with the same email
                $userSameUsername = $this->userModel->where('user_name', $username)->find(); //NOTE : Get any user with the same username

                if (!empty($userSameEmail) || !empty($userSameUsername))
                {
                    //TODO : Error - User with same email or username exist!
                }
                else
                {
                    $data = [
                        "post_fk_user" => session('id'),
                        "post_title"   => $this->request->getPost('judul'),
                        "post_text"    => $this->request->getPost('deskripsi'),
                        "post_type"    => $this->request->getPost('group'),
                    ];

                    $image_man = \Config\Services::image(); //NOTE : Image Manipulation Class (TODO : Best syntax?)


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
                        $data["post_img"] = implode(",", $imageNames);
                    }
                    $this->postModel->save($data);
                    $pid = $this->postModel->insertID(); //NOTE : Get ID from the last insert. TODO : What if other user do the insert?

                    echo json_encode([
                        'group'  => $this->request->getPost('group'),
                        'pid'    => $pid,
                        'status' => true
                    ]);
                }
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