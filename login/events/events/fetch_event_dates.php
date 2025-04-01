<?php
include('dbdate_connect.php'); // Connect to the database

$query = "SELECT event_date, event_name FROM event_dates";
$result = mysqli_query($connection, $query);

$eventData = [];

while ($row = mysqli_fetch_assoc($result)) {
    $eventData[] = [
        "date" => $row['event_date'], // Store event date
        "name" => $row['event_name']  // Store event name
    ];
}

header('Content-Type: application/json'); // Set response type to JSON
echo json_encode($eventData); // Return event data as JSON
?>
