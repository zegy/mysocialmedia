<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    function __construct()
    {
        helper('form');
    }

    public function index()
    {
        if (session('isLoggedIn') == true)
        {
            return redirect()->to('group/umum/groupposts'); //TODO right way?
        }
        else
        {
            return view("login");
        }
    }

    public function signIn() //NOTE Using AJAX
    {
        $userModel = new UserModel();
        $userData = $userModel->where('user_email', $this->request->getPost('email'))->first();

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
        return redirect()->to('/login');
    }
}