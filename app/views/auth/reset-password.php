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
            <h2 class="text-center">Set New Password</h2>
            
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <div class="card">
                <div class="card-body">
                    <p>Please enter your new password for <strong><?php echo $email; ?></strong></p>
                    
                    <form method="POST">
                        <input type="hidden" name="token" value="<?php echo $token; ?>">
                        
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="password" class="form-control" 
                                   required minlength="6">
                            <small class="form-text text-muted">Must be at least 6 characters long</small>
                        </div>
                        
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" name="confirm_password" class="form-control" 
                                   required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>