




<?php
include('dbcat_connect.php'); // Database connection

// Fetch event categories
$query = "SELECT * FROM event_categories ORDER BY created_at DESC";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="index.css">
    <script src="index.js" defer></script> <!-- JS files should be included using <script> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
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

<!-- Hero Section -->
<section class="hero">
    <video autoplay muted loop class="hero-video">
        <source src="vid1.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="hero-overlay">
        <h1>Welcome to Our School Event Viewer System</h1>
        <p>Stay updated with the latest school events and announcements</p>
        <a href="events.php" class="btn">View Upcoming Events</a>
    </div>
</section>

<!-- Announcements Table Section -->
<section class="announcements-table">
    <h2>📢 Latest Announcements</h2>
    <div id="announcements-container"></div>
</section>

<script>
    // Fetch announcements and display them
    function loadAnnouncements() {
        fetch("fetch_announcements.php")
            .then(response => response.text())
            .then(data => {
                document.getElementById("announcements-container").innerHTML = data;
            })
            .catch(error => console.log("Error fetching announcements:", error));
    }
    window.onload = loadAnnouncements;
</script>

<!-- Event Categories Section -->
<section class="event-categories">
    <h2>🎭 Event Categories</h2>
    <div class="swiper-container category-slider">
        <div class="swiper-wrapper">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="swiper-slide category">
                    <img src="uploads/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                    <h3><?= htmlspecialchars($row['title']) ?></h3>
                    <p><?= htmlspecialchars($row['description']) ?></p>
                </div>
            <?php endwhile; ?>
        </div>
        <!-- Swiper Navigation -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
   var swiper = new Swiper('.category-slider', {
    slidesPerView: 3, // Default
    spaceBetween: 20,
    loop: true,
    autoplay: {
        delay: 3000,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    breakpoints: {
        1024: { slidesPerView: 3 }, // Desktop
        768: { slidesPerView: 2 },  // Tablet
        480: { slidesPerView: 1 }   // Mobile
    }
});

</script>

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
