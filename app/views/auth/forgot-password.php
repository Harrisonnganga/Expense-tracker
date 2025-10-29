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
            <h2 class="text-center">Reset Your Password</h2>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if (isset($success) && $success): ?>
                <div class="alert alert-success">
                    <h4>Password Reset Link Generated!</h4>
                    <p>In a real application, we would send this link to your email.</p>
                    <p><strong>For testing purposes:</strong></p>
                    <p><a href="<?php echo $reset_url; ?>">Click here to reset your password</a></p>
                    <p class="small text-muted">Reset URL: <?php echo $reset_url; ?></p>
                </div>
                <div class="text-center">
                    <a href="/login" class="btn btn-primary">Back to Login</a>
                </div>
            <?php else: ?>
                <div class="card">
                    <div class="card-body">
                        <p>Enter your email address and we'll send you a link to reset your password.</p>
                        
                        <form method="POST">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" class="form-control" 
                                       value="<?php echo $email ?? ''; ?>" 
                                       required autofocus>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-block">Send Reset Link</button>
                        </form>
                        
                        <div class="text-center mt-3">
                            <a href="/login">Back to Login</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>