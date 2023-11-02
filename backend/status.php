<?php
include '../dbcon.php';

//Admin

// Handle booking status change (accept or decline)
if (isset($_POST['accept'])) {
    $scheduleId = $_POST['schedule_id'];
    // Perform a SQL UPDATE operation to change the status to 'Accepted'
    $updateSql = "UPDATE booking SET status = 'Accepted' WHERE scheduleId = $scheduleId";
    if ($conn->query($updateSql) === true) {
        // Booking has been accepted
        // You can set a success message or redirect to a specific page
        header("Location: your_redirect_page.php"); // Redirect to a specific page
        exit();
    } else {
        echo "Error accepting booking: " . $conn->error;
    }
} elseif (isset($_POST['decline'])) {
    $scheduleId = $_POST['schedule_id'];
    // Perform a SQL UPDATE operation to change the status to 'Declined'
    $updateSql = "UPDATE booking SET status = 'Declined' WHERE scheduleId = $scheduleId";
    if ($conn->query($updateSql) === true) {
        // Booking has been declined
        // You can set a success message or redirect to a specific page
        header("Location: your_redirect_page.php"); // Redirect to a specific page
        exit();
    } else {
        echo "Error declining booking: " . $conn->error;
    }
}
?>