<?php
session_start();
include('config.php');

// Check if the delete request is valid
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && !empty($_POST['id'])) {
    $user_id = intval($_POST['id']); // Convert to integer for safety

    // Prevent admin from deleting themselves
    if ($user_id == $_SESSION['user_id']) {
        echo "<script>alert('You cannot delete yourself!'); window.location.href='admin.php';</script>";
        exit();
    }

    // Use prepared statement to delete user securely
    $query = "DELETE FROM users WHERE ID = ?";
    $stmt = mysqli_prepare($connection, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('User deleted successfully!'); window.location.href='admin.php';</script>";
        } else {
            echo "<script>alert('Error deleting user.'); window.location.href='admin.php';</script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Query preparation failed.'); window.location.href='admin.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request. ID missing!'); window.location.href='admin.php';</script>";
}
mysqli_close($connection);
?>
