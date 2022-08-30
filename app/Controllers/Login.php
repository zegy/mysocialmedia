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
        if (session('isLoggedIn') == true) // if user is already logged go to home page
        {
            return redirect()->to('/');
        }
        else
        {
            return view("login");
        }
    }

    public function signIn()
    {
        $email        = $this->request->getPost('inputEmail');
        $password     = $this->request->getPost('inputPassword');
        $usuarioModel = new UserModel();
        $dadosUsuario = $usuarioModel->where('user_email', $email)->first();

        if (count($dadosUsuario) > 0)
        {
            $hashUsuario = $dadosUsuario['user_password'];

            if (password_verify($password, $hashUsuario))
            {
                session()->set('isLoggedIn', true);
                session()->set('id', $dadosUsuario['user_pk']);
                session()->set('role', $dadosUsuario['user_role']);
                return redirect()->to(base_url("/"));
           }
           else
           {
               session()->setFlashData('msg','Usuario ou senha incorretos!');
               return redirect()->to('/login');
           }
        }
        else
        {
            session()->setFlashData('msg','Usuario ou senha incorretos!');
            return redirect()->to('/login');
        }
    }

    public function signOut()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}