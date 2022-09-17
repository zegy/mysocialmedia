<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PostModel;
use App\Models\CommentModel;

class Search extends BaseController
{
    function __construct()
    {
        helper('form');
        $this->userModel    = new UserModel();
        $this->postModel    = new PostModel();
        $this->commentModel = new CommentModel();
    }

    public function index()
    {
        $keyword = $this->request->getPost('search');
        if (!empty($keyword))
        {
            return redirect()->to('searchresult/' . $keyword);
        }
        else
        {
            return redirect()->to('/'); // ZEGY OTC 404 SEARCH FORM IS EMPTY (RELATED TO "REQUIRED" VIEW)
        }
    }

    public function searchResult($keyword)
    {
        return view('search',
        [
            'users'    => $this->userModel->getAllByKeyword($keyword),
            'posts'    => $this->postModel->getAllByKeyword($keyword),
            'comments' => $this->commentModel->getAllByKeyword($keyword),
            // "pager"    => $this->postModel->pager
        ]);
    }
}