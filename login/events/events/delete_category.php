<?php
include('dbcat_connect.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "DELETE FROM event_categories WHERE id = $id";
    
    if (mysqli_query($connection, $query)) {
        echo "Category deleted successfully!";
    } else {
        echo "Error deleting category.";
    }
}
?>
