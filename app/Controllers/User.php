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
        $userData = $this->userModel->where('user_pk', $uid)->first();

        if (!empty($userData))
        {
            $posts = $this->postModel->getAllByUser($uid); // As object, use "paginate" to get results (also object) only
            return view('profile',
            [
                "userData" => $userData,
                "posts"    => $posts->paginate(5),
                "pager"    => $posts->pager,
            ]);
        }
        else
        {
            return redirect()->to('/'); // ZEGY OTC 404 POST NOT FOUND
        }
    }
}