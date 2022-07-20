<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table      = 't_comment';
    protected $primaryKey = 'comment_pk';
   // protected $returnType   = 'object';

    protected $allowedFields = [ //segurança: define quais campos podem ser alterados  
        'comment_fk_user',
        'comment_fk_post',
        'comment_text',
	      'comment_date_time'    
    ];


    public function checkOwnership(int $cid, int $uid) // 'checar' dono do comentario / verify comment owner
    { 
            
   
            $vcomment = $this->where('comment_pk', $cid)
                             ->first();
            
          if($vcomment) {
                   
            return ($vcomment['comment_fk_user'] == $uid);
            
          } else {
              
              return false;
          }
          
           
    }


    public function getLikesCom($cid)    //quantidade total de likes no comentario / get total comment likes 
    { //aqui pode mudar para obter a quantidade de like pelo view do db
            
              
                $builder = $this->builder('t_like l');

                $queryComLikes =  $builder->select('count(*) as qtdlike')
                                          ->join('t_comment c', 'l.like_fk_comment = c.comment_pk')
                                          ->where("c.comment_pk = $cid")
                                          ->get(); 

                return $queryComLikes->getResult()[0]->qtdlike; 
                           
    }



    public function like($cid, $uid) // like a comment / dar like em um comentario 
    {                                // $cid = id do comentario/comment id , $uid = id do usuario que deu like/ user id who like the comment
                                         

        
        
          $builder = $this->builder('t_like l');
                
          $queryComUserLikes =  $builder->select('count(*) as qtdlike')
                                        ->join('t_comment c', 'l.like_fk_comment = c.comment_pk')
                                        ->join('t_user u ', 'l.like_fk_user = u.user_pk')
                                        ->where("u.user_pk = $uid and c.comment_pk = $cid")
                                        ->get(); 
                  
         $qtdlikeUserCom = $queryComUserLikes->getResult()[0]->qtdlike;
            
           
                  if ($qtdlikeUserCom >= 1) {
                      
                      $qtdlikeCom =   $this->getLikesCom($cid);

                      echo $qtdlikeCom;

                  } else {
                          //inserir like novo e fazer uma nova consulta pegando os dados atualizados
                          //inserir registro condicionalmente
                        
                            $builder = $this->builder('t_like');
                            $data = [ 'like_fk_comment' => $cid,
                                      'like_fk_user' => $uid ];

                            $builder->insert($data);  
                        
                            $qtdlikeCom =  $this->commentModel->getLikesCom($cid);

                            echo $qtdlikeCom;
                 
               
                   } 
        
     }

     public function getAllByKeyword(string $keyword) : array // retorna todos os comentarios com base em uma palavra chave pesquisada 
                                                             // get all comment by a specific keyword
     { 


          $builder = $this->db->table('t_comment c');
            
          $builder->select('c.comment_pk  as cid,   
                            c.comment_text   as texto,
                            c.comment_date_time as data,
                            u.user_pk  as uid,
                            u.user_full_name   as nome,
                            u.user_profile_picture    as image,
                            p.post_pk  as pid,
                           ( select count(*) from t_like l2
                            where l2.like_fk_comment = c.comment_pk ) as qtdlike');

          $builder->join('t_post p', 'p.post_pk = c.comment_fk_post');
          
          $builder->join('t_user u', 'c.comment_fk_user = u.user_pk');
          
          $builder->like("c.comment_text", $keyword);
          
          $res = $builder->get()
                         ->getResult();



          return $res;
          
        }

  
}
