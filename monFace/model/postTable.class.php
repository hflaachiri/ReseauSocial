<?php

class PostTable
{
    public static function getPostByUserId($id)
  {
    $connection = new dbconnection() ;
    $sql = "SELECT msg.id as id, uti.nom as nom, uti.prenom as prenom,pst.date as date, pst.texte as texte, pst.image as image, msg.aime as aime, uti.avatar as avatar,msg.parent as parent FROM fredouil.message msg  INNER JOIN fredouil.post pst ON msg.post = pst.id INNER JOIN fredouil.utilisateur uti ON msg.emetteur = uti.id WHERE msg.destinataire ='".$id."'order by pst.date desc " ;

    $res = $connection->doQueryObject( $sql );
    
    if($res == false){
      return false ;
    }
    return $res ;
  }

  public static function getPostById($id)
  {
    $connection = new dbconnection() ;
    $sql = "SELECT * from fredouil.post where id ='".$id."'";
    $res = $connection->doQuery( $sql );
    
    if($res == false){
      return false ;
    }
    return $res ;
  }
  
  
  public static function poster($texte,$image)
  {
	  $connection = new dbconnection() ;
	  
	  $sql ="INSERT INTO fredouil.post (texte,date,image) VALUES ('".$texte."', NOW(),'".$image."')"; 
	  
	  $res = $connection->doQuery( $sql );
    
		if($res == false){
		  return false ;
		}
		return $res ;
  }
  

}
