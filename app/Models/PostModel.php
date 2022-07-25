<?php

namespace App\Models;

use CodeIgniter\Model; 
use App\Models\HomeModel;

class PostModel extends Model
{
    
    protected $table         = 't_post';
    protected $primaryKey    = 'post_pk';
    protected $returnType    = 'array';

    protected $allowedFields = [ 'post_fk_user',
                                 'post_text',
                                 'post_date_time' ];


   

    protected $db;


    public function __construct() 
    {
        parent::__construct(); // don't forget to call parent constructor
        $this->db = \Config\Database::connect();
        $this->homeModel = new HomeModel();
    }


    public function getPostById(string $id){

        $builder = $this->builder();


        $builder->select('*');
      
        $builder->where("post_pk", $id);
        $res = $builder->get()->getResult()[0]->post_text; 

       return $res;

           
    }

    public function checkOwnership($pid, $uid) // verify post owner
    {
    
            $vpost = $this->where('post_pk', $pid)
                          ->first();
                         
        if($vpost) {
                 
          return ($vpost['post_fk_user'] == $uid);
          
        } else {
            
            return false;
        }
        
    }

    public function getLikesPost($pid)
    {
            
        //total number of likes on the post
              
        $builder = $this->builder('t_like l');

        $queryPostLikes =  $builder->select('count(*) as qtdlike')
                                   ->join('t_post p ', 'l.like_fk_post = p.post_pk')
                                   ->where("p.post_pk", $pid)
                                   ->get(); 

        return $queryPostLikes->getResult()[0]->qtdlike; 

                                                    
     }

     public function getUserLikesPost($pid, $uid) // get the number of likes from a user on a specific post
    {
            
               
        $builder = $this->builder('t_like l');
           
        $queryPostUserLikes =  $builder->select('count(*) as qtdlike')
                                       ->join('t_post p '   , 'l.like_fk_post = p.post_pk')
                                       ->join('t_user u ', 'l.like_fk_user = u.user_pk')
                                       ->where("u.user_pk = $uid and p.post_pk = $pid")
                                       ->get(); 
      
        
        return $queryPostUserLikes->getResult()[0]->qtdlike;

         
    }

 

     public function like($pid, $uid)  // method add like to specific post
     {
        
        //to-do: just add like if the user hasn't liked it yet (like == 0 )
      
        if ($this->getUserLikesPost($pid, $uid) >= 1) {
                
            $qtdlikePost =  $this->getLikesPost($pid);

            return $qtdlikePost;

       } else {

            $builder = $this->builder('t_like');
            
            $data = [ 'like_fk_post' => $pid,
                      'like_fk_user'  => $uid ];
            
            $builder->insert($data); //error here
    
    
            $qtdlikePost = $this->getLikesPost($pid);

            echo $qtdlikePost;

       }


     }

     public function getAllByKeyword(string $keyword) : array // keyword search in search
     {
 
        $res = $this->homeModel->like('texto', $keyword)
                               ->get()
                               ->getResult();

     
        return $res;
       
     }
      

                            
}
