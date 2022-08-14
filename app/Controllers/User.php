<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    function __construct()
    {
        helper('form');
        $this->userModel = new UserModel();       
    }
           
    public function showProfile($uid) 
    {   
        $userData = $this->userModel->getById($uid);
        
        if ($userData)
        {            
            return view('profile/profile', ['userData' => $userData]);
        }
        else
        {   
            return redirect()->to('/'); // user not found
        }
    }
}