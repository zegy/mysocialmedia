use mysocialmedia;
-- example of query used in main page's search bar
--exemplo da querie usada na search bar da pagina home
select  c.com_pk_id  as cid,   
        c.com_text   as texto,
        c.com_dt_com as data,
        u.usu_pk_id  as uid,
		u.usu_nome   as nome,
        u.usu_img    as image,
        p.pst_pk_id  as pid,
        ( select count(*) from t_like l2
          where l2.lik_fk_com = c.com_pk_id ) as qtdlike        
from t_comment c 
        join t_post p on p.pst_pk_id = c.com_fk_pst
        join t_user u on c.com_fk_usu = u.usu_pk_id
where c.com_text like  "%Oi!%"  
                                 
                            
                            
                            
                      
