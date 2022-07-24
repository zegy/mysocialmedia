<?php namespace App\Controllers;

use App\Models\NotificationModel;
use App\Models\CommentModel;
use App\Models\PostModel;

class Notification extends BaseController
{ 
    public function onFCM()
    {
        $notificationModel = new NotificationModel();
        
        $session = session('id');
        $token = $this->request->getVar('token');
        
        $data = $notificationModel->where(array('user_pk' => $session))->first();

        $notificationModel->update($data['user_pk'], array('user_token' => $token));
        
        if ($notificationModel) {
            $res['status'] = '1';
            $res['message'] = 'Token Berhasil Disimpan!';
        }
        else {
            $res['status'] = '0';
            $res['message'] = 'Token Gagal Disimpan!';
        }
        return json_encode($res);
    }

    public function sendFCM($data)
    {
        $post = new PostModel();
        $poster = $post->where(array('post_pk' => $data["post_id"]))->first();
        $poster_id = $poster["post_fk_user"];

       
        $sendFCM = new NotificationModel();
        $user = $sendFCM->where(array('user_pk' => $poster_id))->first();
        $commenter = $sendFCM->where(array('user_pk' => $data["user_id"]))->first();

        $title = 'DIPSI';
        $body = $commenter["user_full_name"].' '.'Mengomentari Postingan Anda!';

        $link_base = base_url("comment/show").'/'.$data["post_id"];
                      
        $url ="https://fcm.googleapis.com/fcm/send";

        $fields=array(
            "to"=>$user["user_token"],
            "notification"=>array(
                "body"=>$body,
                "title"=>$title,
                "icon"=>'icon',
                "click_action"=>$link_base,
            )
        );

        $headers=array(
            'Authorization: key=AAAA6TW0j0o:APA91bFErAe4EPZ5qLRRlksCSJxqsz6P6c-TxJRghGWGgOZxSOsNelKVhKrJvsYTRX0TzaioS1OH7jiFuIgNIlhx_auLCbNsozL6HUqxMt8fFdfIGeeE-2KEl0lFhUNAdTSyZhNOeb1w',
            'Content-Type:application/json'
        );

        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
        $result=curl_exec($ch);
        print_r($result);
        curl_close($ch);
    }

}