<?php

class Perssone {
    
    protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $role;

    public function __construct($username , $email , $password ,$id = null){
        $this->username=$username;
        $this->email=$email;
        $this->password=$password;
    }

    public function __set($name, $value){
        $this->$name=$value;
    }

    public function __get($name){
       return $this->$name;
    }

    public function setid($id){
      if (!is_numeric($id) || (int) $id <=0) {
        die ("wrond person iD");
      }
      $this->$id;
    }

}
