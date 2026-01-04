<?php


class Admin extends Perssone
{

 
   public function __construct($username, $email, $password)
   {
      parent::__construct($username, $email, $password);
      $this->role = "Admin";
   }



}
