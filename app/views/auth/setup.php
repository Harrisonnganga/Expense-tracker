<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="<?php echo asset('css/bootstrap.min.css'); ?>" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1 class="text-center">Database Setup</h1>
                
                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <h4>✅ Setup Completed Successfully!</h4>
                        <p>Database tables have been created and a test user has been added.</p>
                        <p><strong>Test Login:</strong><br>
                        Email: testuser@gmail.com<br>
                        Password: Test@123</p>
                    </div>
                    <a href="/login" class="btn btn-primary btn-block">Go to Login</a>
                <?php else: ?>
                    <div class="alert alert-danger">
                        <h4>❌ Setup Failed</h4>
                        <p>There was an error setting up the database. Please check your database configuration.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>