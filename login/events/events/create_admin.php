<?php
include('dbadmin_connect.php'); // Ensure this file connects to your database

$email = "admin@gmail.com";
$password = password_hash("1234567", PASSWORD_DEFAULT); // Hash password

$query = "INSERT INTO admins (email, password) VALUES ('$email', '$password')";

if (mysqli_query($connection, $query)) {
    echo "Admin created successfully!";
} else {
    echo "Error: " . mysqli_error($connection);
}
?>
