<?php
session_start();

require_once "../config/database.php";
require_once "../src/User.php";
require_once "../src/Admin.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$admin = $_SESSION['user'];

if ($admin->getRole() !== "Admin") {
    die("Access denied");
}

if (!isset($_POST['user_id'], $_POST['new_status'])) {
    die("Invalid request");
}

$userId = (int) $_POST['user_id'];
$newStatus = strtolower(trim($_POST['new_status']));

$allowedStatus = ['blocked', 'unblocked'];

if (!in_array($newStatus, $allowedStatus)) {
    die("Invalid status value");
}

$db = new Database();
$conn = $db->getConnection();

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userId]);
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$userData) {
    die("User not found");
}

if ($userData['role'] === 'admin') {
    die("You cannot change admin status");
}

$user = new User(
    $userData['username'],
    $userData['email'],
    $userData['password']
);

$user->setStatus($userData['status']);

$admin->changeUserStatus($user, $newStatus);
$update = $conn->prepare("UPDATE users SET status = ? WHERE id = ?");
$update->execute([$newStatus, $userId]);

header("Location: admin_panel.php");
exit;
