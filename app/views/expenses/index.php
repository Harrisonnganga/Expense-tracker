<?php include_once 'partials/head.php'; ?>
<body>
    <?php include_once 'partials/header.php'; ?>
    <?php include_once 'partials/sidebar.php'; ?>
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="/dashboard"><em class="fa fa-home"></em></a></li>
                <li class="active">Manage Expenses</li>
            </ol>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Manage Expenses</h1>
            </div>
        </div>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Expense added successfully!</div>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Your Expenses
                        <a href="/expenses/add" class="btn btn-primary btn-sm pull-right">
                            <em class="fa fa-plus"></em> Add New Expense
                        </a>
                    </div>
                    <div class="panel-body">
                        <?php if ($expenses && $expenses->num_rows > 0): ?>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Item</th>
                                        <th>Cost</th>
                                        <th>Note</th>
                                        <th>Added On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($expense = $expenses->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $expense['expense_date']; ?></td>
                                        <td><?php echo $expense['expense_item']; ?></td>
                                        <td>$<?php echo number_format($expense['expense_cost'], 2); ?></td>
                                        <td><?php echo $expense['note'] ?: '-'; ?></td>
                                        <td><?php echo date('M j, Y', strtotime($expense['created_at'])); ?></td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="text-center" style="padding: 40px;">
                                <h3>No expenses found</h3>
                                <p>You haven't added any expenses yet.</p>
                                <a href="/expenses/add" class="btn btn-primary">Add Your First Expense</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include_once 'partials/footer.php'; ?>
</body>
</html>