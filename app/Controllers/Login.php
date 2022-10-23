<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    function __construct()
    {
        helper('form');
    }

    public function index() //TODO Why not in "__construct" ?
    {
        if (session('isLoggedIn') == true)
        {
            return redirect()->to('/fordis/umum'); //TODO right way?
        }
        else
        {
            return view("login");
        }
    }

    public function signIn()
    {
        $rules = [
          'email' => 'required',
          'password' => 'required',
        ];
    
        if (!$this->validate($rules)) {
          $errors = [
            'email' => $this->validation->getError('email'),
            'password' => $this->validation->getError('password'),
          ];
    
          $output = [
            'status' => FALSE,
            'errors' => $errors
          ];
          echo json_encode($output);
        } else {
        //   $this->model->save([
        //     'name' => $this->request->getPost('name'),
        //     'price' => $price,
        //     'category' => $this->request->getPost('category'),
        //     'detail' => $this->request->getPost('detail'),
        //   ]);
          echo json_encode(['status' => TRUE]);
        }

        // ========================================================================================
        // $data = $this->request->getPost();
        // // dd($data);

        // $userModel = new UserModel();
        // $dataUser = $userModel->where('user_email', $data['email'])->first();

        // if (!empty($dataUser))
        // {
        //     $hash = $dataUser->user_password;

        //     if (password_verify($data['password'], $hash))
        //     {
        //         session()->set('isLoggedIn', true);
        //         session()->set('id', $dataUser->user_pk);
        //         session()->set('role', $dataUser->user_role);
        //         session()->set('picture', $dataUser->user_profile_picture);
        //         return redirect()->to('/fordis/umum'); //TODO right way?
        //     }
        //     else
        //     {
        //        session()->setFlashData('msg','Usuario ou senha incorretos!');
        //        return redirect()->back();         
        //     }
        // }
        // else
        // {
        //     session()->setFlashData('msg','Usuario ou senha incorretos!');
        //     return redirect()->back();         
        // }
    }

    public function signOut()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}