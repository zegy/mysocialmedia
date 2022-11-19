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

    // public function index($pid)
    // {
    //     return view('post/comment_index', ["pid" => $pid]);
    // }

    public function list() //NOTE : AJAX
    {
        if ($this->request->isAJAX())
        {
            $pid = $this->request->getPost('pid');
            $comments = $this->commentModel->getAllByPost($pid);
            
            if (!empty($comments))
            {     
                echo json_encode([
                    'comments'  => view('comment/comment_list', ["comments" => $comments]),
                    'status' => true
                ]);
            }
            else
            {
                echo json_encode(['status' => false]);
            }
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function save () //NOTE : AJAX. Single create + update function
    {
        if ($this->request->isAJAX())
        {
            $validated = $this->validate([
                'komentar' => ['required']
            ]);

            if (!$validated) //NOTE : IF NOT VALID = return error array with the key and value for each input (only key with empty value for input with no error)
            {
                $errors = [ //NOTE : "getErrors()" did not return input field that "valid", hence the "Getting a Single Error" used instead.
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
                        "comment_fk_user"   => session('id'),
                        "comment_fk_post"   => $this->request->getPost('pid'),
                        "comment_text"      => $this->request->getPost('komentar'),
                    ];

                    $this->commentModel->save($data);
                    $pid = $this->commentModel->insertID(); //NOTE : Get ID from the last insert. TODO : What if other user do the insert?
                }
                else //NOTE : Update
                {
                    $data = [
                        "comment_pk"   => $cid,
                        "comment_text" => $this->request->getPost('komentar'),
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

    public function delete() //NOTE : AJAX
    {
        if ($this->request->isAJAX())
        {
            $cid = $this->request->getPost('cid');            
            $this->commentModel->delete($cid);
            echo json_encode(['status' => true]);
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function like() //NOTE : AJAX (0 = liked, 1 = disliked)
    {
        if ($this->request->isAJAX())
        {
            $cid = $this->request->getPost('cid');

            $dataLike = [
                "like_fk_user"    => session('id'),
                "like_fk_comment" => $cid,
            ];
            
            $like = $this->likeModel->where($dataLike)->find();
            
            $type = $this->request->getPost('type');
            
            if ($type == 'like')
            {
                if (!empty($like))
                {
                    if ($like[0]->like_status == 1)
                    {
                        $data = [
                            "like_pk"     => $like[0]->like_pk,
                            "like_status" => 0,
                        ];

                        $this->likeModel->save($data);
                    }
                    else
                    {
                        $this->likeModel->delete($like[0]->like_pk);   
                    }
                }
                else
                {
                    $data = [
                        "like_fk_user"    => session('id'),
                        "like_fk_comment" => $cid,
                        "like_status"     => 0,
                    ];

                    $this->likeModel->save($data);
                }
            }
            else //NOTE : Type = "dislike"
            {
                if (!empty($like))
                {
                    if ($like[0]->like_status == 0)
                    {
                        $data = [
                            "like_pk"     => $like[0]->like_pk,
                            "like_status" => 1,
                        ];

                        $this->likeModel->save($data);
                    }
                    else
                    {
                        $this->likeModel->delete($like[0]->like_pk);   
                    }
                }
                else
                {
                    $data = [
                        "like_fk_user"    => session('id'),
                        "like_fk_comment" => $cid,
                        "like_status"     => 1,
                    ];

                    $this->likeModel->save($data);
                }
            }

            echo json_encode(['status' => true]);
        }
        else
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}