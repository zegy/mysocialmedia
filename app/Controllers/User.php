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

    public function list_default() // AJAX
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }

        $page  = $this->request->getPost('page'); //NOTE : Optional, can be null
        $users = $this->userModel->getAll($page);
        $pager = $this->userModel->pager;
        
        if (!empty($users)) {
            $dataView = [
                'users' => $users,
                'pager' => $pager,
            ];
                
            echo json_encode([
                'users'  => view('user/user_list', $dataView),
                'status' => true
            ]);
        }
        else {
            echo json_encode([
                'status' => false,
            ]);
        }   
    }

    public function list_search() // AJAX
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }

        $keyword = $this->request->getPost('keyword');
        $page  = $this->request->getPost('page'); // Optional, can be null
        $users = $this->userModel->getAllByKeyword($keyword, $page);
        $pager = $this->userModel->pager;

        if (!empty($users)) {
            $dataView = [
                'users' => $users,
                'pager' => $pager,
            ];
                
            echo json_encode([
                'users'  => view('user/user_list', $dataView),
                'status' => true
            ]);
        }
        else {
            echo json_encode([
                'status' => false,
            ]);
        }
    }

    public function create() // AJAX
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }

        $rules = [
            'user_name'      => ['required'],
            'user_password'  => ['required'],
            'user_full_name' => ['required'],
            'user_email'     => ['required'],
            'user_tel'       => ['required'],
            'user_sex'       => ['required'],
            'user_bio'       => ['required'],
            'user_role'      => ['required'], // NOTE DANGER : Only use if register via admin!
            'user_profile_picture' => [ //TODO : set max 5! Problem with image names in SQL. Also don't forget the 'uploaded'!)
                'mime_in[user_profile_picture,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[user_profile_picture,4096]',
            ]
        ];

        if (!$this->validate($rules)) {
            $errors = [
                'user_name'      => $this->validation->getError('user_name'),
                'user_password'  => $this->validation->getError('user_password'),
                'user_full_name' => $this->validation->getError('user_full_name'),
                'user_email'     => $this->validation->getError('user_email'),
                'user_tel'       => $this->validation->getError('user_tel'),
                'user_sex'       => $this->validation->getError('user_sex'),
                'user_bio'       => $this->validation->getError('user_bio'),
                'user_role'      => $this->validation->getError('user_role'),
                'user_profile_picture' => $this->validation->getError('user_profile_picture'),
            ];

            $output = [
                'status' => false,
                'errors' => $errors
            ];
        }
        else {
            $data = [
                'user_name'      => $this->request->getPost('user_name'),
                'user_password'  => password_hash($this->request->getPost('user_password'), PASSWORD_DEFAULT), //NOTE Using PHP’s Password Hashing extension. https://codeigniter.com/user_guide/libraries/encryption.html#encryption-service (Just to see the 'Important' note!). https://www.php.net/manual/en/function.password-hash.php
                'user_full_name' => $this->request->getPost('user_full_name'),
                'user_email'     => $this->request->getPost('user_email'),
                'user_tel'       => $this->request->getPost('user_tel'),
                'user_sex'       => $this->request->getPost('user_sex'),
                'user_bio'       => $this->request->getPost('user_bio'),
                'user_role'      => $this->request->getPost('user_role'),
            ];

            $image = $this->request->getFile('user_profile_picture');
            
            if (file_exists($image)) {
                $imageName = $this->save_user_image($image); // Save image
                $data['user_profile_picture'] = $imageName;
            }

            $this->userModel->save($data);

            $output = [
                'status' => true
            ];
        }

        echo json_encode($output);
    }

    public function update() // AJAX
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }

        $rules = [
            'user_name'      => ['required'],
            // 'user_password'  => ['required'],
            'user_full_name' => ['required'],
            // 'user_email'     => ['required'],
            'user_tel'       => ['required'],
            'user_sex'       => ['required'],
            'user_bio'       => ['required'],
            // 'user_role'      => ['required'], // NOTE DANGER : Only use if register via admin!
            'user_profile_picture' => [ //TODO : set max 5! Problem with image names in SQL. Also don't forget the 'uploaded'!)
                'mime_in[user_profile_picture,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[user_profile_picture,4096]',
            ]
        ];

        // Optional updateable data
        $new_password = $this->request->getPost('user_password');
        if (!empty($new_password)) {
            $rules['user_password'] = 'required'; // TODO LATER! USELESS REQ!
        }

        // Admin-only updateable data
        if (session('role') == 'admin') {
            $rules['user_email'] = 'required';
            $rules['user_role'] = 'required';

            // Extra code
            $isLastAdmin = ($this->userModel->where('user_role', 'admin')->countAllResults()) == 1;
        }

        if (!$this->validate($rules)) {
            $errors = [
                'user_name'      => $this->validation->getError('user_name'),
                // 'user_password'  => $this->validation->getError('user_password'),
                'user_full_name' => $this->validation->getError('user_full_name'),
                // 'user_email'     => $this->validation->getError('user_email'),
                'user_tel'       => $this->validation->getError('user_tel'),
                'user_sex'       => $this->validation->getError('user_sex'),
                'user_bio'       => $this->validation->getError('user_bio'),
                // 'user_role'      => $this->validation->getError('user_role'),
                'user_profile_picture' => $this->validation->getError('user_profile_picture'),
            ];

            // Optional updateable data
            if (!empty($new_password)) {
                $errors['user_password'] = $this->validation->getError('user_password');
            }

            // Admin-only updateable data
            if (session('role') == 'admin') {
                $errors['user_email'] = $this->validation->getError('user_email');
                $errors['user_role'] = $this->validation->getError('user_role');
            }

            $output = [
                'status' => false,
                'errors' => $errors
            ];
        }
        else if ($this->request->getPost('uid') == session('id') && $isLastAdmin && $this->request->getPost('user_role') != 'admin') { // Prevent the last admin to change role
            $output = [
                'status' => false,
                'custom_error' => 'Sistem harus memiliki setidaknya satu admin!'
            ];
        }
        else {
            $uid = $this->request->getPost('uid');
            $user = $this->userModel->find($uid);

            if ($user->user_pk != session('id') && session('role') != 'admin') {
                $output = ['status' => false];
            }
            else {
                $data = [
                    'user_pk'        => $uid,
                    'user_name'      => $this->request->getPost('user_name'),
                    // 'user_password'  => password_hash($this->request->getPost('user_password'), PASSWORD_DEFAULT), //NOTE Using PHP’s Password Hashing extension. https://codeigniter.com/user_guide/libraries/encryption.html#encryption-service (Just to see the 'Important' note!). https://www.php.net/manual/en/function.password-hash.php
                    'user_full_name' => $this->request->getPost('user_full_name'),
                    // 'user_email'     => $this->request->getPost('user_email'),
                    'user_tel'       => $this->request->getPost('user_tel'),
                    'user_sex'       => $this->request->getPost('user_sex'),
                    'user_bio'       => $this->request->getPost('user_bio'),
                    // 'user_role'      => $this->request->getPost('user_role'),
                ];

                // Optional updateable data
                if (!empty($new_password)) {
                    $data['user_password'] = password_hash($new_password, PASSWORD_DEFAULT); //NOTE Using PHP’s Password Hashing extension. https://codeigniter.com/user_guide/libraries/encryption.html#encryption-service (Just to see the 'Important' note!). https://www.php.net/manual/en/function.password-hash.php
                }

                // Admin-only updateable data
                if (session('role') == 'admin') {
                    $data['user_email'] = $this->request->getPost('user_email');
                    $data['user_role'] = $this->request->getPost('user_role');
                }

                $isUpdateImg = $this->request->getPost('cb_update_image');

                if ($isUpdateImg == true) {
                    $old_image = $user->user_profile_picture;
    
                    if (!empty($old_image)) {
                        $this->delete_user_image($old_image); // Remove image
                    }

                    $image = $this->request->getFile('user_profile_picture');
                    
                    if (file_exists($image)) {
                        $imageName = $this->save_user_image($image); // Save image
                        $data['user_profile_picture'] = $imageName;
                    }
                    else {
                        $data['user_profile_picture'] = 'default.png'; // Can't be "empty" use default image
                    }

                    // Update session data : picture (if owner)
                    if (session('id') == $uid) {
                        session()->remove('picture');
                        session()->set('picture', $data['user_profile_picture']);
                    }

                    $output = [
                        'image' => $data['user_profile_picture'],
                        'image_change' => true,
                        'status' => true
                    ];

                }
                else {
                    $output = ['status' => true];
                }
                
                // Update session data : full_name (if owner)
                if (session('id') == $uid) {
                    session()->remove('full_name');
                    session()->set('full_name', $data['user_full_name']);
                }

                $this->userModel->save($data);
            }
        }

        echo json_encode($output);
    }

    public function delete() // AJAX. TODO BROKEN. Maybe related to DB?
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }
        
        $uid  = $this->request->getPost('uid');
        $user = $this->userModel->find($uid);

        if (session('role') != 'admin') {
            echo json_encode(['status' => false]);
        }
        else {
            $this->delete_user_image($user->user_profile_picture); // Remove image
            
            $this->userModel->delete($user->user_pk);
            echo json_encode(['status' => true]);
        }
    }

    public function detail($uid)
    {   
        $user = $this->userModel->find($uid);
        
        if (!empty($user)) {
            return view('user/user_detail', ['user' => $user]);
        }
        else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function save_user_image($image) // Return image name (string)
    {
        $image_man = \Config\Services::image();
        
        if($image->isValid() && !$image->hasMoved()) {
            // Saving image
            $name = $image->getRandomName();
            $image->move(WRITEPATH . 'uploads/users', $name);

            // Thumbnail Creation
            $image_man
                ->withFile(WRITEPATH . 'uploads/users/' . $name)
                ->fit(100, 100, 'center')
                ->save(WRITEPATH . 'uploads/users/thumb' . $name);
        }     
    
        return $name;
    }

    public function delete_user_image($image)
    {
        if ($image != 'default.png') {
            unlink(WRITEPATH . 'uploads/users/' . $image);
            unlink(WRITEPATH . 'uploads/users/thumb' . $image);
        }
    }
}