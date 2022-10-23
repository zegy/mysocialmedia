<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Group extends BaseController
{
    function __construct()
    {
        helper('form');
        $this->userModel = new UserModel();
    }

    public function create()
    {
        // return view('posts',
        // [
        //     "posts" => $this->postModel->getAllByType($group),
        //     "pager" => $this->postModel->pager,
        // ]);
    }
}