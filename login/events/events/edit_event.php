<?php
include('dbe_connect.php');

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$id = intval($_GET['id']);
$result = mysqli_query($connection, "SELECT * FROM events WHERE id=$id");
$event = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $category = mysqli_real_escape_string($connection, $_POST['category']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);

    $updateQuery = "UPDATE events SET title=?, category=?, description=? WHERE id=?";
    $stmt = mysqli_prepare($connection, $updateQuery);
    mysqli_stmt_bind_param($stmt, "sssi", $title, $category, $description, $id);
    mysqli_stmt_execute($stmt);

    header("Location: admin_events.php?updated=1");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
</head>
<body>

    <h2>Edit Event</h2>
    <form method="POST">
        <input type="text" name="title" value="<?= $event['title'] ?>" required>
        <select name="category" required>
            <option value="Cultural" <?= ($event['category'] == 'Cultural') ? 'selected' : '' ?>>Cultural</option>
            <option value="Sports" <?= ($event['category'] == 'Sports') ? 'selected' : '' ?>>Sports</option>
            <option value="Academic" <?= ($event['category'] == 'Academic') ? 'selected' : '' ?>>Academic</option>
            <option value="Others" <?= ($event['category'] == 'Others') ? 'selected' : '' ?>>Others</option>
        </select>
        <textarea name="description" required><?= $event['description'] ?></textarea>
        <button type="submit">Update Event</button>
    </form>

</body>
</html>
