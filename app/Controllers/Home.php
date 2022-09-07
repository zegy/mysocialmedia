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
        // [START] Experimental "pagination"
        $pager    = \Config\Services::pager();
        $page     = $this->request->getVar('page') ?? (1);
        $postType = 'public';
        $perPage  = (5);
        $offset   = ($page-1) * $perPage;
        $data     = $this->postModel->getAllPost($postType, $perPage, $offset);

        return view('home',
        [
            "posts"    => $data['result'],
            "pager"    => $pager->makeLinks($page, $perPage, $data['total']),
            "homeType" => "public"
        ]);
        // [END]

        // [START] Original version (pagination not working if using query builder)
        // return view('home',
        // [
        //     "posts"    => $this->homeModel->where('type', 'public')->paginate(5), // call "<?php echo $pager->links()" on view to use this version
        //     "pager"    => $this->homeModel->pager,
        //     "homeType" => "public"
        // ]);
        // [END]
    }

    public function homePrivate()
    {
        // [START] Experimental "pagination". Similiar to "homePublic"
        $pager    = \Config\Services::pager();
        $page     = $this->request->getVar('page') ?? (1);
        $postType = 'private';
        $perPage  = (5);
        $offset   = ($page-1) * $perPage;
        $data     = $this->postModel->getAllPost($postType, $perPage, $offset);

        return view('home',
        [
            "posts"    => $data['result'],
            "pager"    => $pager->makeLinks($page, $perPage, $data['total']),
            "homeType" => "private"
        ]);
        // [END]
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