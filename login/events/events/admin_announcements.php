<?php
include('announce.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $priority = isset($_POST['priority']) ? intval($_POST['priority']) : 0; // Default priority = 0

    $query = "INSERT INTO announcements (title, description, priority) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $title, $description, $priority);
    mysqli_stmt_execute($stmt);
    
    header("Location: admin_announcements.php");
    exit();
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $deleteQuery = "DELETE FROM announcements WHERE id=?";
    $stmt = mysqli_prepare($connection, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    header("Location: admin_announcements.php");
    exit();
}

// Priority Labels
$priorityLabels = [
    0 => "Normal",
    1 => "High",
    2 => "Urgent"
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Announcements</title>
    <link rel="stylesheet" href="admin_side.css">
    <link rel="stylesheet" href="admin.css">
    <style>
        /* Prevent text overflow */
        td, th {
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
            max-width: 250px;
        }
    </style>
</head>
<body>

<div class="menu">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="admin.php">Manage Users</a></li>
            <li><a href="admin_announcements.php">Announcements</a></li>
            <li><a href="admin_eventcategories.php">Events categories</a></li>
            <li><a href="admin_events.php"> events</a></li>            
            <li><a href="admi_mess.php">Enquieries</a></li>
            <li><a href="admin_upload2.php">images</a></li>
            <li><a href="admin_comm.php">communications</a></li>
            <li><a href="admin_login.php">LOG_OUT</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="admin-container">
        <h2>Post New Announcement</h2>

        <form method="POST">
            <input type="text" name="title" placeholder="Announcement Title" required>
            <textarea name="description" placeholder="Announcement Description" required></textarea>
            <label for="priority">Priority:</label>
            <select name="priority">
                <option value="1">Normal</option>
                <option value="2">high</option>
                <option value="3"></option>
            </select>
            <button type="submit">Post Announcement</button>
        </form>

        <h2>All Announcements</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Priority</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($connection, "SELECT * FROM announcements ORDER BY priority DESC, created_at ASC");
                while ($row = mysqli_fetch_assoc($result)) {
                    $priorityText = $priorityLabels[$row['priority']];
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['title']}</td>
                        <td>{$row['description']}</td>
                        <td><strong style='color: " . ($row['priority'] == 3 ? "red" : ($row['priority'] == 2 ? "orange" : "black")) . ";'>{$priorityText}</strong></td>
                        <td>{$row['created_at']}</td>
                        <td><a href='admin_announcements.php?delete={$row['id']}' class='delete-btn' onclick='return confirm(\"Are you sure?\");'>Delete</a></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
