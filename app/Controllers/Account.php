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

	public function signup()
	{
		
		$userData = session('id');
		if($userData==12){
			return view('account/signup');
		}else{
			echo view('erro');
		}
	}

	public function createAccount()
	{
		$validationRule = [
			'userfile'  => [
				'label' => 'Image File',
				'rules' => 'uploaded[arquivo]'
					. '|is_image[arquivo]'
					. '|mime_in[arquivo,image/jpg,image/jpeg]'
					. '|max_size[arquivo,30]'
					. '|max_dims[arquivo,200,200]',
			],
			'nome'     => 'required|min_length[3]',
			'username' => 'required|min_length[5]',
			'password' => 'required|min_length[8]',
			'passconf' => 'required|matches[password]',
			'email'    => 'required|valid_email',
			'phone'    => 'min_length[8]|numeric',
			'gender'   => 'required'
		];

		$data = $this->request->getPost();

		if (count($data) == 0) {
			return redirect()->to('/');
		}

		$arquivo  = ($this->request->getFile('arquivo')) ? $this->request->getFile('arquivo') : null; // verify if file is valid
		$filePath = '';
		$myTime = new Time('now', 'America/Recife', 'pt_BR');
		$gender = null;

		switch ((string)($data['gender'])) {
			case 'm':
				$gender = 'm';
				break;

			case 'f':
				$gender = 'f';
				break;

			default:
				$gender = null;
				break;
		}

		if (!$this->validate($validationRule)) {
			$data = ['errors' => $this->validator->getErrors()];
			return view('account/signup', $data);

		} else {

			$dados = [
				'infoArquivo' => []
			];

			if ($arquivo && !$arquivo->isValid()) {
				return view('account/signup');
			
			} elseif ($arquivo && $arquivo->isValid() && !$arquivo->hasMoved()) {
				$arquivo->move(ROOTPATH . 'public/images', (string)$data['username'] . '.' . $arquivo->getClientExtension());
				$filePath = 'images/' . (string)$data['username'] . '.' . $arquivo->getClientExtension();
			}

			$dataToSave = [
				'user_name'  => (string)$data['username'],
				'user_password'  => password_hash((string)$data['password'], PASSWORD_DEFAULT),
				'user_full_name'   => $data['nome'],
				'user_email'  => $data['email'],
				'user_tel'    => ($data['phone'] ? $data['phone'] : null),
				'user_profile_picture'    => (string)$filePath,
				'user_regis_date_time' => ((array)$myTime)['date'],
				'user_sex'   => $gender,
				'user_bio'    => $data['bio']
			];

			$result = $this->usuariosModel->save($dataToSave);
			return view('account/sucessful_created');
		}
	}
}
