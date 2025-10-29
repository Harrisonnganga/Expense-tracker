<?php
// app/controllers/RegisterController.php

class RegisterController {
    
    public function index() {
        // If user is already logged in, redirect to dashboard
        if (isset($_SESSION['user_id'])) {
            header('Location: /dashboard');
            exit;
        }
        
        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleRegistration();
            return;
        }
        
        $this->showView('auth/register', [
            'title' => 'Register - Daily Expense Tracker'
        ]);
    }
    
    private function handleRegistration() {
        $full_name = $_POST['full_name'] ?? '';
        $email = $_POST['email'] ?? '';
        $mobile_number = $_POST['mobile_number'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        
        // Validate inputs
        $errors = $this->validateRegistration($full_name, $email, $password, $confirm_password);
        
        if (!empty($errors)) {
            $this->showView('auth/register', [
                'title' => 'Register - Daily Expense Tracker',
                'errors' => $errors,
                'form_data' => $_POST
            ]);
            return;
        }
        
        // Check if email already exists
        $email = DB::escape($email);
        $existing_user = DB::query("SELECT id FROM users WHERE email = '$email'");
        
        if ($existing_user && $existing_user->num_rows > 0) {
            $this->showView('auth/register', [
                'title' => 'Register - Daily Expense Tracker',
                'errors' => ['Email already exists. Please use a different email or login.'],
                'form_data' => $_POST
            ]);
            return;
        }
        
        // Create new user
        $full_name = DB::escape($full_name);
        $mobile_number = DB::escape($mobile_number);
        $hashed_password = md5($password);
        
        $sql = "INSERT INTO users (full_name, email, mobile_number, password, email_verified) 
                VALUES ('$full_name', '$email', '$mobile_number', '$hashed_password', 1)";
        
        $result = DB::query($sql);
        
        if ($result) {
            // Get the last inserted ID using a separate query
            $user_result = DB::query("SELECT id FROM users WHERE email = '$email'");
            if ($user_result && $user_result->num_rows > 0) {
                $user = $user_result->fetch_assoc();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $full_name;
                
                header('Location: /dashboard?welcome=1');
                exit;
            } else {
                // If we can't get the user ID, redirect to login
                header('Location: /login?registered=1');
                exit;
            }
        } else {
            $this->showView('auth/register', [
                'title' => 'Register - Daily Expense Tracker',
                'errors' => ['Registration failed. Please try again.'],
                'form_data' => $_POST
            ]);
        }
    }
    
    private function validateRegistration($full_name, $email, $password, $confirm_password) {
        $errors = [];
        
        if (empty($full_name)) {
            $errors[] = 'Full name is required.';
        }
        
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Valid email address is required.';
        }
        
        if (empty($password) || strlen($password) < 6) {
            $errors[] = 'Password must be at least 6 characters long.';
        }
        
        if ($password !== $confirm_password) {
            $errors[] = 'Passwords do not match.';
        }
        
        return $errors;
    }
    
    private function showView($view, $data = []) {
        extract($data);
        require_once "app/views/{$view}.php";
    }
}
