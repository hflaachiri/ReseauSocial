<?php

define ('HOST', 'localhost') ;
define ('USER', 'uapv1900168'  ) ;
define ('PASS', 'qm69Pv' ) ;
define ('DB', 'etd' ) ;

class dbconnection
{
  private $link, $error ;

  public function __construct()
  {
    $this->link = null;
    $this->error = null;
    try{

      $this->link = new PDO('pgsql:host=localhost;dbname=etd','uapv1900168' ,'qm69Pv');
       // cette nouvelle instnace sera assigné à $this->link 
    }catch( PDOException $e ){
      echo "N ".$e->getCode()."</ br>";
      echo $e->getMessage();
        $this->error =  $e->getMessage();
    }
  }

  public function getLastInsertId($att)
  {
    return $this->link->lastInsertId($att."_id_seq");
  }

  public function doExec( $sql )
  {
    $prepared = $this->link->prepare( $sql );
    return $prepared->execute();
  }

  public function doQuery($sql)
  {
    $prepared = $this->link->prepare($sql);
    $prepared->execute();
    $res = $prepared->fetchAll( PDO::FETCH_ASSOC );
   
    return $res;
  }

  public function doQueryObject($sql)
  {
    $prepared = $this->link->prepare($sql);
    $prepared->execute();
    $res = $prepared->fetchAll(PDO::FETCH_CLASS);
    return json_encode($res);
  }

  public function __destruct()
  {
    $this->link = null;
  }
}
