<?php
require_once "Database.php";
require_once "User.php";
require_once "Admin.php";

class Auth {
    private PDO $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function login(string $email, string $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['password'])) {
            if ($row['role'] === 'admin') {
                header("dashboard.php");
                return new Admin($row['username'], $row['email'], $row['password']);
            } else {
                header("index.php");
                return new User($row['username'], $row['email'], $row['password']);
            }
        }

        return false;
    }

   
}
