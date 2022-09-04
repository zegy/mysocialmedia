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
        $pager = \Config\Services::pager();

        $page = (int)(($this->request->getVar('page')!==null)?$this->request->getVar('page'):1)-1;
        
        $post_type = 'public';
        $perPage   = 5;
        $offset    = $page * $perPage;
        
        $data = $this->postModel->getAllPost($post_type, $perPage, $offset);

        return view('home',
        [
            "posts"    => $data['result'],
            "pager"    => $pager->makeLinks($page+1, $perPage, $data['total'], 'custom_template'),
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