<?php
// app/controllers/HomeController.php

class HomeController {
    
    public function index() {
        // If user is logged in, redirect to dashboard
        if (isset($_SESSION['user_id'])) {
            header('Location: /dashboard');
            exit;
        }
        
        // Otherwise show login page
        $this->showView('home', [
            'title' => 'Daily Expense Tracker - Login'
        ]);
    }
    
    private function showView($view, $data = []) {
        extract($data);
        require_once APP_PATH . "/views/{$view}.php";
    }
}
?>