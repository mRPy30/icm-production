<?php
include '../backend/dbcon.php';

$booking_query = "SELECT bookingId, eventDate, eventTime, eventLocation, type_of_event, title_event, paymentAmount, description, clientID, status FROM booking";
$booking_results = mysqli_query($conn, $booking_query);
$booking_count = mysqli_num_rows($booking_results);

$calendar_query = "SELECT event_id, event_name, event_start_date, event_end_date FROM calendar_event_master";
$calendar_results = mysqli_query($conn, $calendar_query);
$calendar_count = mysqli_num_rows($calendar_results);

if ($booking_count > 0 || $calendar_count > 0) {
    $data_arr = array();
    $i = 1;

    // Fetch events from the booking table
    while ($booking_row = mysqli_fetch_array($booking_results, MYSQLI_ASSOC)) {
        $data_arr[$i]['event_id'] = $booking_row['bookingId'];
        $data_arr[$i]['title'] = $booking_row['title_event'];
        $data_arr[$i]['start'] = date("Y-m-d", strtotime($booking_row['eventDate']));
        $data_arr[$i]['end'] = date("Y-m-d", strtotime($booking_row['eventDate']));
        $data_arr[$i]['color'] = '#' . substr(uniqid(), -6); // Assign a random color for events
        $i++;
    }

    // Fetch events from the calendar_event_master table
    while ($calendar_row = mysqli_fetch_array($calendar_results, MYSQLI_ASSOC)) {
        $data_arr[$i]['event_id'] = $calendar_row['event_id'];
        $data_arr[$i]['title'] = $calendar_row['event_name'];
        $data_arr[$i]['start'] = date("Y-m-d", strtotime($calendar_row['event_start_date']));
        $data_arr[$i]['end'] = date("Y-m-d", strtotime($calendar_row['event_end_date']));
        $data_arr[$i]['color'] = '#' . substr(uniqid(), -6); // Assign a random color for events
        $i++;
    }

    $data = array(
        'status' => true,
        'msg' => 'successfully!',
        'data' => $data_arr
    );
} else {
    $data = array(
        'status' => false,
        'msg' => 'No events found in the tables!'
    );
}
echo json_encode($data);
?>