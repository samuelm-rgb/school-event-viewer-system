<?php
include('dbdate_connect.php'); // Ensure this file correctly connects to the database

if (isset($_GET["id"])) { // Check if ID is passed
    $id = intval($_GET["id"]); // Convert to integer for security

    // Prepare delete query
    $query = "DELETE FROM event_dates WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $id); // Bind ID as an integer

    if ($stmt->execute()) {
        echo "<script>alert('Event date deleted successfully!'); window.location.href='admin_events.php';</script>";
    } else {
        echo "<script>alert('Error deleting event: " . $stmt->error . "'); window.location.href='admin_events.php';</script>";
    }

    $stmt->close();
    $connection->close();
} else {
    echo "<script>alert('Invalid request!'); window.location.href='admin_events.php';</script>";
}
?>
