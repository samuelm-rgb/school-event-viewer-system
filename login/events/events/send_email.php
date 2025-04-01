<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files using the correct path
require 'C:/xampp/htdocs/SCHOOL EVENT VIEWER AND MANAGEMENT SYSTEM/login/PHPMailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/SCHOOL EVENT VIEWER AND MANAGEMENT SYSTEM/login/PHPMailer/src/SMTP.php';
require 'C:/xampp/htdocs/SCHOOL EVENT VIEWER AND MANAGEMENT SYSTEM/login/PHPMailer/src/Exception.php';

// Database Connection
$conn = new mysqli("localhost", "root", "", "signin");

// Check Connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if (isset($_POST['send_email'])) {
    $subject = $_POST['email_subject'];
    $message = $_POST['email_message'];

    // Fetch All User Emails from the Database
    $sql = "SELECT email FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $mail = new PHPMailer(true);

        try {
            // SMTP Configuration
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'phsycosam158@gmail.com'; // Your Gmail
            $mail->Password   = 'shrz nqqe yqsg ivlu'; // App Password from Google
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Sender Info
            $mail->setFrom('your-email@gmail.com', 'Genesys Software');

            // Add Recipients from the Database
            while ($row = $result->fetch_assoc()) {
                $mail->addAddress($row['email']);
            }

            // Email Content
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->isHTML(true);

            // Send Email
            if ($mail->send()) {
                echo "Emails sent successfully!";
            } else {
                echo "Error sending emails: " . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            echo "Email sending failed: " . $e->getMessage();
        }
    } else {
        echo "No users found!";
    }
}

$conn->close();
?>
