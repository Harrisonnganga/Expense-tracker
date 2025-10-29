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
        .login-link {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="auth-container">
            <h1 class="text-center">Daily Expense Tracker</h1>
            <h2 class="text-center">Create Account</h2>
            
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
                    <form method="POST">
                        <div class="form-group">
                            <label>Full Name *</label>
                            <input type="text" name="full_name" class="form-control" 
                                   value="<?php echo $form_data['full_name'] ?? ''; ?>" 
                                   required autofocus>
                        </div>
                        
                        <div class="form-group">
                            <label>Email Address *</label>
                            <input type="email" name="email" class="form-control" 
                                   value="<?php echo $form_data['email'] ?? ''; ?>" 
                                   required>
                        </div>
                        
                        <div class="form-group">
                            <label>Mobile Number (Optional)</label>
                            <input type="tel" name="mobile_number" class="form-control" 
                                   value="<?php echo $form_data['mobile_number'] ?? ''; ?>" 
                                   placeholder="e.g., 0712345678">
                        </div>
                        
                        <div class="form-group">
                            <label>Password *</label>
                            <input type="password" name="password" class="form-control" 
                                   required minlength="6">
                            <small class="form-text text-muted">Must be at least 6 characters long</small>
                        </div>
                        
                        <div class="form-group">
                            <label>Confirm Password *</label>
                            <input type="password" name="confirm_password" class="form-control" 
                                   required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                    </form>
                    
                    <div class="login-link">
                        <p>Already have an account? <a href="/login">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>