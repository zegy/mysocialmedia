<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\HomeModel;
use App\Models\PostModel;
use App\Models\CommentModel;

class Home extends BaseController
{
    protected $usuariosModel;
    private   $postModel;

    function __construct()
    {
        helper('form');
        $this->usuariosModel = new UserModel();
        $this->homeModel     = new HomeModel();
        $this->postModel     = new PostModel();
        $this->commentModel  = new CommentModel();
    }

    public function index()
    {
        $userData = session('id');
        //dd($userData);
       
            return view('home',  [
                "posts"  =>  $this->homeModel->paginate(5),
                "pager"  =>  $this->homeModel->pager,
            ]);
           

    }

    public function search()
    {
         $data   = $this->request->getPost();

         $keyword = $data['qsearch'];
         
         $s_users    = '';
         $s_posts    = '';
         $s_comments = '';

         if($keyword) {

             $s_users    =  $this->usuariosModel->getAllByKeyword($keyword);
             $s_posts    =  $this->postModel->getAllByKeyword($keyword);
             $s_comments =  $this->commentModel->getAllByKeyword($keyword);

        } 
         
         return view('search/search', ['users'    =>  $s_users,
                                       'posts'    =>  $s_posts,
                                       'comments' => $s_comments]);
    }
}