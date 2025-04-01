<?php
session_start();
require 'dbmes_connect.php'; // Ensure database connection is included

// Fetch all messages
$sql = "SELECT * FROM messages ORDER BY created_at DESC";
$result = $conn->query($sql);

// Handle response submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['message_id'])) {
    $message_id = intval($_POST['message_id']);
    $response = trim($_POST['response']);

    if (!empty($response)) {
        $stmt = $conn->prepare("UPDATE messages SET response = ?, response_time = NOW() WHERE id = ?");
        $stmt->bind_param("si", $response, $message_id);
        if ($stmt->execute()) {
            echo "<script>alert('Response sent successfully!'); window.location.href = 'admi_mess.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error updating response.');</script>";
        }
    }
}

// Handle message deletion

include('dbdate_connect.php'); // Ensure database connection is included

if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);

    if ($conn->query("DELETE FROM messages WHERE id = $delete_id")) {
        echo "<script>
                alert('Message deleted successfully!');
                window.location.href = 'admi_mess.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Error deleting message.');
                window.location.href = 'admi_mess.php';
              </script>";
        exit();
    }
}

// Ensure there's no HTML or unclosed PHP code after this
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Messages</title>
    <link rel="stylesheet" href="admi.css">
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
            <li><a href="admin_upload2.php">imagesS</a></li>
            <li><a href="admin_comm.php">communications</a></li>
            <li><a href="admin_login.php">LOG_OUT</a></li>
        </ul>
    </div>

<div class="content">
    <h2>Admin - Manage Messages</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Response</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
                <td><?= htmlspecialchars($row['message']); ?></td>
                <td>
                    <?= !empty($row['response']) ? htmlspecialchars($row['response']) : 'No response yet'; ?>
                    <?php if (empty($row['response'])): ?>
                        <form method="POST">
                            <input type="hidden" name="message_id" value="<?= $row['id']; ?>">
                            <textarea name="response" required placeholder="Write your response..."></textarea>
                            <button type="submit" class="btn">Send Response</button>
                        </form>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="?delete_id=<?= $row['id']; ?>" class="delete-btn" onclick="return confirm('Delete this message?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
