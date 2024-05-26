<?php
// Connection
include '../backend/dbcon.php';

// Include PHPMailer autoloader
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookingDate = mysqli_real_escape_string($conn, $_POST['bookingDate']);
    $bookingTime = mysqli_real_escape_string($conn, $_POST['bookingTime']);
    $eventType = mysqli_real_escape_string($conn, $_POST['eventType']);
    $eventTitle = mysqli_real_escape_string($conn, $_POST['eventTitle']);
    $eventLocation = mysqli_real_escape_string($conn, $_POST['eventLocation']);
    $eventDescription = mysqli_real_escape_string($conn, $_POST['eventDescription']);
    $package = mysqli_real_escape_string($conn, $_POST['package']);
    $firstName = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirm-password']);

    // Check if the passwords match
    if ($password !== $confirmPassword) {
        // Handle password mismatch error (you can customize this part based on your needs)
        echo '<script>alert("Password and Confirm Password do not match.");</script>';
        exit();
    }

    $checkEmailQuery = "SELECT * FROM client WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        // Email already exists
        echo '<script>alert("Registration failed. Email already exists. Please try again.");</script>';
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $clientID = sprintf("%05d", mt_rand(1, 99999));

    $clientInsertQuery = "INSERT INTO client (id, firstName, lastName, email, password, confirmPass) VALUES (?, ?, ?, ?, ?, ?)";
    $clientStmt = mysqli_prepare($conn, $clientInsertQuery);
    mysqli_stmt_bind_param($clientStmt, "ssssss", $clientID, $firstName, $lastName, $email, $hashedPassword, $hashedPassword);
    mysqli_stmt_execute($clientStmt);

    // Insert data into the "booking" table with 'Pending' status
    $status = 'Pending';
    $bookingInsertQuery = "INSERT INTO booking (eventDate, eventTime, eventLocation, type_of_event, title_event, description, clientID, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $bookingStmt = mysqli_prepare($conn, $bookingInsertQuery);
    mysqli_stmt_bind_param($bookingStmt, "ssssssis", $bookingDate, $bookingTime, $eventLocation, $eventType, $eventTitle, $eventDescription, $clientID, $status);
    mysqli_stmt_execute($bookingStmt);

    // Notify the admin via email
    $adminEmail = 'icsmcreatives@gmail.com'; // Admin email address
    $subject = 'New Booking Request';
    $body = "A new booking request has been submitted.\n\n";
    $body .= "Booking Date: $bookingDate\n";
    $body .= "Booking Time: $bookingTime\n";
    $body .= "Event Type: $eventType\n";
    $body .= "Event Title: $eventTitle\n";
    $body .= "Event Location: $eventLocation\n";
    $body .= "Event Description: $eventDescription\n";
    // You might need to add the package information here as well
    $body .= "Client ID: $clientID\n";
    $body .= "Status: Pending\n";

    sendEmail($adminEmail, $subject, $body);

    // Start a session and store user information
    session_start();
    $_SESSION['id'] = $clientID;
    $_SESSION['name'] = $email;

    // Redirect to the client's booking page
    header("Location: ../client/booking.php");
    exit();
}

// Function to send email
function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true); // Set to true for exceptions

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
        $mail->isSMTP(); // Send using SMTP
        $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = 'icsmcreatives@gmail.com'; // SMTP username
        $mail->Password   = 'nbtf sqfa zpkf ucng'; // SMTP password
        $mail->SMTPSecure = 'ssl'; // Enable implicit TLS encryption
        $mail->Port       = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // Recipients
        $mail->setFrom('araquejanvier@gmail.com');
        $mail->addAddress($to);

        // Content
        $mail->isHTML(false); // Set to false for plain text email
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>
