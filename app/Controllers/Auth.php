<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (session('isLoggedIn') == true)
        {
            return redirect()->to('group/umum'); //TODO right way?
        }
        else
        {
            return view("login");
        }
    }

    public function signUp () //NOTE : Based on post's save. TODO : Clean this note later after complete!
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
                    // 'judul'     => $this->validation->getError('judul'),
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

    public function signIn() //NOTE Using AJAX
    {
        $userData = $this->userModel->where('user_email', $this->request->getPost('email'))->first();

        if (!empty($userData))
        {
            if (password_verify($this->request->getPost('password'), $userData->user_password)) //NOTE Using PHP’s Password Hashing extension. https://codeigniter.com/user_guide/libraries/encryption.html#encryption-service (Just to see the "Important" note!). https://www.php.net/manual/en/function.password-verify.php
            {
                $sessionData =
                [
                    'isLoggedIn' => true,
                    'id'         => $userData->user_pk,
                    'role'       => $userData->user_role,
                    'picture'    => $userData->user_profile_picture
                ];
                session()->set($sessionData);
                echo json_encode(['status' => true]);
            }
            else
            {
                echo json_encode(['status' => false]);
            }
        }
        else
        {
            echo json_encode(['status' => false]);
        }
    }

    public function signOut()
    {
        session()->destroy();
        return redirect()->to('auth');
    }



    // Old functions from "account" controller
    

    // public function createAccount() //Latest form old (working?)
	// {
    //     $data = $this->request->getPost();
    //     // dd($data);

    //     $validation = \Config\Services::validation(); // Loading the Library (The library is loaded as a service named validation). https://codeigniter4.github.io/CodeIgniter4/libraries/validation.html#loading-the-library

    //     $isValid = $validation->run($data, 'createAccount'); // From "app\Config\Validation.php". https://codeigniter4.github.io/CodeIgniter4/libraries/validation.html#how-to-save-your-rules

    //     if (!$isValid)
    //     {
    //         return redirect()->back()->withInput(); // "withInput" used for "old" function in view. https://codeigniter4.github.io/CodeIgniter4/general/common_functions.html?highlight=redirect#redirect
    //     }
    //     else
    //     {
    //         $dataToSave =
    //         [
    //             'user_full_name'       => $data['nama_lengkap'],
    //             'user_name'            => $data['username'],
    //             'user_email'           => $data['email'],
    //             'user_tel'             => $data['nomor_handphone'],
    //             'user_password'        => password_hash($data['password'], PASSWORD_DEFAULT),
    //             'user_sex'             => $data['jenis_kelamin'],
    //         ];

    //         $result = $this->userModel->save($dataToSave); // method "save" dari "BaseModel"
    //         return view('account/sucessful_created');
    //     }
    // }

	// public function createAccount()
	// {
    //     $data = $this->request->getPost();
    //     // dd($data);

    //     $validation = \Config\Services::validation(); // Loading the Library (The library is loaded as a service named validation). https://codeigniter4.github.io/CodeIgniter4/libraries/validation.html#loading-the-library

    //     $isValid = $validation->run($data, 'createAccount'); // From "app\Config\Validation.php". https://codeigniter4.github.io/CodeIgniter4/libraries/validation.html#how-to-save-your-rules

    //     if (!$isValid)
    //     {
    //         // $error = $validation->getErrors();
    //         // dd($error);

    //         // session()->setFlashdata('error', $validation->listErrors()); // as string (has it own "view"). https://codeigniter4.github.io/CodeIgniter4/libraries/validation.html#id28
    //         return redirect()->back()->withInput(); // "withInput" used for "old" function in view. https://codeigniter4.github.io/CodeIgniter4/general/common_functions.html?highlight=redirect#redirect
    //     }
    //     else
    //     {
    //         $profile_img = ($this->request->getFile('profile_img'));
    //         $filePath = 'images/' . (string)$data['username'] . '.' . $profile_img->getClientExtension();
    //         $profile_img->move(ROOTPATH . 'images', (string)$data['username'] . '.' . $profile_img->getClientExtension());

    //         $dataToSave =
    //         [
    //             'user_full_name'       => $data['nama_lengkap'],
    //             'user_name'            => $data['username'],
    //             'user_email'           => $data['email'],
    //             'user_tel'             => $data['nomor_handphone'],
    //             'user_password'        => password_hash($data['password'], PASSWORD_DEFAULT),
    //             'user_profile_picture' => $filePath,
    //             'user_bio'             => $data['bio'],
    //             'user_sex'             => $data['jenis_kelamin'],
    //         ];

    //         $result = $this->userModel->save($dataToSave); // method "save" dari "BaseModel"
    //         return view('account/sucessful_created');
    //     }
    // }
}