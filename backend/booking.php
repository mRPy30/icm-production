<?php
// Connection
include '../backend/dbcon.php';

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

    // Start a session and store user information
    session_start();
    $_SESSION['id'] = $clientID;
    $_SESSION['name'] = $email;

    // Redirect to the client's booking page
    header("Location: ../client/booking.php");
    exit();
}
?>
