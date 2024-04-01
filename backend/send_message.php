<?php
include '../backend/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a session for the admin user
    $adminID = $_SESSION['admin_id'];

    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $insertQuery = "INSERT INTO message (clientID, adminID, message) VALUES (NULL, '$adminID', '$message')";
    $insertResult = mysqli_query($conn, $insertQuery);

    if ($insertResult) {
        echo json_encode(['status' => 'success', 'message' => 'Message sent successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to send message']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
