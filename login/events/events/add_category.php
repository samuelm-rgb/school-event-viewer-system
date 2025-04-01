<?php
include('dbcat_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    
    // Handle Image Upload
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $query = "INSERT INTO event_categories (title, description, image) VALUES ('$title', '$description', '$image')";
        
        if (mysqli_query($connection, $query)) {
            echo "Category added successfully!";
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    } else {
        echo "Failed to upload image.";
    }
}
?>
