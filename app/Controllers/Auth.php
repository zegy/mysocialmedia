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