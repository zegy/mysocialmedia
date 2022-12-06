<?php

namespace App\Models;

use CodeIgniter\Model;

class NotifModel extends Model
{
    protected $table         = 't_notif';
    protected $primaryKey    = 'notif_pk';
    protected $returnType    = 'object';
    protected $allowedFields =
    [
        'notif_to_fk_user',
        'notif_from_fk_user',
        'notif_type',
        'notif_fk_post'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'notif_date_time';
    protected $updatedField; //NOTE It's needed by "useTimestamps" even if we not use it. https://codeigniter.com/user_guide/models/model.html?highlight=find#usetimestamps

    //NOTE Custom var with "standard query" string (instead of CI's Model and Query Builder)
    protected $selected = '
        notif_pk,
        notif_type,
        notif_date_time,
        (SELECT post_group FROM t_post WHERE notif_fk_post = post_pk) AS post_group,
        (SELECT post_pk FROM t_post WHERE notif_fk_post = post_pk) AS post_pk,
        (SELECT user_full_name FROM t_user WHERE notif_from_fk_user = user_pk) AS from_user_full_name,
        (SELECT user_profile_picture FROM t_user WHERE notif_from_fk_user = user_pk) AS from_user_profile_picture
    ';

    public function getAllByCurrentUser($user)
    {
        return $this->select($this->selected)
                    ->join('t_user', 'notif_to_fk_user = user_pk')
                    ->where('notif_to_fk_user', $user)
                    ->orderBy('notif_pk', 'DESC')
                    ->findAll();
    }

    public function countAllByCurrentUser($user)
    {
        return $this->join('t_user', 'notif_to_fk_user = user_pk')
                    ->where('notif_to_fk_user', $user)
                    ->countAllResults();
    }
}

/*NOTE
    The Model does not provide a perfect interface to the Query Builder.
    The Model and the Query Builder are separate classes with different purposes.
    Example : "select()" and "join()" is part of Query Builder, "find()" and "paginate()" is part of Model.
    Query Builder methods and Model’s CRUD methods can be in the same chained call.
    https://codeigniter.com/user_guide/models/model.html?highlight=find#working-with-query-builder
*/