<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    function __construct()
    {
        helper('form');
        $this->usuariosModel = new UserModel();       
    }
           
    public function showProfile($uid) // load profile information and show on view 
    {
        if (!$uid)
        {       
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
           
        $userData = $this->usuariosModel->getById($uid);
        
        if ($userData)
        {
            echo view('profile/profile', ["userData" => $userData]); 
        }
        else
        {   
            return redirect()->to('/');
        }
    }
}