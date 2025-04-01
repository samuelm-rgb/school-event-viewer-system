<?php
include('dbe_connect.php'); // Connect to the database

// Handle connection failure
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch events from the database, ordered by oldest first
$query = "SELECT * FROM events ORDER BY created_at ASC";
$result = mysqli_query($connection, $query);

// Check if there are events
$hasEvents = mysqli_num_rows($result) > 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Events</title>
    <link rel="stylesheet" href="events.css"> <!-- External CSS -->
    <link rel="stylesheet" href="calendar.js">
    <link rel="stylesheet" href="calendar.css">
    <script src="calendar.js" defer></script>

</head>
<body>

<header class="navbar">
    <div class="logo">
        <a href="#">EduEvents</a>
    </div>

    <nav class="nav-links">
       
        <a href="guest_events.php">Events</a>
               
       
    </nav>

    <div class="search-bar">
       
       <a href="index.php">LOG_OUT</a>
    </div>   
</header>

<div class="events-container">
    <h2>Upcoming Events</h2>

    <?php if ($hasEvents): ?>
        <div class="event-slider">
            <button id="prevBtn">&#10094;</button> <!-- Left arrow -->
            
            <div class="events-wrapper">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="event-card">
                        <h3><?= htmlspecialchars($row['title']) ?></h3>

                        <!-- Improved Image Handling -->
                        <img src="<?= !empty($row['image']) ? 'uploads/' . htmlspecialchars($row['image']) : 'default.jpg' ?>" 
                             alt="<?= htmlspecialchars($row['title']) ?>">

                        <p class="category"><?= htmlspecialchars($row['category']) ?></p>

                        <!-- Updated More Details Button -->
                        <button class="more-details" data-id="<?= $row['id'] ?>">More Details</button>

                        <div class="event-details" id="details-<?= $row['id'] ?>" style="display: none;">
                            <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <button id="nextBtn">&#10095;</button> <!-- Right arrow -->
        </div>
    <?php else: ?>
        <p>No upcoming events at the moment.</p>
    <?php endif; ?>

</div>







<div class="calendar-container">
        <button class="prev-month" onclick="changeMonth(-1)">&#10094;</button>
        <div id="calendar"></div>
        <button class="next-month" onclick="changeMonth(1)">&#10095;</button>
    </div>
    
    <script src="calendar.js"></script>

    <script src="events.js"></script> <!-- JavaScript file -->

<section class="event-dates-scroll">
    <h2>📅 Event Dates</h2>
    <div id="event-dates-container">
        <p>Loading event dates...</p>
    </div>
</section>



































<div class="event-map">
    <h3>Event Location</h3>
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d317714.379092251!2d36.6827046!3d-1.2863895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f10d4c7484a6f%3A0x1dbe7c2c6f56a8cf!2sNairobi%2C%20Kenya!5e0!3m2!1sen!2ske!4v1614081985893!5m2!1sen!2ske" 
        width="350" 
        height="350" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy">
    </iframe>
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
