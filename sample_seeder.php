<?php
// Sample data seeder for public users
// This creates fake expense data for testing

require_once 'config.php'; // Your config file

// Sample expense data
$sampleExpenses = [
    ['item' => 'Office Supplies', 'amount' => 45.50, 'date' => '2024-01-15', 'category' => 'office'],
    ['item' => 'Team Lunch', 'amount' => 120.00, 'date' => '2024-01-16', 'category' => 'food'],
    ['item' => 'Internet Bill', 'amount' => 75.00, 'date' => '2024-01-10', 'category' => 'utilities'],
    ['item' => 'Coffee', 'amount' => 15.75, 'date' => '2024-01-17', 'category' => 'food'],
    ['item' => 'Software Subscription', 'amount' => 299.00, 'date' => '2024-01-01', 'category' => 'software']
];

echo "Sample data seeder - This would populate your database with test data\n";
echo "Add your database insertion logic here based on your application structure\n";
