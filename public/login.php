<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Digital Garden</title>
    <link rel="stylesheet" href="../public_assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>

    <?php
    include_once "../includes/header.php";
    ?>

    <main class="auth-section">
        <div class="auth-card">
            <h2>Welcome Back</h2>

            <div id="error-msg" class="error-message">
                Invalid email or password.
            </div>

            <form action="auth.php" method="POST" id="loginForm">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <button type="submit" name="login_btn" class="btn-block">Login</button>
            </form>

            <div class="auth-footer">
                <p>Don't have an account? <a href="register.php">Sign up</a></p>
            </div>
        </div>
    </main>

    <?php
    include_once "../includes/footer.php";
    ?>

    <script src="../public_assets/js/index.js"></script>
</body>

</html>