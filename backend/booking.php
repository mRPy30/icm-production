<?php
// Connection
include '../backend/dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $bookingDate = $_POST['bookingDate'];
    $bookingTime = $_POST['bookingTime'];
    $eventType = $_POST['eventType'];
    $eventTitle = $_POST['eventTitle'];
    $eventLocation = $_POST['eventLocation'];
    $eventDescription = $_POST['eventDescription'];
    $package = $_POST['package'];
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Check if the passwords match
    if ($password !== $confirmPassword) {
        // Handle password mismatch error (you can customize this part based on your needs)
        echo '<script>alert("Password and Confirm Password do not match.");</script>';
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the "client" table
    $clientInsertQuery = "INSERT INTO client (firstName, lastName, email, password) VALUES (?, ?, ?, ?)";
    $clientStmt = mysqli_prepare($conn, $clientInsertQuery);
    mysqli_stmt_bind_param($clientStmt, "ssss", $firstName, $lastName, $email, $hashedPassword);
    mysqli_stmt_execute($clientStmt);

    // Get the ID of the last inserted client
    $clientID = mysqli_insert_id($conn);

    // Insert data into the "booking" table
    $bookingInsertQuery = "INSERT INTO booking (eventDate, eventTime, eventLocation, type_of_event, title_event, description, clientID) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $bookingStmt = mysqli_prepare($conn, $bookingInsertQuery);
    mysqli_stmt_bind_param($bookingStmt, "ssssssi", $bookingDate, $bookingTime, $eventLocation, $eventType, $eventTitle, $eventDescription, $clientID);
    mysqli_stmt_execute($bookingStmt);

    // Check for errors and handle them if needed

    // Additional code if needed after the data is inserted

    // Redirect to a success page or perform additional actions
    header("Location: ../homepage/booking.php");
    exit();
}
?>
