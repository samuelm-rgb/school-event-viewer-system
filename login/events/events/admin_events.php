<?php
include('dbe_connect.php'); // Ensure this connects to your database

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $category = mysqli_real_escape_string($connection, $_POST['category']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);

    // Handle Image Upload
    if (!empty($_FILES['event_image']['name'])) {
        $imageName = time() . '_' . $_FILES['event_image']['name'];
        $target = "uploads/" . $imageName;
        move_uploaded_file($_FILES['event_image']['tmp_name'], $target);
    } else {
        $imageName = NULL; // No image uploaded
    }

    // Insert into database
    $query = "INSERT INTO events (title, image, category, description) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $title, $imageName, $category, $description);
    mysqli_stmt_execute($stmt);

    header("Location: admin_events.php?success=1");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Post Event</title>
    <link rel="stylesheet" href="admine.css">
</head>
<body>

    <!-- Sidebar Navigation -->
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
    </div>

    <!-- Main Content -->
    <div class="admin-container">
        <h2>Post a New Event</h2>

        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Event Title" required>
            <input type="file" name="event_image">
            <select name="category" required>
                <option value="Cultural">Cultural</option>
                <option value="Sports">Sports</option>
                <option value="Academic">Academic</option>
                <option value="Others">Others</option>
            </select>
            <textarea name="description" placeholder="Event Description" required></textarea>
            <button type="submit">Post Event</button>
        </form>

        <h2>All Events</h2>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($connection, "SELECT * FROM events ORDER BY created_at DESC");
                while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['title'] ?></td>
                        <td>
                            <?php if ($row['image']): ?>
                                <img src="uploads/<?= $row['image'] ?>" width="50">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </td>
                        <td><?= $row['category'] ?></td>
                        <td><?= $row['description'] ?></td>
                        <td>
                            <a href="edit_event.php?id=<?= $row['id'] ?>">Edit</a> |
                            <a href="delete_event.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this event?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <?php if (isset($_GET['success'])): ?>
            <p style="color: green;">Event posted successfully!</p>
        <?php endif; ?>
    </div>
    <section class="event-date-management">
    <h2>📅 Manage Event Dates</h2>
    
    <!-- Form to Add Event Dates -->
    <form action="add_date.php" method="POST">
        <label for="event_name">Event Name:</label>
        <input type="text" id="event_name" name="event_name" required>

        <label for="event_date">Select Event Date:</label>
        <input type="date" id="event_date" name="event_date" required>

        <button type="submit">Add Date</button>
    </form>

    <!-- Display Event Dates -->
    <h3>📌 Event Dates</h3>
    <table>
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('dbdate_connect.php');
            $query = "SELECT * FROM event_dates ORDER BY event_date ASC";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['event_name']}</td>
                        <td>{$row['event_date']}</td>
                        <td>
                            <a href='delete_date.php?id={$row['id']}'>🗑 Delete</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</section>


</body>
</html>
