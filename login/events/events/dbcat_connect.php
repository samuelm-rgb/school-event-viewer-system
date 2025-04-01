<?php
$connection = new mysqli("localhost", "root", "", "categories");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>








