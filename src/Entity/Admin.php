<?php


class Admin extends Perssone
{

   protected $id;


   public function __construct($username, $email, $password)
   {
      parent::__construct($username, $email, $password);
      $this->role = "Admin";
   }

   public function __set($name, $value)
   {
      $this->$name = $value;
   }
   public function __get($name)
   {
      return $this->$name;
   }

}
