<?php

class Admin extends Person
{
   public function __construct($username, $email, $password, $id = null)
   {
      parent::__construct($username, $email, $password, $id);
      $this->role = "admin";
   }
}
