<?php
$host = "localhost"; 
$username = "root";  
$password = "";  
$database = "signin"; 

// Fix: Use only positional arguments
$connection = mysqli_connect($host, $username, $password, $database);

// Check MySQLi connection
if (!$connection) {
    die("MySQLi Connection failed: " . mysqli_connect_error());
}

// Using PDO for database connection
try {
    $db = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("PDO Connection failed: " . $e->getMessage());
}
?>
