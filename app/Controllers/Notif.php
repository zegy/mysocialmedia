<?php

namespace App\Controllers;

use App\Controllers\BaseController;
// use App\Models\CommentModel;
// use App\Models\LikeModel; //TODO : Not need to create spesific controller?
use App\Models\NotifModel;
// use App\Models\PostModel; //TODO : Right to do so?

class Notif extends BaseController
{
    function __construct()
    {
        // $this->commentModel = new CommentModel();
        // $this->likeModel = new LikeModel(); //TODO : Not need to create spesific controller?
        $this->notifModel = new NotifModel(); //TODO : Not need to create spesific controller?
        // $this->postModel = new PostModel(); //TODO : Right to do so?
    }

    public function list() // AJAX
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }
        
        $notifs = $this->notifModel->where('notif_to_fk_user', session('id'))->findAll();
        
        if (!empty($notifs)) {
            echo json_encode([
                'status'         => true,
                'notifs'         => view('notif/notif_list', ['notifs' => $notifs]),
                // 'comments_count' => $this->commentModel->getCountComment($pid)
            ]);
        }
        else {
            echo json_encode(['status' => false]);
        }
    }

    public function delete_all() // AJAX
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }

        $notifs = $this->notifModel->where('notif_to_fk_user', session('id'))->delete();

        echo json_encode(['status' => true]);
    }

    // public function create() // AJAX
    // {
    //     if (!$this->request->isAJAX()) {
    //         throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
    //     }

    //     $rules = ['komentar' => ['required']];

    //     if (!$this->validate($rules))
    //     {
    //         $errors = [
    //             'komentar' => $this->validation->getError('komentar')
    //         ];

    //         $output = [
    //             'errors' => $errors,
    //             'status' => false
    //         ];
    //     }
    //     else {            
    //         $data = [
    //             'comment_fk_user' => session('id'),
    //             'comment_fk_post' => $this->request->getPost('pid'),
    //             'comment_text'    => $this->request->getPost('komentar'),
    //         ];

    //         $this->commentModel->save($data);
            
    //         $output = ['status' => true];
    //     }



    //     $post = $this->postModel->find($this->request->getPost('pid'));
    //     $post_owner = $post->post_fk_user;

    //     $data_notif = [
    //         'notif_to_fk_user'   => $post_owner,
    //         'notif_from_fk_user' => session('id'),
    //         'notif_type'         => 'comment',
    //     ];

    //     $this->notifModel->save($data_notif);

    //     // FCM START
    //     // Using PHP's "cURL Functions". Failed to use CI's "CURLRequest" Class. Ref : part-1-experimental AND https://shareurcodes.com/blog/send%20push%20notification%20to%20users%20using%20firebase%20messaging%20service%20in%20php
    //     $fields = [
    //         "notification" => [
    //             "body"         => 'Ada yang mengomentari postingan anda!',
    //             "title"        => 'DIPSI',
    //             "icon"         => 'icon',
    //             "click_action" => base_url('group/umum')
    //         ],
    //         "to" => "eU-gPExR5cIfiVFV4Jwie4:APA91bHfXkAYjxRww2dGhDxGkQlGjL5yqdhpBe4aofHTQ2Vm5lpo9utrk-s4NOlqtuojIKH3yMPNRmGCMO_BqxM_axH2MBY8NWzbFL8GQBnRsBK5e_8Hs39JA06qkofeyvb98M4dSKI9"
    //     ];

    //     $headers = [ // Danger! Notice it's not an associative array!
    //         'Authorization: key=AAAArTff7d4:APA91bFQArT9HUGgZtPk7EDV3pFKX3DozsU4_qy8mSLZ1VYzgufVrTJN_h627bVzhm4Izq4Bu8PLpllmg8CCW-EjU8XKzoW_LvoypqFi7I_jUyUGk3gwnh_CwPapF-_oa_FKRZQ9Mlxn',
    //         'Content-Type: application/json'
    //     ];

    //     $ch = curl_init();
    //     curl_setopt($ch,CURLOPT_URL,'https://fcm.googleapis.com/fcm/send');
    //     curl_setopt($ch,CURLOPT_POST,true);
    //     curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    //     curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    //     curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
    //     curl_exec($ch);
    //     curl_close($ch);
    //     // FCM END

    //     echo json_encode($output);
    // }

    // public function update() // AJAX
    // {
    //     if (!$this->request->isAJAX()) {
    //         throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
    //     }

    //     $rules = ['update_komentar' => ['required']];

    //     if (!$this->validate($rules))
    //     {
    //         $errors = [
    //             'update_komentar' => $this->validation->getError('update_komentar')
    //         ];

    //         $output = [
    //             'errors' => $errors,
    //             'status' => false
    //         ];
    //     }
    //     else {
    //         $cid = $this->request->getPost('cid');
    //         $comment = $this->commentModel->find($cid);

    //         if ($comment->comment_fk_user != session('id') && session('role') != 'admin') {
    //             $output = ['status' => false];
    //         }
    //         else {
    //             $data = [
    //                 'comment_pk'   => $cid,
    //                 'comment_text' => $this->request->getPost('update_komentar'),
    //             ];
                
    //             $this->commentModel->save($data);
    
    //             $output = ['status' => true];
    //         }
    //     }

    //     echo json_encode($output);        
    // }

    // public function delete() // AJAX
    // {
    //     if (!$this->request->isAJAX()) {
    //         throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
    //     }

    //     $cid = $this->request->getPost('cid');
    //     $comment = $this->commentModel->find($cid);

    //     if ($comment->comment_fk_user != session('id') && session('role') != 'admin') {
    //         echo json_encode(['status' => false]);
    //     }
    //     else {
    //         $this->commentModel->delete($comment->comment_pk);
    //         echo json_encode(['status' => true]);
    //     }
    // }

    // public function like() // AJAX. (0 = liked and 1 = disliked)
    // {
    //     if (!$this->request->isAJAX()) {
    //         throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
    //     }
        
    //     $cid = $this->request->getPost('cid');
        
    //     $like = $this->likeModel->where(['like_fk_user' => session('id'), 'like_fk_comment' => $cid])->find();
        
    //     $type = $this->request->getPost('type');
        
    //     if ($type == 'like') { // User like a comment
    //         if (!empty($like)) {
    //             if ($like[0]->like_status == 1) { // User like a disliked comment = Change dislike -> like
    //                 $data = [
    //                     'like_pk'     => $like[0]->like_pk,
    //                     'like_status' => 0,
    //                 ];

    //                 $this->likeModel->save($data);
    //             }
    //             else { // User like a comment that already liked = Delete
    //                 $this->likeModel->delete($like[0]->like_pk);   
    //             }
    //         }
    //         else { // New (Like)
    //             $data = [
    //                 'like_fk_user'    => session('id'),
    //                 'like_fk_comment' => $cid,
    //                 'like_status'     => 0,
    //             ];

    //             $this->likeModel->save($data);
    //         }
    //     }
    //     else { // User dislike a comment
    //         if (!empty($like)) {
    //             if ($like[0]->like_status == 0) { // User dislike a liked comment = Change like -> dislike
    //                 $data = [
    //                     'like_pk'     => $like[0]->like_pk,
    //                     'like_status' => 1,
    //                 ];

    //                 $this->likeModel->save($data);
    //             }
    //             else { // User dislike a comment that already disliked = Delete
    //                 $this->likeModel->delete($like[0]->like_pk);   
    //             }
    //         }
    //         else { // New (Dislike)
    //             $data = [
    //                 'like_fk_user'    => session('id'),
    //                 'like_fk_comment' => $cid,
    //                 'like_status'     => 1,
    //             ];

    //             $this->likeModel->save($data);
    //         }
    //     }

    //     echo json_encode(['status' => true]);
    // }
}