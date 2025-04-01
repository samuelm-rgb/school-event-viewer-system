<?php
session_start(); // Start session to store messages
include('dbdate_connect.php'); // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = mysqli_real_escape_string($connection, $_POST['event_name']);
    $event_date = $_POST['event_date'];

    $query = "INSERT INTO event_dates (event_name, event_date) VALUES ('$event_name', '$event_date')";

    if (mysqli_query($connection, $query)) {
        $_SESSION['message'] = "Event date added successfully!";
        $_SESSION['msg_type'] = "success"; // Store success message
    } else {
        $_SESSION['message'] = "Error: " . mysqli_error($connection);
        $_SESSION['msg_type'] = "error"; // Store error message
    }

    // ✅ Fixed incorrect syntax in header()
    header("Location: admin_events.php"); // Redirect to the same page
    exit();
}
?>
