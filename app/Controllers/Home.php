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
        $newPostNo = $this->postModel->getNewPostNo(session('latestShowedPost') ?? 0);
        $posts = $this->postModel->getAllByType('public');
        $pager = $this->postModel->pager;
    
        if ($pager->getCurrentPage() == 1)
        {
            $starter = $posts[0]->pid ?? 0; //NOTE incase no post yet
            session()->set('latestShowedPost', $starter);
        }

        return view('home',
        [
            "newPostNo" => $newPostNo,
            "posts"     => $posts,
            "pager"     => $pager,
            "homeType"  => "public"
        ]);
    }

    public function homePrivate()
    {
        return view('homeOld',
        [
            "posts"    => $this->postModel->getAllByType('private'),
            "pager"    => $this->postModel->pager,
            "homeType" => "private"
        ]);
    }
}