<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../Entity/User.php';

class LoginService
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function checkDatabase($email)
    {
        $query = "SELECT p.id, p.username, p.email, p.password, p.registration_date, p.role, u.status 
                  FROM persons p
                  INNER JOIN users u ON p.id = u.id
                  WHERE p.email = :email AND p.role = 'user'";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function checkPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }

    public function login($email, $password)
    {
        $userData = $this->checkDatabase($email);

        if (!$userData) {
            return null;
        }

        if (!$this->checkPassword($password, $userData['password'])) {
            return null;
        }

        if ($userData['status'] === 'BLOCKED') {
            throw new Exception("Your account has been blocked. Please contact support.");
        }

        return new User(
            $userData['username'],
            $userData['email'],
            $userData['password'],
            $userData['id'],
            $userData['registration_date'],
            $userData['status']
        );
    }


    public function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }


    public function emailExists($email)
    {
        $query = "SELECT COUNT(*) as count FROM persons WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
}
