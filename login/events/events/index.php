<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="lgn style.css">
    <script src="lgn.js"></script>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <form action="login_process.php" method="post">
                <div class="input-group">
                    <input type="text" name="email" placeholder="Email" required>
                    <span class="icon">👤</span>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                    <span class="icon">🔒</span>
                </div>
                <button type="submit" class="login-btn">Login</button>
                <p>login as<a href="admin_login.php">ADMIN</a></p>
                <p>Don't have an account? <a href="sgn.php">Sign Up</a></p>
                <p>login as <a href="guest_events.php">Guest</a></p> 
            </form>
        </div>
    </div>
    <div class="welcome-box">
        <h2>WELCOME BACK!</h2>
        <p>Hope you missed me while you were away 😃</p>
    </div>
</body>
</html>
