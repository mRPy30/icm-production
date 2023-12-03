<?php
include '../backend/dbcon.php';

$booking_query = "SELECT bookingId, eventDate, eventTime, eventLocation, type_of_event, title_event, paymentAmount, description, clientID, status FROM booking";
$booking_results = mysqli_query($conn, $booking_query);
$booking_count = mysqli_num_rows($booking_results);

$schedule_query = "SELECT schedID AS event_id, schedName AS event_name, schedStart AS event_start_date, schedEnd AS event_end_date FROM schedule";
$schedule_results = mysqli_query($conn, $schedule_query);
$schedule_count = mysqli_num_rows($schedule_results);

if ($booking_count > 0 || $schedule_count  > 0) {
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

     // Fetch events from the schedule table
     while ($schedule_row = mysqli_fetch_array($schedule_results, MYSQLI_ASSOC)) {
        $data_arr[$i]['event_id'] = $schedule_row['event_id'];
        $data_arr[$i]['title'] = $schedule_row['event_name'];
        $data_arr[$i]['start'] = date("Y-m-d", strtotime($schedule_row['event_start_date']));
        $data_arr[$i]['end'] = date("Y-m-d", strtotime($schedule_row['event_end_date']));
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