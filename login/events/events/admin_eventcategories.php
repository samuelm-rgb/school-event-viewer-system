<?php
include('dbcat_connect.php'); // Include database connection

// Fetch categories from the database
$query = "SELECT * FROM event_categories ORDER BY created_at DESC";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <link rel="stylesheet" href="admin_style.css"> <!-- Link to CSS file -->
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
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Manage Event Categories</h2>

        <!-- Category Form -->
        <form action="add_category.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Category Title" required>
            <textarea name="description" placeholder="Category Description" required></textarea>
            <input type="file" name="image" accept="image/*" required>
            <button type="submit">Add Category</button>
        </form>

        <!-- Categories Table -->
        <table>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><img src="uploads/<?= $row['image'] ?>" width="80"></td>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td>
                    <a href="edit_category.php?id=<?= $row['id'] ?>">Edit</a> | 
                    <a href="delete_category.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

</body>
</html>
