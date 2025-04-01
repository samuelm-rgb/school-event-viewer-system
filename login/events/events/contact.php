<?php
// Database Configuration
$servername = "localhost";
$username = "root";  // Default for XAMPP
$password = "";      // Default is empty
$dbname = "messages"; // ✅ Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Handle Form Submission
$messageSent = false;
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validate Inputs
    if (empty($name) || empty($email) || empty($message)) {
        $errorMessage = "❌ All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "❌ Invalid email format!";
    } else {
        // Prevent SQL Injection
        $name = $conn->real_escape_string($name);
        $email = $conn->real_escape_string($email);
        $message = $conn->real_escape_string($message);

        // Insert into Database
        $sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";
        
        if ($conn->query($sql) === TRUE) {
            $messageSent = true;
        } else {
            $errorMessage = "❌ Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contact.css">
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

<div class="content-container"> <!-- ADDED: New container to hold both sections -->
    <div class="contact-form">
        <h2>Contact Form</h2>

        <?php if ($messageSent): ?>
            <p class="message success">✅ Your message has been sent successfully!</p>
        <?php elseif (!empty($errorMessage)): ?>
            <p class="message error"><?= $errorMessage; ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>

            <button type="submit">Send Message</button>
        </form>

       
    <div class="qa-section"> <!-- ADDED: Moved inside content-container -->
        <h2>User Questions & Admin Responses</h2>

        <?php
        $sql = "SELECT id, name, message, response, created_at FROM messages ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
            <div class="qa-card">
                <div class="qa-header">
                    <h3><?= htmlspecialchars($row['name']); ?></h3>
                    <span class="qa-date">Asked on: <?= date('F j, Y', strtotime($row['created_at'])); ?></span>
                </div>
                <p class="qa-question"><?= nl2br(htmlspecialchars($row['message'])); ?></p>

                <?php if (!empty($row['response'])): ?> 
                    <div class="qa-response">
                        <strong>Admin Response:</strong>
                        <span class="qa-date">Replied on: <?= date('F j, Y'); ?></span>
                        <p><?= nl2br(htmlspecialchars($row['response'])); ?></p>
                    </div>
                <?php else: ?>
                    <p class="pending-response">⏳ Awaiting admin response...</p>
                <?php endif; ?>
            </div>
        <?php 
            endwhile;
        else:
            echo "<p class='no-questions'>No questions have been submitted yet.</p>";
        endif;

        $conn->close();
        ?>
    </div>
</div>








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

</body>
</html>
