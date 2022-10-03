<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('dashboard');
    }
}