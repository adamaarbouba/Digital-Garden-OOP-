<?php

class Person {

  protected $id;
  protected $username;
  protected $email;
  protected $password;
  protected $role;
  protected $registrationDate;

  public function __construct($username, $email, $password, $id = null) {
    $this->id = $id;
    $this->username = $username;
    $this->email = $email;
    $this->password = password_hash($password, PASSWORD_DEFAULT);
  }

  public function getId() {
    return $this->id;
  }

  public function getRole() {
    return $this->role;
  }
  
  public function getUsername() {
    return $this->username;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getPassword() {
    return $this->password;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getRegistrationDate() {
    return $this->registrationDate;
  }

  public function setRegistrationDate($registrationDate) {
    $this->registrationDate = $registrationDate;
  }

}