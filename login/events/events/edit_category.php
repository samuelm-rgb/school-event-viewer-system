<?php
include('dbcat_connect.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM event_categories WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $category = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    
    $query = "UPDATE event_categories SET title='$title', description='$description' WHERE id=$id";
    
    if (mysqli_query($connection, $query)) {
        echo "Category updated successfully!";
    } else {
        echo "Error updating category.";
    }
}
?>

<form method="POST">
    <input type="text" name="title" value="<?= $category['title'] ?>" required>
    <textarea name="description" required><?= $category['description'] ?></textarea>
    <button type="submit">Update Category</button>
</form>
