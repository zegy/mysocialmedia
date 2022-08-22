<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class Account extends BaseController
{
	function __construct()
	{
		helper('form');
		$this->userModel = new UserModel();
	}

	public function signUp()
	{
		return view('account/signup');
	}

	public function createAccount()
	{
        $data = $this->request->getPost();

        // Loading the Library (The library is loaded as a service named validation)
        // https://codeigniter4.github.io/CodeIgniter4/libraries/validation.html#loading-the-library
        $validation = \Config\Services::validation();

        // https://codeigniter4.github.io/CodeIgniter4/libraries/validation.html#how-to-save-your-rules
        $validation->run($data, 'createAccount'); // From "app\Config\Validation.php"

        // https://codeigniter4.github.io/CodeIgniter4/libraries/validation.html#id28
        $errors = $validation->getErrors();

        // $rules     = $this->userModel->val_rules;
        // $all_error = [];

        // if (!$this->validate($rules)) // validate first, then send to model (using basic CRUD). ZEGY OTC Tanpa perlu pembanding? auto dengan controller sekarang?
        // {
        //     $all_error = $this->validator->getErrors();
        // }

        // if ($this->userModel->isEmailExist($data['email'])) // Check if email exist
        // {
        //     array_push($all_error,"email sudah digunakan.");
        // }

        // if ($this->userModel->isUsernameExist($data['username'])) // Check if username exist
        // {
        //     array_push($all_error,"username sudah digunakan.");
        // }

        if (!empty($errors))
        {
            return view('account/signup',
            [
                'prev_input' => $data,
                'errors'     => $errors
            ]);
        }
        else
        {
            $currentTime = new Time('now', 'America/Recife', 'pt_BR'); // ZEGY OTC Change to indonesia

            $profile_img = ($this->request->getFile('profile_img'));
            $filePath    = 'images/' . (string)$data['username'] . '.' . $profile_img->getClientExtension();

            $profile_img->move(ROOTPATH . 'images', (string)$data['username'] . '.' . $profile_img->getClientExtension());

            $dataToSave =
            [
                'user_full_name'       => $data['nama_lengkap'], 
                'user_name'            => $data['username'],
                'user_email'           => $data['email'],
                'user_tel'             => $data['nomor_handphone'],
                'user_password'        => password_hash($data['password'], PASSWORD_DEFAULT),
                'user_profile_picture' => $filePath,
                'user_bio'             => $data['bio'],
                'user_sex'             => $data['jenis_kelamin'],
                'user_regis_date_time' => $currentTime
            ];

            $result = $this->userModel->save($dataToSave); // method "save" dari "BaseModel"
            return view('account/sucessful_created');
        }
    }
}