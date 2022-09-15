<?php

namespace App\Controllers;

use App\Models\PostModel;

class Home extends BaseController
{
    function __construct()
    {
        helper('form');
        $this->postModel = new PostModel();
    }

    public function homePublic()
    {
        return view('home',
        [
            "posts"    => $this->postModel->getAllByType('public'),
            "pager"    => $this->postModel->pager,
            "homeType" => "public"
        ]);
    }

    public function homePrivate()
    {
        return view('home',
        [
            "posts"    => $this->postModel->getAllByType('private'),
            "pager"    => $this->postModel->pager,
            "homeType" => "private"
        ]);
    }
}