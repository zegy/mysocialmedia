<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PostModel;

class User extends BaseController
{
    function __construct()
    {
        $this->userModel  = new UserModel();
        $this->postsModel = new PostModel();
    }

    public function index()
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
                'pager' => $pager
            ];
                
            echo json_encode([
                'status' => true,
                'users'  => view('user/user_list', $dataView)
            ]);
        }
        else {
            echo json_encode([
                'status' => false
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
                'pager' => $pager
            ];
                
            echo json_encode([
                'status' => true,
                'users'  => view('user/user_list', $dataView)
            ]);
        }
        else {
            echo json_encode([
                'status' => false
            ]);
        }
    }

    public function create() // AJAX
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }

        $rules = [
            'user_id_mix'    => ['required', 'max_length[250]'],
            'user_password'  => ['required', 'max_length[250]'],
            'conf_user_password' => ['required', 'matches[user_password]'],
            'user_full_name' => ['required', 'max_length[250]'],
            'user_email'     => ['required', 'valid_email', 'is_unique[t_user.user_email]'],
            'user_sex'       => ['required'],
            'user_role'      => ['required'] // NOTE DANGER : Only use if register via admin!
        ];

        if (!$this->validate($rules)) {
            foreach ($rules as $key => $value) {
                $errors[$key] = $this->validation->getError($key);
            }

            $output = [
                'status' => false,
                'errors' => $errors
            ];
        }
        else {
            if (session('role') != 'admin') {
                $output['status'] = false;
            }
            else {
                $data = [
                    'user_id_mix'    => $this->request->getPost('user_id_mix'),
                    'user_password'  => password_hash($this->request->getPost('user_password'), PASSWORD_DEFAULT), //NOTE Using PHP’s Password Hashing extension. https://codeigniter.com/user_guide/libraries/encryption.html#encryption-service (Just to see the 'Important' note!). https://www.php.net/manual/en/function.password-hash.php
                    'user_full_name' => $this->request->getPost('user_full_name'),
                    'user_email'     => $this->request->getPost('user_email'),
                    'user_tel'       => $this->request->getPost('user_tel'),
                    'user_sex'       => $this->request->getPost('user_sex'),
                    'user_bio'       => $this->request->getPost('user_bio'),
                    'user_role'      => $this->request->getPost('user_role')
                ];
    
                $image = $this->request->getFile('user_profile_picture');
                
                if (file_exists($image)) {
                    $imageName = $this->save_user_image($image); // Save image
                }

                $data['user_profile_picture'] = $imageName ?? 'default.png'; // Can't be "empty" use default image
    
                $this->userModel->save($data);
    
                $output['status'] = true;
            }
        }
        echo json_encode($output);
    }

    public function update() // AJAX
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }

        $rules = [
            'user_id_mix'    => ['required', 'max_length[250]'],
            'user_full_name' => ['required', 'max_length[250]'],
            'user_tel'       => ['required', 'numeric'],
            'user_sex'       => ['required'],
            'user_bio'       => ['required', 'max_length[250]'],
            'user_profile_picture' => [ //TODO : set max 5! Problem with image names in SQL. Also don't forget the 'uploaded'!)
                'mime_in[user_profile_picture,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[user_profile_picture,4096]'
            ]
        ];

        // Optional updateable data
        $new_password = $this->request->getPost('user_password');
        if (!empty($new_password)) {
            $rules['user_password'] = 'max_length[250]';

            $rules['conf_user_password'][0] = 'required';
            $rules['conf_user_password'][1] = 'max_length[250]';
            $rules['conf_user_password'][2] = 'matches[user_password]';
        }

        // Admin-only updateable data
        if (session('role') == 'admin') {
            $rules['user_email'][0] = 'required';
            $rules['user_email'][1] = 'valid_email';
            // $rules['user_email'][2] = 'is_unique[t_user.user_email]'; //TODO (DANGER) : Set condition / rule if email is exactly same as current "update" user

            $rules['user_role']  = 'required';
        }

        if (!$this->validate($rules)) {
            foreach ($rules as $key => $value) {
                $errors[$key] = $this->validation->getError($key);
            }

            $output = [
                'status' => false,
                'errors' => $errors
            ];
        }
        else {
            $uid  = $this->request->getPost('uid');
            $user = $this->userModel->find($uid);

            $updatable = true; // Default value (Changeable with below code)
            if ($user->user_role == 'admin' && $this->request->getPost('user_role') != 'admin') { // Prevent the last admin to change role
                $isLastAdmin = $this->userModel->where('user_role', 'admin')->countAllResults() == 1;
                if ($isLastAdmin) {

                    $output['custom_error'] = 'Sistem harus memiliki setidaknya satu admin!';
                    
                    $updatable = false;
                } 
            }
            else if ($user->user_pk != session('id') && session('role') != 'admin') {
                $updatable = false;
            }
        
            if ($updatable) {
                $data = [
                    'user_pk'        => $uid,
                    'user_id_mix'    => $this->request->getPost('user_id_mix'),
                    'user_full_name' => $this->request->getPost('user_full_name'),
                    'user_tel'       => $this->request->getPost('user_tel'),
                    'user_sex'       => $this->request->getPost('user_sex'),
                    'user_bio'       => $this->request->getPost('user_bio')
                ];

                // Optional updateable data
                if (!empty($new_password)) {
                    $data['user_password'] = password_hash($new_password, PASSWORD_DEFAULT); //NOTE Using PHP’s Password Hashing extension. https://codeigniter.com/user_guide/libraries/encryption.html#encryption-service (Just to see the 'Important' note!). https://www.php.net/manual/en/function.password-hash.php
                }

                // Admin-only updateable data
                if (session('role') == 'admin') {
                    $data['user_email'] = $this->request->getPost('user_email');
                    $data['user_role']  = $this->request->getPost('user_role');
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
                    }

                    $data['user_profile_picture'] = $imageName ?? 'default.png'; // Can't be "empty" use default image

                    $output = [
                        'image' => $data['user_profile_picture'],
                        'image_change_in_profile' => true
                    ];

                    // Update session data : picture (Owner only)
                    if (session('id') == $uid) {
                        session()->remove('picture');
                        session()->set('picture', $data['user_profile_picture']);

                        $output['image_change_in_layout'] = true;
                    }
                }
                
                // Update session data : full_name (Owner only)
                if (session('id') == $uid) {
                    session()->remove('full_name');
                    session()->set('full_name', $data['user_full_name']);
                }

                $this->userModel->save($data);
                
                $output['status'] = true;
            }
            else {
                $output['status'] = false;
            }
        }
        echo json_encode($output);
    }

    public function delete() // AJAX. TODO (pending) : Destroy deleted user's session
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }
        
        $uid  = $this->request->getPost('uid');
        $user = $this->userModel->find($uid);

        if (session('role') != 'admin' || $user->user_pk == session('id')) { // Notice it's uncommon "if". Read : "Not an admin" OR "Self delete". Delete button is disabled in view.
            $output['status'] = false;
        }
        else {
            $this->delete_user_image($user->user_profile_picture); // Remove image (profile picture)

            //Remove images (posts)
            $user_posts = $this->postsModel->where('post_fk_user', $uid)->findAll();
            foreach ($user_posts as $user_post) {
                $images = explode(',', $user_post->post_img);
                foreach ($images as $image) {
                    unlink(WRITEPATH . 'uploads/posts/' . $image);
                    unlink(WRITEPATH . 'uploads/posts/thumb' . $image);
                }
            }
            
            $this->userModel->delete($user->user_pk);

            $output['status'] = true;
        }
        echo json_encode($output);
    }

    public function detail($uid)
    {   
        $user = $this->userModel->find($uid);
        
        if (empty($user)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        else {
            return view('user/user_detail', ['user' => $user]);
        }
    }

    public function sum_modal() // AJAX
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }

        $uid  = $this->request->getPost('uid');
        $user = $this->userModel->find($uid);
            
        echo json_encode([
            'status' => true,
            'user_sum_modal' => view('user/user_sum_modal', ['user' => $user])
        ]);
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

    public function create_token() // AJAX
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }

        $data = [
            'user_pk'    => session('id'),
            'user_token' => $this->request->getPost('token')
        ];

        $this->userModel->save($data);
    
        echo json_encode(['status' => true]);
    }

    public function delete_token() // AJAX
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }

        $data = [
            'user_pk'    => session('id'),
            'user_token' => null
        ];

        $this->userModel->save($data);
    
        echo json_encode(['status' => true]);
    }
}