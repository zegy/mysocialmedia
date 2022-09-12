<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PostModel;
use App\Models\CommentModel;

class Home extends BaseController
{
    function __construct()
    {
        helper('form');
        $this->userModel    = new UserModel();
        $this->postModel    = new PostModel();
        $this->commentModel = new CommentModel();
    }

    public function homePublic()
    {
        $this->postModel->getAllByType('public');

        return view('home',
        [
            "posts"    => $this->postModel->getAllByType('public'),
            "pager"    => $this->postModel->pager,
            "homeType" => "public"
        ]);
    }

    public function homePrivate()
    {
        // $posts = $this->postModel->getAllByType('private'); // As object, use "paginate" to get results (also object) only
        // return view('home',
        // [
        //     "posts"    => $posts->paginate(5),
        //     "pager"    => $posts->pager,
        //     "homeType" => "private"
        // ]);
    }

    public function search()
    {
        $keyword = $this->request->getPost('search');

        if (!empty($keyword))
        {
            return view('search',
            [
                'users'    => $this->userModel->getAllByKeyword($keyword),
                'posts'    => $this->postModel->getAllByKeyword($keyword),
                'comments' => $this->commentModel->getAllByKeyword($keyword)
            ]);
        }
        else
        {
            return redirect()->to('/'); // ZEGY OTC 404 SEARCH FORM IS EMPTY (RELATED TO "REQUIRED" VIEW)
        }
    }
}