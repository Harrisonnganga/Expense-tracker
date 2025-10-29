<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="<?php echo asset('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <style>
        .auth-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="auth-container">
            <h1 class="text-center">Daily Expense Tracker</h1>
            
            <div class="card">
                <div class="card-body text-center">
                    <div class="alert alert-success">
                        <h4>✅ Password Reset Successful!</h4>
                        <p>Your password has been reset successfully.</p>
                    </div>
                    
                    <a href="/login" class="btn btn-primary">Login with New Password</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>