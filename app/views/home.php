<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="<?php echo asset('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <style>
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h1 class="text-center">Daily Expense Tracker</h1>
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Welcome</h2>
                    <p class="text-center">Please login to continue</p>
                    <a href="/login" class="btn btn-primary btn-block">Login</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>