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

    // public function createAccount() //Latest form old (working?)
	// {
    //     $data = $this->request->getPost();
    //     // dd($data);

    //     $validation = \Config\Services::validation(); // Loading the Library (The library is loaded as a service named validation). https://codeigniter4.github.io/CodeIgniter4/libraries/validation.html#loading-the-library

    //     $isValid = $validation->run($data, 'createAccount'); // From "app\Config\Validation.php". https://codeigniter4.github.io/CodeIgniter4/libraries/validation.html#how-to-save-your-rules

    //     if (!$isValid)
    //     {
    //         return redirect()->back()->withInput(); // "withInput" used for "old" function in view. https://codeigniter4.github.io/CodeIgniter4/general/common_functions.html?highlight=redirect#redirect
    //     }
    //     else
    //     {
    //         $dataToSave =
    //         [
    //             'user_full_name'       => $data['nama_lengkap'],
    //             'user_name'            => $data['username'],
    //             'user_email'           => $data['email'],
    //             'user_tel'             => $data['nomor_handphone'],
    //             'user_password'        => password_hash($data['password'], PASSWORD_DEFAULT),
    //             'user_sex'             => $data['jenis_kelamin'],
    //         ];

    //         $result = $this->userModel->save($dataToSave); // method "save" dari "BaseModel"
    //         return view('account/sucessful_created');
    //     }
    // }

	// public function createAccount()
	// {
    //     $data = $this->request->getPost();
    //     // dd($data);

    //     $validation = \Config\Services::validation(); // Loading the Library (The library is loaded as a service named validation). https://codeigniter4.github.io/CodeIgniter4/libraries/validation.html#loading-the-library

    //     $isValid = $validation->run($data, 'createAccount'); // From "app\Config\Validation.php". https://codeigniter4.github.io/CodeIgniter4/libraries/validation.html#how-to-save-your-rules

    //     if (!$isValid)
    //     {
    //         // $error = $validation->getErrors();
    //         // dd($error);

    //         // session()->setFlashdata('error', $validation->listErrors()); // as string (has it own "view"). https://codeigniter4.github.io/CodeIgniter4/libraries/validation.html#id28
    //         return redirect()->back()->withInput(); // "withInput" used for "old" function in view. https://codeigniter4.github.io/CodeIgniter4/general/common_functions.html?highlight=redirect#redirect
    //     }
    //     else
    //     {
    //         $profile_img = ($this->request->getFile('profile_img'));
    //         $filePath = 'images/' . (string)$data['username'] . '.' . $profile_img->getClientExtension();
    //         $profile_img->move(ROOTPATH . 'images', (string)$data['username'] . '.' . $profile_img->getClientExtension());

    //         $dataToSave =
    //         [
    //             'user_full_name'       => $data['nama_lengkap'],
    //             'user_name'            => $data['username'],
    //             'user_email'           => $data['email'],
    //             'user_tel'             => $data['nomor_handphone'],
    //             'user_password'        => password_hash($data['password'], PASSWORD_DEFAULT),
    //             'user_profile_picture' => $filePath,
    //             'user_bio'             => $data['bio'],
    //             'user_sex'             => $data['jenis_kelamin'],
    //         ];

    //         $result = $this->userModel->save($dataToSave); // method "save" dari "BaseModel"
    //         return view('account/sucessful_created');
    //     }
    // }

    public function showProfile($uid)
    {
        $user = $this->userModel->find($uid);

        if (!empty($user))
        {
            return view('user/user_profile', ["user" => $user]);
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}