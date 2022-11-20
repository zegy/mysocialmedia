<?php

namespace App\Controllers;

use App\Controllers\BaseController;
// use App\Models\GroupModel;

class Group extends BaseController
{
    function __construct()
    {
        // $this->groupModel = new GroupModel();
    }

    public function index()
    {
        return view('group/group_index');
    }

    public function list() //NOTE : AJAX
    {
        if ($this->request->isAJAX())
        {
            echo json_encode([
                'groups' => view('group/group_list'),
                'status' => true
            ]);
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}