<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "school_events";

// Connect to MySQL
$connection = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch events ordered by date
$query = "SELECT * FROM events ORDER BY event_date ASC";
$result = mysqli_query($connection, $query);

$events = [];
while ($row = mysqli_fetch_assoc($result)) {
    $events[] = $row;
}

// Return events as JSON
echo json_encode($events);
?>
