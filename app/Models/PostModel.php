<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table         = 't_post';
    protected $primaryKey    = 'post_pk';
    protected $returnType    = 'object';
    protected $allowedFields =
    [
        'post_fk_user',
        'post_title',
        'post_text',
        'post_group',
        'post_img'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'post_date_time';
    protected $updatedField; //NOTE It's needed by "useTimestamps" even if we not use it. https://codeigniter.com/user_guide/models/model.html?highlight=find#usetimestamps

    //NOTE Custom var with "standard query" string (instead of CI's Model and Query Builder)
    protected $selected = '
        post_pk,
        post_title,
        post_text,
        post_date_time,
        post_group,
        post_img,
        user_pk,
        user_id_mix,
        user_full_name,
        user_profile_picture,
        user_role,
        user_bio,
        (SELECT COUNT(*) FROM t_comment WHERE comment_fk_post = post_pk) AS qtdcom
    ';
    
    public function getOneById($pid) //TODO "qtdcom" not used in the view, need to add later?
    {
        return $this->select($this->selected)
                    ->join('t_user', 'post_fk_user = user_pk')
                    ->where('post_pk', $pid) //TODO Why not using "find($pid)" ?
                    ->first();
    }

    public function getAllByGroup($group, $page = null)
    {
        return $this->select($this->selected)
                    ->join('t_user', 'post_fk_user = user_pk')
                    ->where('post_group', $group)
                    ->orderBy('post_pk', 'DESC')
                    ->paginate(5, 'default', $page);
    }

    public function getAllByGroupAndKeyword($keyword, $group, $page = null)
    {
        return $this->select($this->selected)
                    ->join('t_user', 'post_fk_user = user_pk')
                    ->where('post_group', $group)
                    ->like('post_title', $keyword)
                    ->orderBy('post_pk', 'DESC')
                    ->paginate(5, 'default', $page);
    }

    public function getAllByUser($user)
    {
        return $this->select($this->selected)
                    ->join('t_user', 'post_fk_user = user_pk')
                    ->where('post_fk_user', $user)
                    ->orderBy('post_pk', 'DESC')
                    ->get()
                    ->getResult();
    }

    public function getUmumByUser($user)
    {
        return $this->select($this->selected)
                    ->join('t_user', 'post_fk_user = user_pk')
                    ->where([
                        'post_fk_user' => $user,
                        'post_group ='  => 'umum'
                      ])
                    ->orderBy('post_pk', 'DESC')
                    ->get()
                    ->getResult();
    }

    public function getAllByKeyword($keyword)
    {   
        return $this->select($this->selected)
                    ->join('t_user', 'post_fk_user = user_pk')
                    ->like('post_title', $keyword)
                    ->get()
                    ->getResult();
    }
}

/*NOTE
    The Model does not provide a perfect interface to the Query Builder.
    The Model and the Query Builder are separate classes with different purposes.
    Example : "select()" and "join()" is part of Query Builder, "find()" and "paginate()" is part of Model.
    Query Builder methods and Model’s CRUD methods can be in the same chained call.
    https://codeigniter.com/user_guide/models/model.html?highlight=find#working-with-query-builder
*/