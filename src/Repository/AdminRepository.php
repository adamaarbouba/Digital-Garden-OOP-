<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../Entity/Person.php';
require_once __DIR__ . '/../Entity/Admin.php';

class AdminRepository
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    /**
     * Add a new admin to the database
     */
    public function addAdmin(Admin $admin)
    {
        try {
            $this->conn->beginTransaction();

            // Insert into persons table
            $query = "INSERT INTO persons (username, email, password, role) 
                      VALUES (:username, :email, :password, :role)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":username", $admin->getUsername());
            $stmt->bindValue(":email", $admin->getEmail());
            $stmt->bindValue(":password", $admin->getPassword());
            $stmt->bindValue(":role", $admin->getRole());
            $stmt->execute();

            // Get the inserted person ID
            $personId = $this->conn->lastInsertId();

            // Insert into admins table
            $query2 = "INSERT INTO admins (id) VALUES (:id)";
            $stmt2 = $this->conn->prepare($query2);
            $stmt2->bindValue(":id", $personId);
            $stmt2->execute();

            $this->conn->commit();

            // Set the ID on the admin object
            $admin->setId($personId);

            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }

    /**
     * Find admin by email
     */
    public function findByEmail($email)
    {
        $query = "SELECT p.id, p.username, p.email, p.password, p.registration_date, p.role 
                  FROM persons p
                  INNER JOIN admins a ON p.id = a.id
                  WHERE p.email = :email";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $adminData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$adminData) {
            return null;
        }

        $admin = new Admin(
            $adminData['username'],
            $adminData['email'],
            $adminData['password'],
            $adminData['id']
        );
        $admin->setRegistrationDate($adminData['registration_date']);

        return $admin;
    }

    /**
     * Find admin by ID
     */
    public function findById($id)
    {
        $query = "SELECT p.id, p.username, p.email, p.password, p.registration_date, p.role 
                  FROM persons p
                  INNER JOIN admins a ON p.id = a.id
                  WHERE p.id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $adminData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$adminData) {
            return null;
        }

        $admin = new Admin(
            $adminData['username'],
            $adminData['email'],
            $adminData['password'],
            $adminData['id']
        );
        $admin->setRegistrationDate($adminData['registration_date']);

        return $admin;
    }

    /**
     * Get all admins
     */
    public function showAllAdmins()
    {
        $query = "SELECT p.id, p.username, p.email, p.password, p.registration_date, p.role 
                  FROM persons p
                  INNER JOIN admins a ON p.id = a.id
                  ORDER BY p.registration_date DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $adminsArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $admins = [];

        foreach ($adminsArray as $adminData) {
            $admin = new Admin(
                $adminData['username'],
                $adminData['email'],
                $adminData['password'],
                $adminData['id']
            );
            $admin->setRegistrationDate($adminData['registration_date']);
            $admins[] = $admin;
        }

        return $admins;
    }
}
