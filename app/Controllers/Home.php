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
        return  view('layouts/header').
                view('layouts/layout').
                view('layouts/sidebar').
                view('home',
                [
                    "posts"    => $this->postModel->getAllByType('public'),
                    "pager"    => $this->postModel->pager,
                    "homeType" => "public"
                ]).
                view('layouts/footer').
                view('layouts/js');
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