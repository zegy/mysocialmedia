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
        $post_type = 'public';
        // dd($this->postModel->getAllPost($post_type));
        
        return view('home',
        [
            "posts"    => $this->postModel->getAllPost($post_type)->paginate(5),
            "pager"    => $this->postModel->pager,
            "homeType" => "public"
        ]);

        // Original
        // return view('home',
        // [
        //     "posts"    => $this->homeModel->where('type', 'public')->paginate(5),
        //     "pager"    => $this->homeModel->pager,
        //     "homeType" => "public"
        // ]);
    }

    public function homePrivate()
    {
        return view('home',
        [
            "posts"    => $this->homeModel->where('type', 'private')->paginate(5),
            "pager"    => $this->homeModel->pager,
            "homeType" => "private"
        ]);
    }

    public function search()
    {
        $data    = $this->request->getPost();
        $keyword = $data['qsearch'];

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