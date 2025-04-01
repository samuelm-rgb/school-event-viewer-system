<?php
require 'dbmes_connect.php';

// Delete messages older than 24 hours after response
$sql = "DELETE FROM messages WHERE response IS NOT NULL AND response_time <= NOW() - INTERVAL 1 DAY";
$conn->query($sql);

// Close connection
$conn->close();
?>
