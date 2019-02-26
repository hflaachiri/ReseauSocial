<?php

class utilisateurTable
{
  public static function getUserByLoginAndPass($login,$pass)
  {
    $connection = new dbconnection() ;
    $sql = "select * from fredouil.utilisateur where identifiant='".$login."' and pass='".sha1($pass)."'" ;

    $res = $connection->doQuery( $sql );
    
    if($res === false)
      return false ;

    return $res ;
  }

  public static function getUserById($id)
  {
    $connection = new dbconnection() ;
    $sql = "select *  from fredouil.utilisateur where id='".$id."'" ;

    $res = $connection->doQuery( $sql );
    
    if($res === false)
      return false ;

    return $res ;
  }

  public static function getUserId($userName)
  {
    $connection = new dbconnection() ;
    $sql = "select id from fredouil.utilisateur where identifiant like '".$userName."'" ;

    $res = $connection->doQuery( $sql );
    
    if($res === false)
      return false ;

    return $res ;
  }
  public static function getUsers()
  {
    $connection = new dbconnection() ;
    $sql = "select concat(nom,' ',prenom),id,avatar from fredouil.utilisateur ";
    $res = $connection->doQuery( $sql );

    if($res === false)
      return false ;

    return $res ;
  }

  public static function editStatut($statut,$id)
  {
    $connection = new dbconnection() ;
    $req = " UPDATE fredouil.utilisateur SET statut = '".$statut."' where id = '".$id."'";
    $res = $connection->doQueryObject($req,"utilisateur");
    return $res;
  }
}
