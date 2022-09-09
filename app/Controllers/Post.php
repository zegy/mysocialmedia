<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;
use CodeIgniter\I18n\Time;

class Post extends BaseController
{
    function __construct()
    {
        helper('form');
        $this->postModel = new PostModel();
    }

    public function save()
    {
        $data = $this->request->getPost();

        if (!isset($data) || empty($data))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $currentTime = new Time('now', 'America/Recife', 'pt_BR'); // ZEGY OTC Change to indonesia

        if (isset($data["user_id"]) && session('id') != $data["user_id"])
        {
            return redirect()->to('/');
        }

        if (isset($data["post_id"]) && isset($data["text"])) // update post
        {
            $dataToSave =
            [
                "post_pk"   => $data["post_id"],
                "post_text" => $data["text"]
            ];
        }
        else if (isset( $data["user_id"]) &&  $data["text"]) // new post
        {
            $dataToSave =
            [
                "post_fk_user"   => $data["user_id"],
                "post_text"      => $data["text"],
                "post_date_time" => ((array)$currentTime)['date'],
                "post_type"      => $data['type']
            ];
        }
        else
        {
            return redirect()->to('/');
        }

        $request = $this->postModel->save($dataToSave);

        if ($request)
        {
            return redirect()->to('/');
        }
        else
        {
            // ZEGY OTC ERROR
        }
    }

    public function delete($pid)
    {
        $post = $this->postModel->find($pid);

        if (!empty($post))
        {
            if (session('id') == $post->post_fk_user)
            {
                $this->postModel->delete($pid);
                return redirect()->to('/');
            }
            else
            {
                return redirect()->to('/'); // ZEGY OTC INVALID OWNER
            }
        }
        else
        {
            return redirect()->to('/'); // ZEGY OTC 404 POST NOT FOUND
        }
    }

    public function edit($pid)
    {
        $post = $this->postModel->find($pid);

        if (!empty($post))
        {
            if (session('id') == $post->post_fk_user)
            {
                echo view('forms/form_edit_post', ['post' => $post]);
            }
            else
            {
                return redirect()->to('/'); // ZEGY OTC INVALID OWNER
            }
        }
        else
        {
            return redirect()->to('/'); // ZEGY OTC 404 POST NOT FOUND
        }
    }
}