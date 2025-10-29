<?php include_once 'partials/head.php'; ?>
<body>
    <?php include_once 'partials/header.php'; ?>
    <?php include_once 'partials/sidebar.php'; ?>
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="/dashboard"><em class="fa fa-home"></em></a></li>
                <li><a href="/expenses">Expenses</a></li>
                <li class="active">Add Expense</li>
            </ol>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add New Expense</h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <div class="panel panel-default">
                    <div class="panel-heading">Expense Details</div>
                    <div class="panel-body">
                        <form method="POST">
                            <div class="form-group">
                                <label>Date *</label>
                                <input type="date" name="expense_date" class="form-control" 
                                       value="<?php echo $_POST['expense_date'] ?? date('Y-m-d'); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Expense Item *</label>
                                <input type="text" name="expense_item" class="form-control" 
                                       value="<?php echo $_POST['expense_item'] ?? ''; ?>" 
                                       placeholder="e.g., Groceries, Fuel, Rent" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Cost (Ksh) *</label>
                                <input type="number" name="expense_cost" class="form-control" 
                                       value="<?php echo $_POST['expense_cost'] ?? ''; ?>" 
                                       placeholder="0.00" step="0.01" min="0" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Note (Optional)</label>
                                <textarea name="note" class="form-control" rows="3" 
                                          placeholder="Any additional notes..."><?php echo $_POST['note'] ?? ''; ?></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Add Expense</button>
                            <a href="/expenses" class="btn btn-default">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include_once 'partials/footer.php'; ?>
</body>
</html>