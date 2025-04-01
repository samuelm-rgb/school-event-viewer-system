<?php
include 'dbimages_connect.php'; // Include database connection

if (isset($_POST['delete'])) {
    $mediaId = $_POST['media_id'];
    $mediaPath = $_POST['media_path'];
    $filePath = "uploads/" . $mediaPath; // Full file path

    // Delete file from the server
    if (file_exists($filePath)) {
        unlink($filePath); // Delete the file
    }

    // Delete from database
    $sql = "DELETE FROM event_media WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $mediaId);

    if ($stmt->execute()) {
        echo "<script>alert('Media deleted successfully!'); window.location.href='admin_upload.php';</script>";
    } else {
        echo "<script>alert('Error deleting media!'); window.location.href='admin_upload.php';</script>";
    }
}
?>
