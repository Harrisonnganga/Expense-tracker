<?php
require_once 'config/session.php';
require_once 'config/database.php';
requireLogin();

$database = new Database();
$db = $database->getConnection();
$user_id = $_SESSION['user_id'];

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'] ?? 0;
    $description = $_POST['description'] ?? '';
    $category = $_POST['category'] ?? '';
    $expense_date = $_POST['expense_date'] ?? date('Y-m-d');
    
    if ($amount > 0 && !empty($description) && !empty($category)) {
        $query = "INSERT INTO expenses (user_id, amount, description, category, expense_date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        
        if ($stmt->execute([$user_id, $amount, $description, $category, $expense_date])) {
            $success = 'Expense added successfully!';
            // Clear form
            $_POST = array();
        } else {
            $error = 'Failed to add expense. Please try again.';
        }
    } else {
        $error = 'Please fill all required fields correctly.';
    }
}

$page_title = "Add Expense";
include 'includes/header.php';
?>

<div class="content-section">
    <div class="expense-section">
        <h3>Add New Expense</h3>
        
        <?php if ($success): ?>
            <div class="success-message"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="amount">Amount ($)</label>
                <input type="number" id="amount" name="amount" step="0.01" min="0" value="<?php echo $_POST['amount'] ?? ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" placeholder="What did you spend on?" value="<?php echo $_POST['description'] ?? ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="Food" <?php echo ($_POST['category'] ?? '') == 'Food' ? 'selected' : ''; ?>>Food</option>
                    <option value="Transportation" <?php echo ($_POST['category'] ?? '') == 'Transportation' ? 'selected' : ''; ?>>Transportation</option>
                    <option value="Entertainment" <?php echo ($_POST['category'] ?? '') == 'Entertainment' ? 'selected' : ''; ?>>Entertainment</option>
                    <option value="Utilities" <?php echo ($_POST['category'] ?? '') == 'Utilities' ? 'selected' : ''; ?>>Utilities</option>
                    <option value="Shopping" <?php echo ($_POST['category'] ?? '') == 'Shopping' ? 'selected' : ''; ?>>Shopping</option>
                    <option value="Healthcare" <?php echo ($_POST['category'] ?? '') == 'Healthcare' ? 'selected' : ''; ?>>Healthcare</option>
                    <option value="Other" <?php echo ($_POST['category'] ?? '') == 'Other' ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="expense_date">Date</label>
                <input type="date" id="expense_date" name="expense_date" value="<?php echo $_POST['expense_date'] ?? date('Y-m-d'); ?>" required>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-plus"></i> Add Expense
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset
                </button>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>