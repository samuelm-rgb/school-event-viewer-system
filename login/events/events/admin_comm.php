<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Form with Sidebar</title>
    <link rel="stylesheet" href="email.css">
</head>
<body>
<div class="menu">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="admin.php">Manage Users</a></li>
            <li><a href="admin_announcements.php">Announcements</a></li>
            <li><a href="admin_eventcategories.php">Events categories</a></li>
            <li><a href="admin_events.php"> events</a></li>            
            <li><a href="admi_mess.php">Enquieries</a></li>
            <li><a href="admin_upload2.php">imagesS</a></li>
            <li><a href="admin_comm.php">communications</a></li>
            <li><a href="admin_login.php">LOG_OUT</a></li>
        </ul>
    </div>
    
    <div class="content">
        <h2>Send Email</h2>
        <div class="form-container">
            <form action="send_email.php" method="POST">
                <label for="email_subject">Subject:</label>
                <input type="text" id="email_subject" name="email_subject" required>
                
                <label for="email_message">Message:</label>
                <textarea id="email_message" name="email_message" rows="5" required></textarea>
                
                <button type="submit" name="send_email">Send Email</button>
            </form>
        </div>
    </div>
</body>
</html>
