<?php
include '../backend/dbcon.php';

//Client

session_start(); // Start the session
                
    // Step 1: Collect data from the form
    $bookingDate = $_POST['bookingDate'];
    $bookingTime = $_POST['bookingTime'];
    $eventType = $_POST['eventType'];
    $eventTitle = $_POST['eventTitle'];
    $eventLocation = $_POST['eventLocation'];
    $eventDescription = $_POST['eventDescription'];
    $paymentAmount = $_POST['paymentAmount'];
    $clientID = $_SESSION['id'];
    $status = 'Pending';
    
    $insertQuery = "INSERT INTO booking (eventDate, eventTime, eventLocation, type_of_event, title_event, paymentAmount, description, clientID, status) 
VALUES ('$bookingDate', '$bookingTime', '$eventLocation', '$eventType', '$eventTitle', '$paymentAmount', '$eventDescription', '$clientID', 'Pending')";

    // Execute the SQL query
    if (mysqli_query($conn, $insertQuery)) {
        // Booking request successful
        $_SESSION['booking_success'] = true;

        // Show a JavaScript alert after a successful booking request
        echo '<script>alert("Booking request has been successfully submitted. Please wait for your pending request.");</script>';
        echo '<script>window.location.href = "../client/booking.php";</script>';
    } else {
        // Booking request failed
        $_SESSION['booking_success'] = false;
        $_SESSION['booking_error_message'] = "An error occurred while inserting booking data.";
        echo '<script>window.location.href = "../client/booking.php";</script>';
}
?>