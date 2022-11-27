<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\LikeModel; //TODO : Not need to create spesific controller?

class Comment extends BaseController
{
    function __construct()
    {
        $this->commentModel = new CommentModel();
        $this->likeModel = new LikeModel(); //TODO : Not need to create spesific controller?
    }

    public function list() // AJAX
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }
        
        $pid = $this->request->getPost('pid');
        $comments = $this->commentModel->getAllByPost($pid);
        
        if (!empty($comments)) {
            echo json_encode([
                'status'         => true,
                'comments'       => view('comment/comment_list', ['comments' => $comments]),
                'comments_count' => $this->commentModel->getCountComment($pid)
            ]);
        }
        else {
            echo json_encode(['status' => false]);
        }
    }

    public function save () //NOTE : AJAX. Single create + update function. TODO : Check owner before update?
    {
        if ($this->request->isAJAX())
        {
            $validated = $this->validate([
                'komentar' => ['required']
            ]);

            if (!$validated) //NOTE : IF NOT VALID = return error array with the key and value for each input (only key with empty value for input with no error)
            {
                $errors = [ //NOTE : 'getErrors()' did not return input field that 'valid', hence the 'Getting a Single Error' used instead.
                    'komentar' => $this->validation->getError('komentar')
                ];

                $output = [
                    'errors' => $errors,
                    'status' => false
                ];

                echo json_encode($output);
            }
            else //NOTE : IF VALID
            {
                $cid = $this->request->getPost('cid'); //NOTE : To decide if it's create or update comment. If no cid (null) = create comment. Otherwise it's update comment
                if (empty($cid)) //NOTE : Create
                {
                    $data = [
                        'comment_fk_user'   => session('id'),
                        'comment_fk_post'   => $this->request->getPost('pid'),
                        'comment_text'      => $this->request->getPost('komentar'),
                    ];

                    $this->commentModel->save($data);
                    $pid = $this->commentModel->insertID(); //NOTE : Get ID from the last insert. TODO : What if other user do the insert?
                }
                else //NOTE : Update
                {
                    $data = [
                        'comment_pk'   => $cid,
                        'comment_text' => $this->request->getPost('komentar'),
                    ];
                    
                    $this->commentModel->save($data);
                }
                
                echo json_encode([
                    'status' => true
                ]);
            }
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function delete() // AJAX
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }

        $cid = $this->request->getPost('cid');
        $comment = $this->commentModel->find($cid);

        if ($comment->comment_fk_user != session('id') && session('role') != 'admin') {
            echo json_encode(['status' => false]);
        }
        else {
            $this->commentModel->delete($comment->comment_pk);
            echo json_encode(['status' => true]);
        }
    }

    public function like() // AJAX. NOTE : 0 = liked and 1 = disliked
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }
        
        $cid = $this->request->getPost('cid');
        
        $like = $this->likeModel->where(['like_fk_user' => session('id'), 'like_fk_comment' => $cid])->find();
        
        $type = $this->request->getPost('type');
        
        if ($type == 'like') { // User like a comment
            if (!empty($like)) {
                if ($like[0]->like_status == 1) { // User like a disliked comment = Change dislike -> like
                    $data = [
                        'like_pk'     => $like[0]->like_pk,
                        'like_status' => 0,
                    ];

                    $this->likeModel->save($data);
                }
                else { // User like a comment that already liked = Delete
                    $this->likeModel->delete($like[0]->like_pk);   
                }
            }
            else { // New (Like)
                $data = [
                    'like_fk_user'    => session('id'),
                    'like_fk_comment' => $cid,
                    'like_status'     => 0,
                ];

                $this->likeModel->save($data);
            }
        }
        else { // User dislike a comment
            if (!empty($like)) {
                if ($like[0]->like_status == 0) { // User dislike a liked comment = Change like -> dislike
                    $data = [
                        'like_pk'     => $like[0]->like_pk,
                        'like_status' => 1,
                    ];

                    $this->likeModel->save($data);
                }
                else { // User dislike a comment that already disliked = Delete
                    $this->likeModel->delete($like[0]->like_pk);   
                }
            }
            else { // New (Dislike)
                $data = [
                    'like_fk_user'    => session('id'),
                    'like_fk_comment' => $cid,
                    'like_status'     => 1,
                ];

                $this->likeModel->save($data);
            }
        }

        echo json_encode(['status' => true]);
    }
}