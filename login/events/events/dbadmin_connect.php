<?php
$server = "localhost";  // Default is localhost
$username = "root";      // Default XAMPP username
$password = "";          // Default XAMPP password (leave empty)
$database = "signin"; // Replace with your actual database name

// Create connection
$connection = mysqli_connect($server, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
