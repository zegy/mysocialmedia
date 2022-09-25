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
        $posts = $this->postModel->getAllByType('public');
        // dd($posts[0]->pid);
        $LSP = session('latestShowedPost') ?? 0;
        $newPostNo = 0;
        foreach ($posts as $post) //TODO number only based on "pagination" result, need all posts!
        {
            if ($post->pid > $LSP)
            {
                $newPostNo++;
            }
        }

        session()->set('latestShowedPost', $posts[0]->pid);
        // dd($posts[0]->pid);
        // dd($LSP);
        return view('home',
        [
            "posts"    => $posts,
            "pager"    => $this->postModel->pager,
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
            "posts"    => $this->postModel->getAllByType('private'),
            "pager"    => $this->postModel->pager,
            "homeType" => "private"
        ]);
    }
}