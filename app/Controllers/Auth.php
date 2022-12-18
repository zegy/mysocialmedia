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
        if (session('isLoggedIn') == true) {
            return redirect()->to(base_url('group/umum'));
        }
        else {
            return view('login');
        }
    }

    public function signIn() // AJAX
    {
        $user = $this->userModel->where('user_email', $this->request->getPost('email'))->first();

        $output['status'] = false; // Default value (Changeable with below code)
        if (!empty($user)) {
            if (password_verify($this->request->getPost('password'), $user->user_password)) { // Using PHP’s Password Hashing extension. https://codeigniter.com/user_guide/libraries/encryption.html#encryption-service (Just to see the 'Important' note!). https://www.php.net/manual/en/function.password-verify.php
                $sessionData =
                [
                    'isLoggedIn' => true,
                    'id'         => $user->user_pk,
                    'role'       => $user->user_role,
                    'picture'    => $user->user_profile_picture,
                    'full_name'  => $user->user_full_name
                ];
                session()->set($sessionData);
                $output['status'] = true;
            }
        }
        echo json_encode($output);
    }

    public function signOut()
    {
        // Remove user's token (FCM)
        $data = [
            'user_pk' => session('id'),
            'user_token' => null,
        ];

        $this->userModel->save($data);

        // TODO (Danger) : Problem removing session! local is okay with this code but not at hosting (also with code below)
        // session()->destroy();
        // session_destroy();
        // $this->session->stop();
        $this->session->destroy();
        
        return redirect()->to(base_url('auth'));
    }
}