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
        $LSP = session('latestShowedPost') ?? 0;
        $newPostNo = $this->postModel->where('post_pk >', $LSP)->countAllResults();
        // https://codeigniter.com/user_guide/database/query_builder.html#custom-key-value-method
        // https://codeigniter.com/user_guide/database/query_builder.html#builder-countallresults
        
        $posts_paginated = $this->postModel->getAllByType('public')->paginate(5); 

        $pager = $this->postModel->pager;
    
        if ($pager->getCurrentPage() == 1)
        {
            $starter = $posts_paginated[0]->pid ?? 0; //NOTE incase no post yet
            session()->set('latestShowedPost', $starter);
        }

        // DD($starter, $LSP, $newPostNo);

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