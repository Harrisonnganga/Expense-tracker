<?php
// app/controllers/ForgotPasswordController.php

class ForgotPasswordController {
    
    public function index() {
        // If user is already logged in, redirect to dashboard
        if (isset($_SESSION['user_id'])) {
            header('Location: /dashboard');
            exit;
        }
        
        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePasswordResetRequest();
            return;
        }
        
        $this->showView('auth/forgot-password', [
            'title' => 'Forgot Password - Daily Expense Tracker'
        ]);
    }
    
    public function reset() {
        $token = $_GET['token'] ?? '';
        
        if (empty($token)) {
            header('Location: /forgot-password');
            exit;
        }
        
        // Handle password reset form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePasswordReset($token);
            return;
        }
        
        // Verify token is valid
        $user = $this->verifyResetToken($token);
        
        if (!$user) {
            $this->showView('auth/forgot-password', [
                'title' => 'Forgot Password - Daily Expense Tracker',
                'error' => 'Invalid or expired reset link. Please request a new one.'
            ]);
            return;
        }
        
        $this->showView('auth/reset-password', [
            'title' => 'Reset Password - Daily Expense Tracker',
            'token' => $token,
            'email' => $user['email']
        ]);
    }
    
    private function handlePasswordResetRequest() {
        $email = $_POST['email'] ?? '';
        
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->showView('auth/forgot-password', [
                'title' => 'Forgot Password - Daily Expense Tracker',
                'error' => 'Please enter a valid email address.',
                'email' => $email
            ]);
            return;
        }
        
        $email = DB::escape($email);
        $user = DB::query("SELECT id, full_name FROM users WHERE email = '$email'");
        
        if ($user && $user->num_rows > 0) {
            $user_data = $user->fetch_assoc();
            
            // Generate reset token (in a real app, you'd send this via email)
            $reset_token = bin2hex(random_bytes(32));
            $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));
            
            // Store token in database
            DB::query("UPDATE users SET password_reset_token = '$reset_token', token_expires_at = '$expires_at' WHERE id = '{$user_data['id']}'");
            
            // In a real application, you would send an email here
            // For now, we'll show the reset link on the page for testing
            $reset_url = "https://{$_SERVER['HTTP_HOST']}/forgot-password/reset?token=$reset_token";
            
            $this->showView('auth/forgot-password', [
                'title' => 'Forgot Password - Daily Expense Tracker',
                'success' => true,
                'reset_url' => $reset_url, // Remove this in production
                'email' => $email
            ]);
            
        } else {
            $this->showView('auth/forgot-password', [
                'title' => 'Forgot Password - Daily Expense Tracker',
                'error' => 'No account found with that email address.',
                'email' => $email
            ]);
        }
    }
    
    private function handlePasswordReset($token) {
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        
        $errors = $this->validatePasswordReset($password, $confirm_password);
        
        if (!empty($errors)) {
            $this->showView('auth/reset-password', [
                'title' => 'Reset Password - Daily Expense Tracker',
                'errors' => $errors,
                'token' => $token
            ]);
            return;
        }
        
        $user = $this->verifyResetToken($token);
        
        if (!$user) {
            $this->showView('auth/forgot-password', [
                'title' => 'Forgot Password - Daily Expense Tracker',
                'error' => 'Invalid or expired reset link. Please request a new one.'
            ]);
            return;
        }
        
        // Update password and clear reset token
        $hashed_password = md5($password);
        DB::query("UPDATE users SET password = '$hashed_password', password_reset_token = NULL, token_expires_at = NULL WHERE id = '{$user['id']}'");
        
        $this->showView('auth/reset-success', [
            'title' => 'Password Reset Successful - Daily Expense Tracker'
        ]);
    }
    
    private function verifyResetToken($token) {
        $token = DB::escape($token);
        $current_time = date('Y-m-d H:i:s');
        
        $result = DB::query("SELECT id, email, full_name FROM users WHERE password_reset_token = '$token' AND token_expires_at > '$current_time'");
        
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        
        return false;
    }
    
    private function validatePasswordReset($password, $confirm_password) {
        $errors = [];
        
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