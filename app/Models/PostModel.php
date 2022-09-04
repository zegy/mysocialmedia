<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\HomeModel;
use App\Models\UserModel;

class PostModel extends Model
{
    protected $table         = 't_post';
    protected $primaryKey    = 'post_pk';
    // protected $returnType    = 'array';
    protected $allowedFields =
    [
        'post_fk_user',
        'post_text',
        'post_date_time',
        'post_type'
    ];

    public function getAllPost($postType, $perPage = null, $offset = null)
    {
        $builder = $this->db->table('t_post')
            ->select('
                        post_pk              as pid,
                        post_text            as texto,
                        post_date_time       as data,
                        post_type            as type,
                        user_pk              as uid,
                        user_full_name       as nome,
                        user_profile_picture as image,
                        user_role            as role,
                        ( select count(*) from t_comment
                            where comment_fk_post = post_pk ) as qtdcom
                    ')
            ->join('t_user', 'post_fk_user = user_pk')
            ->where('post_type', $postType)
            ->limit($perPage, $offset)
            ->orderBy('post_pk', 'DESC');
        $data['total'] = $builder->countAllResults(false); // count all result (not limited by "limit"). This "countAllResults" method also resets any field values that you may have passed to select(). If you need to keep them, you can pass false as the first parameter. https://codeigniter.com/user_guide/database/query_builder.html?highlight=builder#builder-countallresults
        $data['result'] = $builder->get()->getResult(); // get all result (limited by "limit")
        return $data;
    }

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
        $builder = $this->db->table('t_post')
            ->select('
                        post_pk              as pid,
                        post_text            as texto,
                        post_date_time       as data,
                        post_type            as type,
                        user_pk              as uid,
                        user_full_name       as nome,
                        user_profile_picture as image,
                        user_role            as role
                    ')
            ->join('t_user', 'post_fk_user = user_pk')
            ->where('post_pk', $pid);
        return $builder->get()->getFirstRow(); // single result. multi result = "$builder->get()->getResult()". best for looping in view. Set [key] in controller!
    }
}