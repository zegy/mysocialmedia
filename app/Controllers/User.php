<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
// use App\Models\PostModel;

class User extends BaseController
{
    function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function showProfile($uid)
    {
        $user = $this->userModel->find($uid);

        if (!empty($user))
        {
            return view('user/user_profile', ["user" => $user]);
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}