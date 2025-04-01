<?php
session_start();
include('dbadmin_connect.php'); // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    // Fetch admin details from database
    $query = "SELECT * FROM admins WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $admin = mysqli_fetch_assoc($result);
        
        // Verify the password (if stored hashed, use password_verify)
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_email'] = $admin['email'];

            // Redirect to admin panel
            header("Location: admin.php");
            exit();
        } else {
            echo "<script>alert('Incorrect password!'); window.location.href='admin_login.php';</script>";
        }
    } else {
        echo "<script>alert('Admin not found!'); window.location.href='admin_login.php';</script>";
    }
}
?>
