<?php include_once 'partials/head.php'; ?>
<body>
    <?php include_once 'partials/header.php'; ?>
    <?php include_once 'partials/sidebar.php'; ?>
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="/dashboard"><em class="fa fa-home"></em></a></li>
                <li class="active">Reports</li>
            </ol>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Expense Reports</h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Datewise Reports</div>
                    <div class="panel-body text-center">
                        <p>View expenses by specific date ranges</p>
                        <a href="/reports/datewise" class="btn btn-primary">View Report</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="panel panel-success">
                    <div class="panel-heading">Monthly Reports</div>
                    <div class="panel-body text-center">
                        <p>View monthly expense summaries</p>
                        <a href="/reports/monthly" class="btn btn-success">View Report</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">Yearly Reports</div>
                    <div class="panel-body text-center">
                        <p>View yearly expense overview</p>
                        <a href="/reports/yearly" class="btn btn-info">View Report</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include_once 'partials/footer.php'; ?>
</body>
</html>