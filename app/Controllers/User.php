<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index() //TODO : Check user's role first
    {
        return view('user/user_index');
    }

    public function list() //NOTE : AJAX. TODO : Check user's role first. Need to?
    {
        if ($this->request->isAJAX())
        {
            $keyword = $this->request->getPost('keyword');
            if (empty($keyword)) //NOTE : Show all users
            {
                $page  = $this->request->getPost('page'); //NOTE : Optional, can be null
                $users = $this->userModel->getAll($page);
                $pager = $this->userModel->pager;
                
                if (!empty($users))
                {
                    $dataView = [
                        "users" => $users,
                        "pager" => $pager,
                    ];
                        
                    echo json_encode([
                        'users'  => view('user/user_list', $dataView),
                        'status' => true
                    ]);
                }
                else
                {
                    echo json_encode(['status' => false]);
                }
            }






            else //NOTE : Show all group's posts based on user's search input. TODO (Pending) : The result is not paginated!
            {
                $posts = $this->postModel->getAllByKeyword($keyword);
                
                if (!empty($posts))
                {
                    $dataView = [
                        "posts" => $posts,
                    ];
                        
                    echo json_encode([
                        'posts'  => view('post/post_list', $dataView),
                        'status' => true
                    ]);
                }
                else
                {
                    echo json_encode([
                        'status' => false,
                        'nomatchpost' => true
                    ]);
                }
            }
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }






    public function detail($uid)
    {
        $user = $this->userModel->find($uid);

        if (!empty($user))
        {
            return view('user/user_detail', ["user" => $user]);
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}