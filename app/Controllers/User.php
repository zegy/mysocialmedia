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
        // $userData = $this->userModel->where('user_pk', $uid)->first();
        $userData = $this->userModel->find($uid); // using parameter to match the model's "primaryKey" 

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
            return redirect()->to('/'); // ZEGY OTC 404 POST NOT FOUND
        }
    }
}