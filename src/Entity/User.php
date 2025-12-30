<?php

include_once "Theme.php";

class User extends Perssone {

    protected $id;
    protected $status;
    protected $themes = [];


    public function __construct($status , $id = null){
        $this->status=$status;
    }
    
    public function __set($name, $value){
        $this->$name=$value;
    }
    public function __get($name){
       return $this->$name;
    }

    public function setid($id){
        if (!is_numeric($id) || (int) $id <=0) {
            die ("wrong user id");
        }
        
        $this->id=$id;

}

}