<?php
// app/controllers/ProfileController.php

class ProfileController {
    
    public function index() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        
        $user_id = $_SESSION['user_id'];
        
        // Get user data
        $user_result = DB::query("SELECT * FROM users WHERE id = '$user_id'");
        $user = $user_result->fetch_assoc();
        
        $this->showView('profile/index', [
            'title' => 'My Profile',
            'user' => $user
        ]);
    }
    
    private function showView($view, $data = []) {
        extract($data);
        require_once "app/views/{$view}.php";
    }
}
