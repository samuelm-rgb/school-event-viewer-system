<?php
// Connect to the database
$connection = new mysqli("localhost", "root", "", "school_events");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch announcements sorted by priority (higher first), then by date
$sql = "SELECT id, title, description, priority, date_posted FROM announcements ORDER BY priority DESC, date_posted DESC";
$result = $connection->query($sql);

// Start table structure
echo "<table border='1' style='width:100%; border-collapse:collapse; text-align:left;'>
        <tr style='background:#005f8b; color:white;'>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Priority</th>
            <th>Date Posted</th>
        </tr>";

// Populate table rows with data from the database
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Set priority label
        $priorityLabel = "";
        $priorityColor = "";

        switch ($row['priority']) {
            case 3:
                $priorityLabel = "high";
                $priorityColor = "red"; // Red
                break;
            case 2:
                $priorityLabel = "urgent";
                $priorityColor = "#ffcc00"; // Yellow
                break;
            case 1:
            default:
                $priorityLabel = "normal";
                $priorityColor = "#4CAF50"; // Green
                break;
        }

        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['title']}</td>
                <td>{$row['description']}</td>
                <td style='background:$priorityColor; color:white; font-weight:bold;'>{$priorityLabel}</td>
                <td>{$row['date_posted']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5' style='text-align:center;'>No announcements available</td></tr>";
}

// End table
echo "</table>";

// Close database connection
$connection->close();
?>
