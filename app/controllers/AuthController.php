<?php
// app/controllers/AuthController.php

class AuthController {
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleLogin();
            return;
        }
        
        $this->showView('auth/login', [
            'title' => 'Login - Daily Expense Tracker'
        ]);
    }
    
    public function logout() {
        session_destroy();
        header('Location: /');
        exit;
    }
    
    private function handleLogin() {
        $email = $_POST['email'] ?? '';
        $password = md5($_POST['password'] ?? '');
        
        $email = DB::escape($email);
        
        $result = DB::query("SELECT id, full_name FROM users WHERE email = '$email' AND password = '$password'");
        
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            header('Location: /dashboard');
            exit;
        } else {
            $this->showView('auth/login', [
                'title' => 'Login - Daily Expense Tracker',
                'error' => 'Invalid email or password'
            ]);
        }
    }
    
    private function showView($view, $data = []) {
        extract($data);
        require_once "app/views/{$view}.php";
    }
}
