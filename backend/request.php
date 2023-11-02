<?php
include '../dbcon.php';

//Client

session_start(); // Start the session
$clientID = $_SESSION['id'];

// Insert data into the 'booking' table with 'Pending' status
$insertQuery = "INSERT INTO booking (scheduleId, eventDate, eventTime, venue, type_of_event, title_event, paymentAmount, description, clientName, status) 
                VALUES ('$scheduleId', '$bookingDate', '$bookingTime', '$eventLocation', '$eventType', '$eventTitle', '$paymentAmount', '$eventDescription', '$firstName $lastName', 'Pending')";
                
// Query the database to retrieve the client's first name and last name
$nameQuery = "SELECT firstName, lastName FROM client WHERE id = $clientID";
$nameResult = mysqli_query($conn, $nameQuery);

if ($nameResult && mysqli_num_rows($nameResult) > 0) {
    $row = mysqli_fetch_assoc($nameResult);
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];

    // Update the $_SESSION variables with the user's first name and last name
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
} else {
    // Handle the case where the user's information is not found
    echo "User information not found.";
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Data from the form
    $bookingDate = $_POST['bookingDate'];
    $bookingTime = $_POST['bookingTime'];
    $eventType = $_POST['eventType'];
    $eventTitle = $_POST['eventTitle'];
    $eventLocation = $_POST['eventLocation'];
    $eventDescription = $_POST['eventDescription'];
    $paymentAmount = $_POST['paymentAmount'];

    // Client's first name and last name 
    $firstName = $_SESSION['firstName'];
    $lastName = $_SESSION['lastName'];

    // Generate a 3-digit scheduleId
    $scheduleId = mt_rand(100, 999);

    // Insert data into the 'booking' table
    $insertQuery = "INSERT INTO booking (scheduleId, eventDate, eventTime, venue, type_of_event, title_event, paymentAmount, description, clientName) 
                    VALUES ('$scheduleId', '$bookingDate', '$bookingTime', '$eventLocation', '$eventType', '$eventTitle', '$paymentAmount', '$eventDescription', '$firstName $lastName')";

    if (mysqli_query($conn, $insertQuery)) {
        // Insert successful
        $bookingMessage = "Booking data has been successfully inserted into the database.";

        // show an alert
        echo '<script>alert("Booking data has been successfully inserted.");</script>';
        echo '<script>window.location = "../client/booking.php";</script>';
        exit;
    } else {
        // Insert failed
        $bookingMessage = "Booking data has not been successfully inserted.";
        echo '<script>alert("Booking data has not been successfully inserted.");</script>';
    }
}
?>