<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PostModel;

class User extends BaseController
{
    function __construct()
    {
        helper('form');
        $this->userModel = new UserModel();
        $this->postModel = new PostModel();
    }

    public function showProfile($uid)
    {
        $userData = $this->userModel->find($uid);

        if (!empty($userData))
        {
            return view('profile',
            [
                "userData" => $userData,
                "posts"    => $this->postModel->getAllByUser($uid),
                "pager"    => $this->postModel->pager,
            ]);
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function get_user_modal($uid) // From ci4-crud-ajax example (get_add_item_modal)
    {
        if ($this->request->isAJAX())
        {
            $data = ["user" => $this->userModel->find($uid)];
            $output = view('forms/user-modal', $data);
            echo json_encode($output);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}