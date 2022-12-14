<?php namespace App\Controllers;
 // ZEGY OTC no basecontroller? is it really needed?
use App\Models\NotificationModel;
use App\Models\PostModel;
use App\Models\CommentModel;

class Notification extends BaseController
{
    function __construct()
    {
        helper('form');
        $this->notificationModel = new NotificationModel();
    }

    public function onFCM()
    {
        $token = $this->request->getVar('token');
        $data  = $this->notificationModel->where(array('user_pk' => session('id')))->first();
        $on    = $this->notificationModel->update($data['user_pk'], array('user_token' => $token));

        if ($on)
        {
            $res = 'Notifikasi berhasil aktif!';
        }
        else
        {
            $res = 'Notifikasi gagal aktif!'; // ZEGY OTC is it really working?
        }
        return json_encode($res);
    }

///////////////////////////////////////// done







    public function sendFCM($data)
    {
        $post      = new PostModel();
        $poster    = $post->where(array('post_pk' => $data["post_id"]))->first();
        $poster_id = $poster["post_fk_user"];

        $sendFCM   = new NotificationModel();
        $user      = $sendFCM->where(array('user_pk' => $poster_id))->first();
        $commenter = $sendFCM->where(array('user_pk' => $data["user_id"]))->first();

        $title     = 'DIPSI';
        $body      = $commenter["user_full_name"].' '.'Mengomentari Postingan Anda!';
        $link_base = base_url("comment/show").'/'.$data["post_id"];

        $url = "https://fcm.googleapis.com/fcm/send";

        $fields = array(
            "to"=>$user["user_token"],
            "notification"=>array(
                "body"         => $body,
                "title"        => $title,
                "icon"         => 'icon',
                "click_action" => $link_base
            )
        );

        $headers = array(
            'Authorization: key=AAAA6TW0j0o:APA91bFErAe4EPZ5qLRRlksCSJxqsz6P6c-TxJRghGWGgOZxSOsNelKVhKrJvsYTRX0TzaioS1OH7jiFuIgNIlhx_auLCbNsozL6HUqxMt8fFdfIGeeE-2KEl0lFhUNAdTSyZhNOeb1w',
            'Content-Type:application/json'
        );

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
        $result = curl_exec($ch);
        print_r($result);
        curl_close($ch);
    }
}