use mysocialmedia;
-- example of query used in main page's search bar
--exemplo da querie usada na search bar da pagina home
select  c.comment_pk  as cid,   
        c.comment_text   as texto,
        c.comment_date_time as data,
        u.user_pk  as uid,
		u.user_full_name   as nome,
        u.user_profile_picture    as image,
        p.post_pk  as pid,
        ( select count(*) from t_like l2
          where l2.like_fk_comment = c.comment_pk ) as qtdlike        
from t_comment c 
        join t_post p on p.post_pk = c.comment_fk_post
        join t_user u on c.comment_fk_user = u.user_pk
where c.comment_text like  "%Oi!%"  
                                 
                            
                            
                            
                      
