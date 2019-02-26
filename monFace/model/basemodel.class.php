<?php
abstract class basemodel
{

 private $data;
 
 public function save()
  { 
    $connection = new dbconnection() ;
    
    if(isset($this->id))
    {
      $sql = "update fredouil.".get_class($this)." set " ;

      $set = array() ;
      foreach($this->data as $att => $value)
        if($att != 'id' && $value)
          $set[] = "$att = '".$value."'" ;

      $sql .= implode(",",$set) ;
      $sql .= " where id=".$this->id ;
    }
    else
    {
      $sql = "insert into fredouil.".get_class($this)." " ;
      $sql .= "(".implode(",",array_keys($this->data)).") " ; //array_keys == attribus
      $sql .= "values ('".implode("','",array_values($this->data))."')" ;
    }
    $connection->doExec($sql) ;
    $id = $connection->getLastInsertId("fredouil.".get_class($this)) ;

    return $id == false ? NULL : $id ; 
  }
  
  public function __construct($row = NULL)
  {
    $this->data = array();
    if(!empty($row) && is_array($row)) {
      foreach($row as $att => $value) {
        $this->data[$att] = $value;
      }
    }
  }
  public function __get($att)
  {
    return empty($att) ? NULL : $this->data[$att];
  }
  public function __set($att, $value)
  {
    $this->data[$att] = $value;
  }

}
