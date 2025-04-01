<?php
include('dbe_connect.php');

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$id = intval($_GET['id']);
mysqli_query($connection, "DELETE FROM events WHERE id=$id");

header("Location: admin_events.php?deleted=1");
exit();
?>
