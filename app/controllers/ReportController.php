<?php
// app/controllers/ReportController.php

class ReportController {
    
    public function index() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        
        $user_id = $_SESSION['user_id'];
        
        $this->showView('reports/index', [
            'title' => 'Expense Reports'
        ]);
    }
    
    private function showView($view, $data = []) {
        extract($data);
        require_once "app/views/{$view}.php";
    }
}
