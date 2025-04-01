<?php
session_start();
require_once "config.php"; // Ensure this file correctly connects to the database

// Start output buffering to prevent header issues
ob_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure email and password fields are provided
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Prepare SQL query
        $sql = "SELECT id, password FROM users WHERE email = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify user exists and password matches
        if ($user && password_verify($password, $user['password'])) {
            // Store user ID in session
            $_SESSION['id'] = $user['id'];

            // Redirect to home page
            header("Location: home.php");
            exit();
        } else {
            echo "<script>alert('Invalid email or password!'); window.location='login.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Please enter both email and password!'); window.location='login.php';</script>";
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>