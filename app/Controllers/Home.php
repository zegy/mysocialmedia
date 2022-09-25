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
        // $posts = $this->postModel->getAllByType('public');
        $posts_all = $this->postModel->getAllByType('public')->findAll();
        $posts_paginated = $this->postModel->getAllByType('public')->paginate(5); 
        // dd($posts[0]->pid);
        $LSP = session('latestShowedPost') ?? 0;
        $newPostNo = 0;
        foreach ($posts_all as $post) //TODO number only based on "pagination" result, need all posts!
        {
            if ($post->pid > $LSP)
            {
                $newPostNo++;
            }
        }

        $pager = $this->postModel->pager;
        // dd($pager->getCurrentPage());
        if ($pager->getCurrentPage() == 1)
        {
            session()->set('latestShowedPost', $posts_paginated[0]->pid);
        }
        // dd($posts[0]->pid);
        // dd($LSP);
        return view('home',
        [
            "posts"    => $posts_paginated,
            "pager"    => $pager,
            "homeType" => "public",
            "newPostNo" => $newPostNo,
        ]);
        
        // return  view('layouts/header').
        //         view('layouts/layout').
        //         view('layouts/sidebar').
        //         view('home',
        //         [
        //             "posts"    => $this->postModel->getAllByType('public'),
        //             "pager"    => $this->postModel->pager,
        //             "homeType" => "public"
        //         ]).
        //         view('layouts/footer').
        //         view('layouts/js');
    }

    public function homePrivate()
    {
        return view('homeOld',
        [
            "posts"    => $this->postModel->getAllByType('private')->paginate(5),
            "pager"    => $this->postModel->pager,
            "homeType" => "private"
        ]);
    }
}