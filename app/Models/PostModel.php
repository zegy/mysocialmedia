<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\HomeModel;
use App\Models\UserModel;

class PostModel extends Model
{
    protected $table         = 't_post';
    protected $primaryKey    = 'post_pk';
    protected $returnType    = 'array';
    protected $allowedFields =
    [
        'post_fk_user',
        'post_text',
        'post_date_time',
        'post_type'
    ];

    public function getAllByKeyword(string $keyword) : array // keyword search in search
    {
        $this->homeModel = new HomeModel();
        $res = $this->homeModel->like('texto', $keyword)
                               ->get()
                               ->getResult();
        return $res;
    }

    public function getSpecificPost($pid)
    {
        $builder = $this->db->table('t_post p');
        $builder->select('
                            p.post_pk as pid,
                            p.post_text as texto,
                            p.post_date_time as data,
                            p.post_type as type,
                            u.user_pk as uid,
                            u.user_full_name as nome,
                            u.user_profile_picture as image,
                            u.user_role as role
                        ');
        $builder->join('t_user u ', 'p.post_fk_user = u.user_pk');
        $builder->where('p.post_pk', $pid);
        // $queryPost = $builder->get()->getResult(); // multi result, best for looping in view. Set [key] in controller!
        $queryPost = $builder->get()->getFirstRow(); // single result
        // dd ($queryPost);
        return $queryPost;
    }
}