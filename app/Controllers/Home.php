<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\HomeModel;
use App\Models\PostModel;
use App\Models\CommentModel;

class Home extends BaseController
{
    function __construct()
    {
        helper('form');
        $this->homeModel    = new HomeModel();
        $this->userModel    = new UserModel();
        $this->postModel    = new PostModel();
        $this->commentModel = new CommentModel();
    }

    public function homePublic()
    {
        return view('home_public',
        [
            "posts" => $this->homeModel->publicPosts()->paginate(5),
            "pager" => $this->homeModel->pager
        ]);
    }

    public function homePrivate()
    {
        return view('home_private',
        [
            "posts" => $this->homeModel->privatePosts()->paginate(5),
            "pager" => $this->homeModel->pager
        ]);
    }

    public function search()
    {
        $data       = $this->request->getPost();
        $keyword    = $data['qsearch'];
        $s_users    = '';
        $s_posts    = '';
        $s_comments = '';

        if($keyword)
        {
            $s_users    = $this->userModel->getAllByKeyword($keyword);
            $s_posts    = $this->postModel->getAllByKeyword($keyword);
            $s_comments = $this->commentModel->getAllByKeyword($keyword);
        } 
         
        return view('search/search',
        [
            'users'    => $s_users,
            'posts'    => $s_posts,
            'comments' => $s_comments
        ]);
    }
}