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
		$this->usuariosModel = new UserModel();
	}

	public function signUp()
	{
		return view('account/signup');
	}

	public function createAccount()
	{
		$validationRule =
		[
			'nama_lengkap'        => 'required|min_length[3]',
			'username'            => 'required|min_length[5]',
			'email'               => 'required|valid_email',
            'nomor_handphone'     => 'required|min_length[8]|numeric',
            'password'            => 'required|min_length[8]',
			'konfirmasi_password' => 'required|matches[password]',
            'userfile' => // ZEGY OTC WHAT USERFILE?
			[
			    'label' => 'foto profil',
				'rules' => 'uploaded[arquivo]'
						. '|is_image[arquivo]'
						. '|mime_in[arquivo,image/jpg,image/jpeg]'
						. '|max_size[arquivo,30]'
						. '|max_dims[arquivo,200,200]',
			],
            'bio'                 => 'required|max_length[250]',
			'jenis_kelamin'       => 'required'
		];

		$data = $this->request->getPost();
		$myTime = new Time('now', 'America/Recife', 'pt_BR'); // ZEGY OTC Change to indonesia
		
		if (!$this->validate($validationRule))
		{
			$data =
            [
                'errors' => $this->validator->getErrors(),
                'test'   => 'isi test'
            ];
			return view('account/signup', $data);
		}
		else
		{
            $arquivo->move(ROOTPATH . 'public/images', (string)$data['username'] . '.' . $arquivo->getClientExtension());
			$filePath = 'images/' . (string)$data['username'] . '.' . $arquivo->getClientExtension();

            switch ((string)($data['jenis_kelamin']))
            {
                case 'm':
                    $gender = 'm'; break;
                case 'f':
                    $gender = 'f'; break;
            }

			$dataToSave =
			[
				'user_full_name'   	   => $data['nama_lengkap'], 
                'user_name'  		   => (string)$data['username'],
				'user_email'  		   => $data['email'],
				'user_tel'    		   => $data['nomor_handphone'],
                'user_password'  	   => password_hash((string)$data['password'], PASSWORD_DEFAULT),
                'user_profile_picture' => (string)$filePath,
				'user_bio'    		   => $data['bio'],
				'user_sex'			   => $gender,
				'user_regis_date_time' => ((array)$myTime)['date']
			];

			$result = $this->usuariosModel->save($dataToSave);
			return view('account/sucessful_created');
		}
	}
}