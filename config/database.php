<?php

class Database
{

    private $host = "db";
    private $dbName = "digital_garden_oop";
    private $username = "root";
    private $password = "12344321";


    private $conn;



    public function __construct()
    {
        $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName;", $this->username, $this->password);
    }


    public function getConnection()
    {
        return $this->conn;
    }
}
