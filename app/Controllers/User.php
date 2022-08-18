<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HomeModel;
use App\Models\UserModel;

class User extends BaseController
{
    function __construct()
    {
        helper('form');
        $this->userModel = new UserModel();
        $this->homeModel = new HomeModel();
    }
           
    public function showProfile($uid) 
    {   
        $userData = $this->userModel->getById($uid);
        if ($userData)
        {            
            return view('profile',
            [
                "userData" => $userData,
                "posts"    => $this->homeModel->where('uid', $uid)->paginate(5), // paginate with where
                "pager"    => $this->homeModel->pager
            ]);
        }
        else
        {   
            return redirect()->to('/'); // user not found
        }
    }
}