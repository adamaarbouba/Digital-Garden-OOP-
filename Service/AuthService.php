<?php

require_once __DIR__ . '/../Repository/UserRepository.php';
require_once __DIR__ . '/../Repository/AdminRepository.php';

class AuthService
{
    private $userRepository;
    private $adminRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->adminRepository = new AdminRepository();
    }

    /**
     * Login user or admin
     */
    public function login($email, $password)
    {
        // Try to find user first
        $user = $this->userRepository->findByEmail($email);

        if ($user) {
            // Check if user is blocked
            if ($user->getStatus() === 'BLOCKED') {
                return [
                    'success' => false,
                    'message' => 'Your account has been blocked. Please contact support.'
                ];
            }

            // Verify password
            if (password_verify($password, $user->getPassword())) {
                return [
                    'success' => true,
                    'user' => $user
                ];
            }
        }

        // Try to find admin
        $admin = $this->adminRepository->findByEmail($email);

        if ($admin && password_verify($password, $admin->getPassword())) {
            return [
                'success' => true,
                'user' => $admin
            ];
        }

        // Login failed
        return [
            'success' => false,
            'message' => 'Invalid email or password'
        ];
    }

    /**
     * Register new user
     */
    public function register($username, $email, $password)
    {
        // Check if email already exists
        $existingUser = $this->userRepository->findByEmail($email);
        if ($existingUser) {
            return [
                'success' => false,
                'message' => 'Email already exists'
            ];
        }

        // Check if admin with same email exists
        $existingAdmin = $this->adminRepository->findByEmail($email);
        if ($existingAdmin) {
            return [
                'success' => false,
                'message' => 'Email already exists'
            ];
        }

        try {
            // Create new user
            $user = new User($username, $email, $password);
            $this->userRepository->addUser($user);

            return [
                'success' => true,
                'message' => 'Registration successful'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Registration failed: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Logout user
     */
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
    }
}