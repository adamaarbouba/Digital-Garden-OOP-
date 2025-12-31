<?php

class Perssone
{

  protected $id;
  protected $username;
  protected $email;
  protected $password;
  protected $role;

  public function __construct($username, $email, $password, $id = null)
  {
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
  }

  public function getRole()
  {
    return $this->role;

  }

  public function __get($name)
  {
    return $this->$name;
  }


}
