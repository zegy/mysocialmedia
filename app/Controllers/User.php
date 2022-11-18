<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PostModel;

class User extends BaseController
{
    function __construct()
    {
        helper('form');
        $this->userModel = new UserModel();
        $this->postModel = new PostModel();
    }

    public function showProfile($uid)
    {
        $userData = $this->userModel->find($uid);

        if (!empty($userData))
        {
            return view('profile',
            [
                "userData" => $userData,
                "posts"    => $this->postModel->getAllByUser($uid),
                "pager"    => $this->postModel->pager,
            ]);
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}