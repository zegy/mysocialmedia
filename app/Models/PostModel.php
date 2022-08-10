<?php

namespace App\Models;

use CodeIgniter\Model; 
use App\Models\HomeModel;

class PostModel extends Model
{
    protected $table         = 't_post';
    protected $primaryKey    = 'post_pk';
    protected $returnType    = 'array';
    protected $allowedFields =
    [
        'post_fk_user',
        'post_text',
        'post_date_time'
    ];
    
    public function checkOwnership($pid, $uid) // verify post owner
    {
        $vpost = $this->where('post_pk', $pid)->first();
                         
        if($vpost)
        {
            return ($vpost['post_fk_user'] == $uid);
        }
        else
        {    
            return false;
        }
    }
    
    public function getAllByKeyword(string $keyword) : array // keyword search in search
    {
        $this->homeModel = new HomeModel();
        $res = $this->homeModel->like('texto', $keyword)
                               ->get()
                               ->getResult();
        return $res;
    }                        
}
