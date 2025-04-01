<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="adminlogin.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <form action="admin_auth.php" method="POST">
                <div class="input-group">
                    <input type="text" name="email" placeholder="Email" required>
                    <span class="icon">👤</span>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                    <span class="icon">🔒</span>
                </div>
                <button type="submit" class="login-btn">Login</button>
                <p>login as<a href="index.php">User</a></p>
            </form>
        </div>
    </div>
    <div class="welcome-box">
        <h2>WELCOME BACK!</h2>
        <p>Hope you missed me while you were away 😃</p>
    </div>
</body>
</html>
