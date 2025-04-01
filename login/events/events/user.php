<?php
$conn = new mysqli("localhost", "root", "", "media");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM media ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media Gallery</title>
    <link rel="stylesheet" href="users.css">
</head>
<body>

<header class="navbar">
    <div class="logo">
        <a href="#">EduEvents</a>
    </div>

    <nav class="nav-links">
        <a href="home.php">Home</a>
        <a href="events.php">Events</a>
        <a href="contact.php">Contact</a>
        <a href="user.php">images</a>        
       
    </nav>

    <div class="search-bar">
       
       <a href="index.php">LOG_OUT</a>
    </div>    
</header>













    <h2 style="text-align:center;">Media Gallery</h2>
    <div class="gallery-container">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="card">
                <h3><?= htmlspecialchars($row['title']) ?></h3>
                <?php if ($row['media_type'] == 'image') { ?>
                    <img src="uploads/<?= htmlspecialchars($row['file_path']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                <?php } else { ?>
                    <video controls>
                        <source src="uploads/<?= htmlspecialchars($row['file_path']) ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</body>
</html>
<?php $conn->close(); ?>












    
<footer class="footer">
    <div class="footer-container">
        <div class="footer-section about">
            <h2>About Our School</h2>
            <p>Your trusted source for school event updates and management.</p>
        </div>
        <div class="footer-section contact">
            <h2>Contact Us</h2>
            <p>📍 Address: 123 School Street, Nairobi, Kenya</p>
            <p>📞 Phone: +254 712 345 678</p>
            <p>📧 Email: info@schoolname.ac.ke</p>
        </div>
        <div class="footer-section social">
            <h2>Follow Us</h2>
            <a href="https://facebook.com/schoolname" target="_blank">Facebook</a>
            <a href="https://twitter.com/schoolname" target="_blank">Twitter</a>
            <a href="https://instagram.com/schoolname" target="_blank">Instagram</a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2025 School Name. All Rights Reserved.</p>
    </div>
</footer>