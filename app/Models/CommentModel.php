<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table      = 't_comment';
    protected $primaryKey = 'com_pk_id';
   // protected $returnType   = 'object';

    protected $allowedFields = [ //segurança: define quais campos podem ser alterados  
        'com_fk_usu',
        'com_fk_pst',
        'com_text',
	      'com_dt_com'    
    ];


    public function checkOwnership(int $cid, int $uid) // 'checar' dono do comentario / verify comment owner
    { 
            
   
            $vcomment = $this->where('com_pk_id', $cid)
                             ->first();
            
          if($vcomment) {
                   
            return ($vcomment['com_fk_usu'] == $uid);
            
          } else {
              
              return false;
          }
          
           
    }


    public function getLikesCom($cid)    //quantidade total de likes no comentario / get total comment likes 
    { //aqui pode mudar para obter a quantidade de like pelo view do db
            
              
                $builder = $this->builder('t_like l');

                $queryComLikes =  $builder->select('count(*) as qtdlike')
                                          ->join('t_comment c', 'l.lik_fk_com = c.com_pk_id')
                                          ->where("c.com_pk_id = $cid")
                                          ->get(); 

                return $queryComLikes->getResult()[0]->qtdlike; 
                           
    }



    public function like($cid, $uid) // like a comment / dar like em um comentario 
    {                                // $cid = id do comentario/comment id , $uid = id do usuario que deu like/ user id who like the comment
                                         

        
        
          $builder = $this->builder('t_like l');
                
          $queryComUserLikes =  $builder->select('count(*) as qtdlike')
                                        ->join('t_comment c', 'l.lik_fk_com = c.com_pk_id')
                                        ->join('t_user u ', 'l.lik_fk_usu = u.usu_pk_id')
                                        ->where("u.usu_pk_id = $uid and c.com_pk_id = $cid")
                                        ->get(); 
                  
         $qtdlikeUserCom = $queryComUserLikes->getResult()[0]->qtdlike;
            
           
                  if ($qtdlikeUserCom >= 1) {
                      
                      $qtdlikeCom =   $this->getLikesCom($cid);

                      echo $qtdlikeCom;

                  } else {
                          //inserir like novo e fazer uma nova consulta pegando os dados atualizados
                          //inserir registro condicionalmente
                        
                            $builder = $this->builder('t_like');
                            $data = [ 'lik_fk_com' => $cid,
                                      'lik_fk_usu' => $uid ];

                            $builder->insert($data);  
                        
                            $qtdlikeCom =  $this->commentModel->getLikesCom($cid);

                            echo $qtdlikeCom;
                 
               
                   } 
        
     }

     public function getAllByKeyword(string $keyword) : array // retorna todos os comentarios com base em uma palavra chave pesquisada 
                                                             // get all comment by a specific keyword
     { 


          $builder = $this->db->table('t_comment c');
            
          $builder->select('c.com_pk_id  as cid,   
                            c.com_text   as texto,
                            c.com_dt_com as data,
                            u.usu_pk_id  as uid,
                            u.usu_nome   as nome,
                            u.usu_img    as image,
                            p.pst_pk_id  as pid,
                           ( select count(*) from t_like l2
                            where l2.lik_fk_com = c.com_pk_id ) as qtdlike');

          $builder->join('t_post p', 'p.pst_pk_id = c.com_fk_pst');
          
          $builder->join('t_user u', 'c.com_fk_usu = u.usu_pk_id');
          
          $builder->like("c.com_text", $keyword);
          
          $res = $builder->get()
                         ->getResult();



          return $res;
          
        }

  
}
