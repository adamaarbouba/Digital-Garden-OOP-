<?php


class Admin extends Perssone {

   protected $id; 

   public function __set($name, $value){
    $this->$name = $value;
   }

   public function __get($name){
    return $this->$name;
   }

   public function getid($id){
     if(!is_numeric($id) || (int) $id <=0) {
        die ("Admin id is wrong");
     }
     $this->$id;
   }
}
