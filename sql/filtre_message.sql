/*Dans la classe messageTable, vous devez implémenter une méthode « getMessagesByPage(début,fin,id) »
 permettant de faire de la pagination.
Cette méthode devra faire appel à la fonction pl/sql « filtreMessages(début, fin,id) » 
que vous devez écrire et qui renvoie un tableau de messages.*/
create or replace function filtreMessages(debut int ,fin int ,idUser int) returns REFCURSOR as $$
     declare 
         p_messages REFCURSOR ;
     begin 
       open p_messages for select * from fredouil.message m,fredouil.post p where m.post=p.id and m.destinataire=idUser order by p.date desc limit (fin-debut) offset debut ;
		   
       return p_messages ;
     end;
$$language plpgsql;