<?php

class messageTable
{
  public static function getMessages()
  {
    $connection = new dbconnection() ;
    $sql = "select * from fredouil.message ";

    $res = $connection->doQueryObject( $sql , "message");
    
    if($res == false){
      return false ;
    }
    return $res ;
  }

  public static function getMessagesSentTo($id,$n)
  {
    $connection = new dbconnection() ;
    $sql = "select tri_message('.$id.','.$n.')";

    $res = $connection->doQueryObject( $sql , "messageTable");
    
    if($res == false){
      return false ;
    }
    return $res ;

  }
    
  public static function getMessagesByPage($debut, $fin, $id) 
  {
    $connection = new dbconnection() ;
    $sql = "select filtre_message('.$debut.','.$fin.','.$id.')";

    $res = $connection->doQueryObject( $sql , "messageTable");
    
    if($res == false){
      return false ;
    }
    return $res ;

  }

  public static function getMessagesbyId($id)
    {
        $connection = new dbconnection() ;
        $req = "select * from fredouil.message where id=".$id;
        $res = $connection->doQuery($req);
        return $res;
    }
   
  public static function like($id)
  {
    $connection = new dbconnection() ;
    $req = " UPDATE fredouil.message SET aime = aime + 1 where id = '".$id."'";
    $res = $connection->doQueryObject($req,"message");
    return $res;
  }


	

  public static function saveMessage($message){
    $post['texte'] = $message['texte'];
    $post['date'] = date('Y-m-d H:i:s');
    $post['image']= $message['image'];
    $postModel = new post($post);
    $postId = $postModel->save();

    $messageM['post'] = $postId;
    $messageM['emetteur'] = $message['emetteur'];
    $messageM['destinataire'] = $message['destinataire'];
    $messageM['parent'] = $message['emetteur'];
    $messageM['aime'] = 0;

    $messageModel = new message($messageM);
    $messageId = $messageModel->save();
    return $messageId ;
 }
}