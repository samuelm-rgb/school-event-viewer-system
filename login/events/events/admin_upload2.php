<?php
$conn = new mysqli("localhost", "root", "", "media");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM media WHERE id = $id";
    if ($conn->query($sql)) {
        echo "<script>alert('Media deleted successfully!'); window.location='admin_upload2.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Fetch all media files
$result = $conn->query("SELECT * FROM media ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel - Manage Media</title>
    <link rel="stylesheet" href="images.css"> <!-- Linking external CSS -->
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

<!-- Main Content -->
<div class="main-content">
    
    <!-- Upload Form -->
    <div class="upload-container">
        <h2>Upload Image or Video</h2>
        <form action="admin_upload2.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Enter title" required><br><br>
            <input type="file" name="file" accept="image/*,video/*" required><br><br>
            <button type="submit">Upload</button>
        </form>
    </div>

    <!-- Media Management Table -->
    <div class="table-container">
        <h2>Manage Uploaded Media</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Media</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['title'] ?></td>
                    <td>
                        <?php if ($row['media_type'] === 'image'): ?>
                            <img src="uploads/<?= $row['file_path'] ?>" width="80" height="60">
                        <?php else: ?>
                            <video width="80" height="60" controls>
                                <source src="uploads/<?= $row['file_path'] ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        <?php endif; ?>
                    </td>
                    <td><?= ucfirst($row['media_type']) ?></td>
                    <td>
                        
                        <a href="admin_upload2.php?delete=<?= $row['id'] ?>" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

</div>



<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $file = $_FILES['file'];

    // Check for errors
    if ($file['error'] !== 0) {
        die("File upload error: " . $file['error']);
    }

    // Create the uploads directory if it doesn't exist
    if (!file_exists("uploads/")) {
        mkdir("uploads/", 0777, true);
    }

    // Generate unique file name
    $file_name = time() . "_" . basename($file['name']);
    $target_file = "uploads/" . $file_name;

    // Detect media type
    $media_type = (strpos($file['type'], "image") !== false) ? "image" : "video";

    // Move the uploaded file
    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        // Insert into database
        $sql = "INSERT INTO media (title, file_path, media_type) VALUES ('$title', '$file_name', '$media_type')";
        if ($conn->query($sql)) {
            echo "<script>alert('File uploaded successfully!'); window.location='admin_upload2.php';</script>";
        } else {
            echo "Database error: " . $conn->error;
        }
    } else {
        die("Failed to move uploaded file.");
    }
}
?>


</body>
</html>
<?php $conn->close(); ?>
