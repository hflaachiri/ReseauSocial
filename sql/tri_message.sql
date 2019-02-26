create or replace function tri_message(idUser int,n int) returns REFCURSOR as $$
     declare 
         n_messages REFCURSOR ;
     begin 
       open n_messages for select * from fredouil.message m,fredouil.post p where m.post=p.id and m.destinataire=idUser order by p.date desc limit n;
		   
       return n_messages ;
     end;
$$language plpgsql;
