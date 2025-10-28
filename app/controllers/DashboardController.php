<?php
// app/controllers/DashboardController.php

class DashboardController {
    
    public function index() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        
        $user_id = $_SESSION['user_id'];
        
        // Get dashboard statistics
        $stats = $this->getDashboardStats($user_id);
        
        $this->showView('dashboard', [
            'title' => 'Daily Expense Tracker - Dashboard',
            'stats' => $stats
        ]);
    }
    
    private function getDashboardStats($user_id) {
        $stats = [];
        
        // Today's Expense - Fixed to show 0.00 when no expenses
        $tdate = date('Y-m-d');
        $today_result = DB::query("SELECT SUM(expense_cost) as todaysexpense FROM expenses WHERE expense_date = '$tdate' AND user_id = '$user_id'");
        $today_row = $today_result->fetch_assoc();
        $stats['today_expense'] = $today_row['todaysexpense'] ? number_format($today_row['todaysexpense'], 2) : '0.00';
        
        // Yesterday's Expense
        $ydate = date('Y-m-d', strtotime("-1 days"));
        $yesterday_result = DB::query("SELECT SUM(expense_cost) as yesterdayexpense FROM expenses WHERE expense_date = '$ydate' AND user_id = '$user_id'");
        $yesterday_row = $yesterday_result->fetch_assoc();
        $stats['yesterday_expense'] = $yesterday_row['yesterdayexpense'] ? number_format($yesterday_row['yesterdayexpense'], 2) : '0.00';
        
        // Last 7 Days Expense
        $pastdate = date("Y-m-d", strtotime("-1 week"));
        $currentdate = date("Y-m-d");
        $weekly_result = DB::query("SELECT SUM(expense_cost) as weeklyexpense FROM expenses WHERE expense_date BETWEEN '$pastdate' AND '$currentdate' AND user_id = '$user_id'");
        $weekly_row = $weekly_result->fetch_assoc();
        $stats['weekly_expense'] = $weekly_row['weeklyexpense'] ? number_format($weekly_row['weeklyexpense'], 2) : '0.00';
        
        // Last 30 Days Expense
        $monthdate = date("Y-m-d", strtotime("-1 month"));
        $monthly_result = DB::query("SELECT SUM(expense_cost) as monthlyexpense FROM expenses WHERE expense_date BETWEEN '$monthdate' AND '$currentdate' AND user_id = '$user_id'");
        $monthly_row = $monthly_result->fetch_assoc();
        $stats['monthly_expense'] = $monthly_row['monthlyexpense'] ? number_format($monthly_row['monthlyexpense'], 2) : '0.00';
        
        // Current Year Expense
        $cyear = date("Y");
        $yearly_result = DB::query("SELECT SUM(expense_cost) as yearlyexpense FROM expenses WHERE YEAR(expense_date) = '$cyear' AND user_id = '$user_id'");
        $yearly_row = $yearly_result->fetch_assoc();
        $stats['yearly_expense'] = $yearly_row['yearlyexpense'] ? number_format($yearly_row['yearlyexpense'], 2) : '0.00';
        
        // Total Expense
        $total_result = DB::query("SELECT SUM(expense_cost) as totalexpense FROM expenses WHERE user_id = '$user_id'");
        $total_row = $total_result->fetch_assoc();
        $stats['total_expense'] = $total_row['totalexpense'] ? number_format($total_row['totalexpense'], 2) : '0.00';
        
        return $stats;
    }
    
    private function showView($view, $data = []) {
        extract($data);
        require_once "app/views/{$view}.php";
    }
}
?>