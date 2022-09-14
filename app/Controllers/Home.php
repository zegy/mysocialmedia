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
        $page = session()->getFlashdata('curPageHome') ?? null;
        // session()->remove('curPageHome');
        $posts = $this->postModel->getAllByType('public', $page);
        $pager = $this->postModel->pager; // with "default" group for view's "links()"
        session()->setFlashdata('curPage', $pager->getCurrentPage()); // used in update/delete post as "curPageHome"

        return view('home',
        [
            "posts"    => $posts,
            "pager"    => $pager,
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

    public function search()
    {
        $keyword = $this->request->getPost('search');

        if (!empty($keyword))
        {
            return view('search',
            [
                'users'    => $this->userModel->getAllByKeyword($keyword),
                'posts'    => $this->postModel->getAllByKeyword($keyword),
                'comments' => $this->commentModel->getAllByKeyword($keyword),
                "pager"    => $this->postModel->pager
            ]);
        }
        else
        {
            return redirect()->to('/'); // ZEGY OTC 404 SEARCH FORM IS EMPTY (RELATED TO "REQUIRED" VIEW)
        }
    }
}