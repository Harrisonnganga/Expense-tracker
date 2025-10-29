<?php include_once 'partials/head.php'; ?>

<body>
    <?php include_once 'partials/header.php'; ?>
    <?php include_once 'partials/sidebar.php'; ?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Dashboard</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
        </div>
        <!--/.row-->

        <div class="row">
            <!-- Today's Expense -->
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <h4>Today's Expense</h4>
                        <div class="easypiechart" id="easypiechart-blue"
                            data-percent="<?php echo format_kes($stats['today_amount']); ?>">
                            <span class="percent">KSh <?php echo $stats['today_expense']; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Yesterday's Expense -->
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <h4>Yesterday's Expense</h4>
                        <div class="easypiechart" id="easypiechart-orange"
                            data-percent="<?php echo $stats['yesterday_amount']; ?>">
                            <span class="percent">KSh <?php echo $stats['yesterday_expense']; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Last 7 Days Expense -->
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <h4>Last 7 Day's Expense</h4>
                        <div class="easypiechart" id="easypiechart-teal"
                            data-percent="<?php echo $stats['weekly_amount']; ?>">
                            <span class="percent">KSh <?php echo $stats['weekly_expense']; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Last 30 Days Expense -->
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <h4>Last 30 Day's Expenses</h4>
                        <div class="easypiechart" id="easypiechart-red"
                            data-percent="<?php echo $stats['monthly_amount']; ?>">
                            <span class="percent">KSh <?php echo $stats['monthly_expense']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="row">
            <!-- Current Year Expense -->
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <h4>Current Year Expenses</h4>
                        <div class="easypiechart" id="easypiechart-green"
                            data-percent="<?php echo $stats['yearly_amount']; ?>">
                            <span class="percent">KSh <?php echo $stats['yearly_expense']; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Expense -->
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <h4>Total Expenses</h4>
                        <div class="easypiechart" id="easypiechart-purple"
                            data-percent="<?php echo $stats['total_amount']; ?>">
                            <span class="percent">KSh <?php echo $stats['total_expense']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.row-->
    </div>
    <!--/.main-->

    <?php include_once 'partials/footer.php'; ?>

    <script src="<?php echo asset('js/jquery-1.11.1.min.js'); ?>"></script>
    <script src="<?php echo asset('js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo asset('js/chart.min.js'); ?>"></script>
    <script src="<?php echo asset('js/chart-data.js'); ?>"></script>
    <script src="<?php echo asset('js/easypiechart.js'); ?>"></script>
    <script src="<?php echo asset('js/easypiechart-data.js'); ?>"></script>
    <script src="<?php echo asset('js/bootstrap-datepicker.js'); ?>"></script>
    <script src="<?php echo asset('js/custom.js'); ?>"></script>

    <script>
    window.onload = function() {
        // Initialize EasyPieCharts
        $('.easypiechart').easyPieChart({
            easing: 'easeOutBounce',
            barColor: function(percent) {
                // Different colors for different charts
                var id = $(this).attr('id');
                var colors = {
                    'easypiechart-blue': '#30a5ff',
                    'easypiechart-orange': '#ffb53e',
                    'easypiechart-teal': '#1ebfae',
                    'easypiechart-red': '#f9243f',
                    'easypiechart-green': '#4CAF50',
                    'easypiechart-purple': '#9C27B0'
                };
                return colors[id] || '#30a5ff';
            },
            trackColor: '#f2f2f2',
            scaleColor: false,
            lineWidth: 8,
            lineCap: 'round',
            animate: 1000,
            onStep: function(from, to, percent) {
                $(this.el).find('.percent').text(Math.round(percent));
            }
        });
    };
    </script>
</body>

</html>