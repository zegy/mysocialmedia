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
        // ==SEPARATE VER [ ==
        // $newPost = $this->postModel->where('post_pk >', session('latestShowedPost'))->findAll();
        // // dd($newPost);
        // $data = array_column($newPost, 'post_pk'); //NOTE Extract a property from an array of objects
        // dd($data);
        // ==SEPARATE VER ] ==

        // $newPostNo = $this->postModel->getNewPostNo(session('latestShowedPost') ?? 0);
        // $posts = $this->postModel->getAllByType('public');
        // $pager = $this->postModel->pager;
    
        // if ($pager->getCurrentPage() == 1)
        // {
        //     // ==SEPARATE VER [ ==
        //     // $starter = $data[0]->post_pk ?? $posts[0]->pid; //NOTE incase no post yet
        //     // ==SEPARATE VER ] ==
        //     $starter = $posts[0]->pid ?? 0; //NOTE incase no post yet
        //     session()->set('latestShowedPost', $starter);
        // }

        // return view('home',
        // [
        //     "newPostNo" => $newPostNo,
        //     "posts"     => $posts,
        //     "pager"     => $pager,
        //     "homeType"  => "public"
        // ]);

        return view('home',
        [
            "posts"    => $this->postModel->getAllByType('public'),
            "pager"    => $this->postModel->pager,
            "homeType" => "public"
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