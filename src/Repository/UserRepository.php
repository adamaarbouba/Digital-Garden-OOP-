<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../Entity/Person.php';
require_once __DIR__ . '/../Entity/User.php';

class UserRepository
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }


    public function addUser(User $user)
    {
        try {
            $this->conn->beginTransaction();

            $query = "INSERT INTO persons (username, email, password, role) 
                      VALUES (:username, :email, :password, :role)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":username", $user->getUsername());
            $stmt->bindValue(":email", $user->getEmail());
            $stmt->bindValue(":password", $user->getPassword());
            $stmt->bindValue(":role", $user->getRole());
            $stmt->execute();

            $personId = $this->conn->lastInsertId();

            $query2 = "INSERT INTO users (id, status) VALUES (:id, :status)";
            $stmt2 = $this->conn->prepare($query2);
            $stmt2->bindValue(":id", $personId);
            $stmt2->bindValue(":status", $user->getStatus());
            $stmt2->execute();

            $this->conn->commit();

            // Set the ID on the user object
            $user->setId($personId);

            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }


    public function updateUser($id, $username, $email, $password = null)
    {
        if ($password) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE persons 
                      SET username = :username, email = :email, password = :password 
                      WHERE id = :id";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $hashedPassword);
            $stmt->bindParam(":id", $id);
        } else {
            $query = "UPDATE persons 
                      SET username = :username, email = :email 
                      WHERE id = :id";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":id", $id);
        }

        return $stmt->execute();
    }


    public function deleteUser($id)
    {
        // Due to CASCADE, deleting from persons will also delete from users
        $query = "DELETE FROM persons WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }


    public function showAllUsers()
    {
        $query = "SELECT p.id, p.username, p.email, p.password, p.registration_date, p.role, u.status 
                  FROM persons p
                  INNER JOIN users u ON p.id = u.id
                  ORDER BY p.registration_date DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $usersArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users = [];

        foreach ($usersArray as $userData) {
            $user = new User(
                $userData['username'],
                $userData['email'],
                $userData['password'],
                $userData['id'],
                $userData['status']
            );
            $user->setRegistrationDate($userData['registration_date']);
            $users[] = $user;
        }

        return $users;
    }


    public function updateUserStatus($id, $status)
    {
        if (!in_array($status, ['BLOCKED', 'UNBLOCKED'])) {
            throw new InvalidArgumentException("Status must be either BLOCKED or UNBLOCKED");
        }

        $query = "UPDATE users SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }


    public function findByEmail($email)
    {
        $query = "SELECT p.id, p.username, p.email, p.password, p.registration_date, p.role, u.status 
                  FROM persons p
                  INNER JOIN users u ON p.id = u.id
                  WHERE p.email = :email";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$userData) {
            return null;
        }

        $user = new User(
            $userData['username'],
            $userData['email'],
            $userData['password'],
            $userData['id'],
            $userData['status']
        );
        $user->setRegistrationDate($userData['registration_date']);

        return $user;
    }

    public function findById($id)
    {
        $query = "SELECT p.id, p.username, p.email, p.password, p.registration_date, p.role, u.status 
                  FROM persons p
                  INNER JOIN users u ON p.id = u.id
                  WHERE p.id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$userData) {
            return null;
        }

        $user = new User(
            $userData['username'],
            $userData['email'],
            $userData['password'],
            $userData['id'],
            $userData['status']
        );
        $user->setRegistrationDate($userData['registration_date']);

        return $user;
    }
}
