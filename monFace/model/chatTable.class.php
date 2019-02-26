<?php
include_once 'basemodel.class.php';
class chatTable
{
  public static function getChats()
  {
    $connection = new dbconnection() ;
    $sql = "select * from fredouil.chat chat INNER JOIN fredouil.post pst ON chat.post = pst.id INNER JOIN fredouil.utilisateur uti ON chat.emetteur = uti.id order by pst.date desc limit 10" ;

    //$res = $connection->doQuery( $sql , "chat" );
    $res = $connection->doQueryObject( $sql);
    
    if($res == false){
      return false ;
    }
    return $res ;
  }

  public static function getLastChat()
  {
    $connection = new dbconnection() ;
    $sql = "select * from fredouil.chat chat INNER JOIN fredouil.post pst ON chat.post = pst.id INNER JOIN fredouil.utilisateur uti ON chat.emetteur = uti.id order by pst.date desc limit 1";

    $res = $connection->doQuery( $sql );
    
    if($res == false){
      return false ;
    }
    return $res ;

  }
  public static function saveChat($chat){
      $post['texte'] = $chat['content'];
      $post['date'] = date('Y-m-d H:i:s');
      $post['image']= $chat['image'];
      $postModel = new post($post);
      $postId = $postModel->save();

      $chatT['post'] = $postId;
      $chatT['emetteur'] = $chat['id'];

      $chatModel = new chat($chatT);
      $chatId = $chatModel->save();
      return $chatId ;
  }
    
}
