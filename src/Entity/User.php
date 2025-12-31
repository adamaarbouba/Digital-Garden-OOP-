<?php

include_once "Theme.php";

class User extends Perssone
{

    protected $id;
    protected $status;
    protected $themes = [];


    public function __construct($username, $email, $password)
    {
        parent::__construct($username, $email, $password);

        $this->role = "user";
        $this->status = "unblocked";
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