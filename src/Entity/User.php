<?php

include_once "Theme.php";

class User extends Perssone
{

    protected $status;
    protected $themes = [];


    public function __construct($username, $email, $password)
    {
        parent::__construct($username, $email, $password);

        $this->role = "user";
        $this->status = "unblocked";
    }

    public function setStatus($status)
    {
        $this->status=$status;
    }
    public function getStatus()
    {
        return $this->status;
    }

}