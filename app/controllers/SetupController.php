<?php
// app/controllers/SetupController.php

class SetupController {
    
    public function index() {
        $success = $this->createTables();
        
        $this->showView('setup', [
            'title' => 'Database Setup',
            'success' => $success
        ]);
    }
    
    private function createTables() {
        try {
            // Create users table
            $usersTable = "
                CREATE TABLE IF NOT EXISTS users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    full_name VARCHAR(150) NOT NULL,
                    email VARCHAR(200) UNIQUE NOT NULL,
                    mobile_number BIGINT,
                    password VARCHAR(255) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
            ";
            
            // Create expenses table
            $expensesTable = "
                CREATE TABLE IF NOT EXISTS expenses (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    user_id INT NOT NULL,
                    expense_date DATE NOT NULL,
                    expense_item VARCHAR(200) NOT NULL,
                    expense_cost DECIMAL(10,2) NOT NULL,
                    note TEXT,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
            ";
            $sampleExpenses = [
    "INSERT IGNORE INTO expenses (user_id, expense_date, expense_item, expense_cost) VALUES (1, CURDATE(), 'Groceries', 45.50)",
    "INSERT IGNORE INTO expenses (user_id, expense_date, expense_item, expense_cost) VALUES (1, DATE_SUB(CURDATE(), INTERVAL 1 DAY), 'Fuel', 60.00)",
    "INSERT IGNORE INTO expenses (user_id, expense_date, expense_item, expense_cost) VALUES (1, DATE_SUB(CURDATE(), INTERVAL 3 DAY), 'Restaurant', 85.25)",
    "INSERT IGNORE INTO expenses (user_id, expense_date, expense_item, expense_cost) VALUES (1, DATE_SUB(CURDATE(), INTERVAL 10 DAY), 'Shopping', 120.75)",
    "INSERT IGNORE INTO expenses (user_id, expense_date, expense_item, expense_cost) VALUES (1, DATE_SUB(CURDATE(), INTERVAL 15 DAY), 'Entertainment', 35.00)"
];

foreach ($sampleExpenses as $expense) {
    DB::query($expense);
}
            // Execute table creation
            DB::query($usersTable);
            DB::query($expensesTable);
            
            // Insert a test user
            $testPassword = md5('Test@123');
            $testUser = "
                INSERT IGNORE INTO users (full_name, email, mobile_number, password) 
                VALUES ('Test User', 'testuser@gmail.com', 1234567890, '$testPassword')
            ";
            
            DB::query($testUser);
            
            return true;
            
        } catch (Exception $e) {
            error_log("Setup error: " . $e->getMessage());
            return false;
        }
    }
    
    private function showView($view, $data = []) {
        extract($data);
        require_once "app/views/{$view}.php";
    }
}
