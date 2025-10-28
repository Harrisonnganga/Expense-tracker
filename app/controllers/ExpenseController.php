<?php
// app/controllers/ExpenseController.php

class ExpenseController {
    
    public function index() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        
        $user_id = $_SESSION['user_id'];
        
        // Get all expenses for this user
        $expenses_result = DB::query("SELECT * FROM expenses WHERE user_id = '$user_id' ORDER BY expense_date DESC");
        
        $this->showView('expenses/index', [
            'title' => 'Manage Expenses',
            'expenses' => $expenses_result
        ]);
    }
    
    public function add() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        
        $user_id = $_SESSION['user_id'];
        
        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleAddExpense($user_id);
            return;
        }
        
        $this->showView('expenses/add', [
            'title' => 'Add New Expense'
        ]);
    }
    
    private function handleAddExpense($user_id) {
        $expense_date = $_POST['expense_date'] ?? '';
        $expense_item = $_POST['expense_item'] ?? '';
        $expense_cost = $_POST['expense_cost'] ?? '';
        $note = $_POST['note'] ?? '';
        
        // Validate inputs
        if (empty($expense_date) || empty($expense_item) || empty($expense_cost)) {
            $this->showView('expenses/add', [
                'title' => 'Add New Expense',
                'error' => 'Please fill in all required fields',
                'form_data' => $_POST
            ]);
            return;
        }
        
        // Insert into database
        $expense_date = DB::escape($expense_date);
        $expense_item = DB::escape($expense_item);
        $expense_cost = DB::escape($expense_cost);
        $note = DB::escape($note);
        
        $sql = "INSERT INTO expenses (user_id, expense_date, expense_item, expense_cost, note) 
                VALUES ('$user_id', '$expense_date', '$expense_item', '$expense_cost', '$note')";
        
        $result = DB::query($sql);
        
        if ($result) {
            header('Location: /expenses?success=1');
            exit;
        } else {
            $this->showView('expenses/add', [
                'title' => 'Add New Expense',
                'error' => 'Failed to add expense: ' . DB::getError(),
                'form_data' => $_POST
            ]);
        }
    }
    
    private function showView($view, $data = []) {
        extract($data);
        require_once "app/views/{$view}.php";
    }
}
