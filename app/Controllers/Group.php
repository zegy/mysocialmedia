<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Group extends BaseController
{
    function __construct()
    {
        helper('form');
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // if ($this->request->isAJAX()) {
        //     $data =
        //     [
        //       "posts" => $this->postModel->getAllByType($group),
        //       "pager" => $this->postModel->pager,
        //     ];
      
        //     $output = view('posts_table', $data);
        //     echo json_encode($output);
        // }
        // else
        // {
        //     $data = [
        //         "group" => $group
        //     ];
        //     return view('posts', $data);
        // }

        if ($this->request->isAJAX()) {
            $output = view('group_list');
            echo json_encode($output);
        }
        else
        {
            return view('group');
        }
    }

    public function create()
    {
        // return view('posts',
        // [
        //     "posts" => $this->postModel->getAllByType($group),
        //     "pager" => $this->postModel->pager,
        // ]);
    }
}