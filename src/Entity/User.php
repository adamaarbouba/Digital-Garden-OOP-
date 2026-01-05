<?php

class User extends Person
{
    protected $status;
    protected $themes = [];

    public function __construct($username, $email, $password, $id = null, $status = "UNBLOCKED")
    {
        parent::__construct($username, $email, $password, $id);
        $this->role = "user";
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getThemes()
    {
        return $this->themes;
    }

    public function setThemes($themes)
    {
        $this->themes = $themes;
    }

    public function addTheme($theme)
    {
        $this->themes[] = $theme;
    }
}