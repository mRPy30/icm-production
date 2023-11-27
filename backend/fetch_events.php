<?php 
// Connection
include '../backend/dbcon.php';

session_start(); // Start the session

// Construct an array to hold event data
$events = array();

while ($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
    $event = array(
        'id' => $data_row['bookingId'],
        'title' => $data_row['title_event'],
        'start' => date("Y-m-d", strtotime($data_row['eventDate'])),
        'end' => date("Y-m-d", strtotime($data_row['eventDate'])),
        'color' => '#' . substr(uniqid(), -6),
        'url' => 'https://www.shinerweb.com'
    );
    $events[] = $event;
}

// Encode the events array into JSON format
echo json_encode($events);
?>