<?php

class Perssone {

  protected $id;
  protected $username;
  protected $email;
  protected $password;
  protected $role;

  public function __construct($username, $email, $password, $id = null) {
    $this->id = $id;
    $this->username = $username;
    $this->email = $email;
    $this->password = password_hash($password, PASSWORD_DEFAULT);
  }

  public function getRole() {
    return $this->role;
  }
  
  public function getUsername() {
    return $this->username;
  }

}
