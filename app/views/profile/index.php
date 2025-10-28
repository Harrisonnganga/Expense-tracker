<?php include_once 'partials/head.php'; ?>
<body>
    <?php include_once 'partials/header.php'; ?>
    <?php include_once 'partials/sidebar.php'; ?>
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="/dashboard"><em class="fa fa-home"></em></a></li>
                <li class="active">My Profile</li>
            </ol>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">My Profile</h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Profile Information</div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Full Name:</th>
                                <td><?php echo $user['full_name']; ?></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><?php echo $user['email']; ?></td>
                            </tr>
                            <tr>
                                <th>Mobile Number:</th>
                                <td><?php echo $user['mobile_number'] ?: 'Not set'; ?></td>
                            </tr>
                            <tr>
                                <th>Member Since:</th>
                                <td><?php echo date('F j, Y', strtotime($user['created_at'])); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include_once 'partials/footer.php'; ?>
</body>
</html>