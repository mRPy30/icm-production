<?php
include '../backend/dbcon.php';

// Admin

if (isset($_POST['accept'])) {
    $scheduleId = $_POST['schedule_id'];

    // Perform a SQL UPDATE operation to change the status to 'Accepted'
    $updateSql = "UPDATE booking SET status = 'Accepted' WHERE bookingId = $scheduleId";

    if ($conn->query($updateSql) === true) {
        // Booking has been accepted
        // Redirect to the admin booking page
        header("Location: ../admin/booking.php");
        exit();
    } else {
        // Handle the case where the update fails
        echo "Error accepting booking: " . $conn->error;
    }
}

// Check if the "Decline" button is clicked (similar process as "Accept")
elseif (isset($_POST['decline'])) {
    $scheduleId = $_POST['schedule_id'];
    $reason = isset($_POST['reason']) ? $_POST['reason'] : '';

    // Perform a SQL UPDATE operation to change the status to 'Declined' and save the reason
    $updateSql = "UPDATE booking SET status = 'Declined', reason = '$reason' WHERE bookingId = $scheduleId";

    if ($conn->query($updateSql) === true) {
        header("Location: ../admin/booking.php");
        exit();
    } else {
        echo "Error declining booking: " . $conn->error;
    }
}
?>
