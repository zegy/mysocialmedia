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
        if (session()->isLoggedIn == true) // if user is already logged go to home page
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
        $dadosUsuario = $usuarioModel->getByEmail($email);
        
        if (count($dadosUsuario) > 0) 
        {   
            $hashUsuario = $dadosUsuario['user_password'];
           
            if(password_verify($password, $hashUsuario)) 
            {
                session()->set('isLoggedIn', true); 
                session()->set('id',     $dadosUsuario['user_pk']);
                session()->set('login',  $dadosUsuario['user_name']);
                session()->set('nome',   $dadosUsuario['user_full_name']);
                session()->set('email',  $dadosUsuario['user_email']);
                session()->set('tel',    $dadosUsuario['user_tel']);
                session()->set('img',    $dadosUsuario['user_profile_picture']);
                session()->set('dt_cad', $dadosUsuario['user_regis_date_time']);
                session()->set('sexo',   $dadosUsuario['user_sex']);
                return redirect()->to(base_url("/"));
           }
           else
           {
               session()->setFlashData('msg','Usuario ou senha incorretos!' );
               return redirect()->to('/login');
           } 
        }
        else
        {
            session()->setFlashData('msg','Usuario ou senha incorretos!' );
            return redirect()->to('/login');
        }         
    } 
    
    public function signOut() 
    {
        session()->destroy();
        return redirect()->to('/login'); 
    }   
}