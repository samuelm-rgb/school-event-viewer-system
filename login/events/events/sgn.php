<?php
require_once "config.php"; // Ensure the database connection is included

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signin"])) {
    
    // Collect user input safely
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $phonenumber = isset($_POST['phone_number']) ? trim($_POST['phone_number']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmpassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    // Debugging: Print received values
    if (empty($username) || empty($phonenumber) || empty($email) || empty($password) || empty($confirmpassword)) {
        echo "<script>alert('All fields are required!'); window.location='signup.php';</script>";
        exit;
    }

    // ✅ Check if passwords match
    if ($password !== $confirmpassword) {
        echo "<script>alert('Passwords do not match!'); window.location='signup.php';</script>";
        exit;
    }

    // ✅ Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // ✅ At this point, you can proceed to insert into the database

    try {
        $sql = "INSERT INTO users (username, phone_number, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute([$username, $phonenumber, $email, $hashed_password]);

        if ($result) {
            echo "User successfully registered!";
        } else {
            echo "Error: Could not insert user data.";
        }
    


        if ($result) {
            echo "<script>alert('Registration successful! Redirecting to home page...');</script>";
            echo "<meta http-equiv='refresh' content='2;url=http://localhost/SCHOOL%20EVENT%20VIEWER%20AND%20MANAGEMENT%20SYSTEM/login/events/events/home.php'>"; // Redirects after 2 seconds
            exit();
        } else {
            echo "Error: " . $stmt->errorInfo()[2]; // Display database error
        }
    } catch (PDOException $e) {
        echo "Database Error: " . $e->getMessage();
    }
  
}

?>

?>

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-in Page</title>
    <link rel="stylesheet" href="sgn.css">
</head>
<body>
    <div class="signin-container">
        <div class="signin-box">
            <h2>Sign-in</h2>
        

            <form action="sgn.php" method="post">
    <div class="input-group">
        <input type="text" name="username" placeholder="Username" required>
        <span class="icon">👤</span>
    </div>
    <div class="input-group">
        <input type="number" name="phone_number" placeholder="Phone number" required>
        <span class="icon">📞</span>
    </div>
    <div class="input-group">
        <input type="email" name="email" placeholder="Email" required>
        <span class="icon">📧</span>
    </div>
    <div class="input-group">
        <input type="password" name="password" placeholder="Password" required>
        <span class="icon">🔒</span>
    </div>
    <div class="input-group">
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <span class="icon">🔒</span>
    </div>
    <button type="submit" name="signin" class="signin-btn">Sign in</button>
    <p>already have an account? <a href="index.php">LOGIN</a></p> 
</form>




        </div>
    </div>
    <div class="welcome-box">
        <h2>WELCOME!</h2>
        <p>Hope you have a great time with us 😊</p>
    </div>
</body>
</html>
