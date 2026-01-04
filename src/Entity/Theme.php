<?php

include_once "Note.php";

class Theme {
    protected $id;
    protected $name;
    protected $color;
    protected $notes=[];


    public function __construct($name , $color ,$id = null){
        $this->name=$name;
        $this->color=$color;
    }

    public function __set($name, $value){
        $this->$name=$value;
        
    }
    
    public function __get($name){
       return $this->$name;
        
    }

    public function setid($id){
        if (!is_numeric($id) || (int) $id <=0) {
            die ("wrong theme id");
        }

        $this->id=$id;
    }

   

}