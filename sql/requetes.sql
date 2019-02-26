-- INSERT new POST
INSERT INTO fredouil.post (texte,date,image) 
VALUES ('HELLO Hafsa', NOW(), null); 

INSERT INTO fredouil.post (texte,date,image) 
VALUES ('HELLO World', NOW(), null); 

INSERT INTO fredouil.post (texte,date,image) 
VALUES ('...... No comment', NOW(), 'https://www.prevoditelj-teksta.com/wp-content/uploads/2016/08/SEO-prevo%C4%91enje.png'); 


INSERT INTO fredouil.post (texte,date,image) 
VALUES ('Bonjour', NOW(), 'https://www.gettyimages.fr/gi-resources/images/Embed/new/embed2.jpg'); 

INSERT INTO fredouil.post (texte,date,image) 
VALUES ('Test test ', NOW(), null); 

INSERT INTO fredouil.post (texte,date,image) 
VALUES ('Bonsoir  ', NOW(), null); 

INSERT INTO fredouil.post (texte,date,image) 
VALUES ('Bonsoir hoop', NOW(), null); 



UPDATE fredouil.post SET image = 'https://1wan9q1kq74x1svp071dyl7nz12-wpengine.netdna-ssl.com/wp-content/uploads/2017/08/Snapchat-Code.jpg' WHERE id = 221;

UPDATE fredouil.utilisateur SET avatar = 'http://www.joomlack.fr/images/stories/images/on-top-of-earth.jpg' WHERE id = 30;

UPDATE fredouil.message SET aime = aime+1 where post = 5576 ;

UPDATE fredouil.utilisateur SET statut = 'Heloo' where id = 30 ;

SELECT * from fredouil.post WHERE texte = 'HELLO Hafsa';
-- post created with id ****** 221 ******

SELECT * from fredouil.post WHERE texte = 'Bonsoir hoop';
-- post created with id ****** 2198 ******

SELECT * from fredouil.post WHERE texte = 'HELLO World';
-- post created with id ****** 227 ******
SELECT * from fredouil.post WHERE texte = '...... No comment';
-- post created with id ****** 228 ******
SELECT * from fredouil.post WHERE texte = 'Bonjour';
-- post created with id ****** 1720 ******

SELECT * from fredouil.post WHERE texte = 'Test test ';
-- post created with id ****** 1722 ******

SELECT * from fredouil.post WHERE texte = 'Bonsoir';
-- post created with id ****** 328 ******

-- INSERT new message that corespond to the post
INSERT INTO fredouil.message (emetteur, destinataire, parent, post, aime)
VALUES (30,30,null, 221, 0);

INSERT INTO fredouil.message (emetteur, destinataire, parent, post, aime)
VALUES (1,30,null, 227, 10);

INSERT INTO fredouil.message (emetteur, destinataire, parent, post, aime)
VALUES (25,30,null, 228, 2);



INSERT INTO fredouil.message (emetteur, destinataire, parent, post, aime)
VALUES (41,30,null, 1720, 6);


INSERT INTO fredouil.message (emetteur, destinataire, parent, post, aime)
VALUES (30,1,null, 1720, 6);

-- Insert un chat
INSERT INTO fredouil.chat (post, emetteur)
VALUES (1722, 30);

INSERT INTO fredouil.chat (post, emetteur)
VALUES (328, 30);

INSERT INTO fredouil.chat (post, emetteur)
VALUES (2198, 30);

-- select all user post that he is the destinataire

SELECT * FROM fredouil.message WHERE destinataire = 30;

SELECT * FROM fredouil.message msg  INNER JOIN fredouil.post pst ON msg.post = pst.id WHERE msg.destinataire = 30;
