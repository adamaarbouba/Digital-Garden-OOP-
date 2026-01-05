<?php
session_start();

require_once __DIR__ . './../Service/AuthService.php';

// Handle Login
if (isset($_POST['login_btn'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Email and password are required";
        header("Location: login.php");
        exit();
    }

    $authService = new AuthService();
    $result = $authService->login($email, $password);

    if ($result['success']) {
        $_SESSION['user_id'] = $result['user']->getId();
        $_SESSION['username'] = $result['user']->getUsername();
        $_SESSION['email'] = $result['user']->getEmail();
        $_SESSION['role'] = $result['user']->getRole();

        // Redirect based on role
        if ($result['user']->getRole() === 'admin') {
            header("Location: ../admin/dashboard.php");
        } else {
            header("Location: ../public/dashboard.php");
        }
        exit();
    } else {
        $_SESSION['error'] = $result['message'];
        header("Location: ../public/login.php");
        exit();
    }
}

// Handle Signup
if (isset($_POST['signup_btn'])) {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Validation
    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        $_SESSION['error'] = "All fields are required";
        header("Location: ../public/register.php");
        exit();
    }

    if ($password !== $confirmPassword) {
        $_SESSION['error'] = "Passwords do not match";
        header("Location: ../public/register.php");
        exit();
    }

    if (strlen($password) < 6) {
        $_SESSION['error'] = "Password must be at least 6 characters";
        header("Location: ../public/register.php");
        exit();
    }

    $authService = new AuthService();
    $result = $authService->register($username, $email, $password);

    if ($result['success']) {
        $_SESSION['success'] = "Registration successful! Please login.";
        header("Location: ../public/login.php");
        exit();
    } else {
        $_SESSION['error'] = $result['message'];
        header("Location: ../public/register.php");
        exit();
    }
}

header("Location: ../public/login.php");
exit();
