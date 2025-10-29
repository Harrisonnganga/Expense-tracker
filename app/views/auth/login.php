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
            margin: 50px auto;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h1 class="text-center">Daily Expense Tracker</h1>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <div class="card">
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                    <!-- Add these links after the login form -->
                            <div class="text-center mt-3">
                                <a href="/forgot-password">Forgot Password?</a>
                            </div>

                            <div class="text-center mt-3">
                                <p>Don't have an account? <a href="/register">Sign up here</a></p>
                            </div>
                                                <hr>
                    <p class="text-center small text-muted">
                        Use: test@test.com / password
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>