<?php 
// Connection
include '../backend/dbcon.php';

session_start(); // Start the session

// Check if $conn is set and not null
if(isset($conn) && !is_null($conn)) {
    // Display Booking logic
    $display_query = "SELECT bookingId, eventDate, eventTime, eventLocation, type_of_event, title_event, paymentAmount, description, clientID, status FROM booking";             
    $results = mysqli_query($conn, $display_query);   
    $count = mysqli_num_rows($results);  
    if ($count > 0) {
        $data_arr = array();
        $i = 1;
        while ($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
            $data_arr[$i]['bookingId'] = $data_row['bookingId'];
            $data_arr[$i]['title'] = $data_row['title_event'];
            $data_arr[$i]['start'] = date("Y-m-d", strtotime($data_row['eventDate']));
            $data_arr[$i]['end'] = date("Y-m-d", strtotime($data_row['eventDate']));
            $data_arr[$i]['color'] = '#' . substr(uniqid(), -6);
            $data_arr[$i]['url'] = 'https://www.shinerweb.com';
            $i++;
        }
        
        $events_data = array(
            'status' => true,
            'msg' => 'successfully!',
            'data' => $data_arr
        );
    } else {
        $events_data = array(
            'status' => false,
            'msg' => 'Error!'                
        );
    }
    $events_json = json_encode($events_data);
} else {
    echo "Database connection error!";
    exit(); 
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!---WEB TITLE--->
    <link rel="short icon" href="../picture/shortcut-logo.png" type="x-icon">
    <title>
        <?php echo "Admin | Calendar"; ?>
    </title>

    <!---CSS--->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">

    <!--ICON LINKS-->
    <link rel="stylesheet" href="../font-awesome-6/css/all.css">

    <!--FONT LINKS-->
    <link rel="stylesheet" href="../css/fonts.css">

    <!----css---->
    <style>
        body {
            overflow-y: hidden;
        }       
    </style>
    
</head>
    
<body>

       
    <!--  navbar and sidebar-->
    <?php 
        include '../admin/sidebar.php';
        include '../admin/navbar.php';
    ?> 

    <main class="calendar">
        <div class="calendar-header">
            <button id="addScheduleButton" class="add-schedule-button"><i class="fa-solid fa-plus"></i> Add Schedule</button>
            <div id="calendar" class="event_management"></div>
        </div>
    </main>


<!-- Popup -->
<div id="event_entry_modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="img-container">
            <div class="row">
                <div class="col-sm-12">  
                    <div class="form-group">
                        <label for="event_name">Event name</label>
                        <input type="text" name="event_name" id="event_name" class="form-control" placeholder="Enter your event name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">  
                    <div class="form-group">
                        <label for="event_start_date">Event start</label>
                        <input type="date" name="event_start_date" id="event_start_date" class="form-control onlydatepicker" placeholder="Event start date">
                    </div>
                </div>
                <div class="col-sm-6">  
                    <div class="form-group">
                        <label for="event_end_date">Event end</label>
                        <input type="date" name="event_end_date" id="event_end_date" class="form-control" placeholder="Event end date">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">  
                    <div class="form-group">
                        <label for="event_color">Event color</label>
                        <input type="color" name="event_color" id="event_color" class="form-control" value="#C2BE63">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">  
                    <button id="saveEventButton" class="btn-save-event">Save Event</button>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <script>
    $(document).ready(function() {
    var calendar; // Declare the calendar variable outside the function scope

    function initializeCalendar(eventsData) {
        if (eventsData.status) {
            var events = eventsData.data;
            calendar = $('#calendar').fullCalendar({
                defaultView: 'month',
                timeZone: 'local',
                editable: true,
                selectable: true,
                selectHelper: true,
                events: events,
                eventRender: function(event, element, view) {
                    element.bind('click', function() {
                        alert(event.event_id);
                    });
                },
                select: function(start, end) {
                    $('#event_start_date').val(moment(start).format('YYYY-MM-DD'));
                    // Automatically attach the start date to the input field
                    $('#event_start_date').val(moment(start).format('YYYY-MM-DD'));
                    $('#event_end_date').val(moment(end).format('YYYY-MM-DD'));
                    $('#event_entry_modal').show();
                }
            });
        } else {
            alert('No events to display!');
        }
    }

    var eventsData = <?php echo $events_json; ?>;
    initializeCalendar(eventsData);

    $("#addScheduleButton").click(function() {
        $("#event_entry_modal").show();
    });

    $(".close").click(function() {
        $("#event_entry_modal").hide();
    });

    $(window).click(function(event) {
        if (event.target.id === "event_entry_modal") {
            $("#event_entry_modal").hide();
        }
    });

    function save_event() {
        var event_name = $("#event_name").val();
        var event_start_date = $("#event_start_date").val();
        var event_end_date = $("#event_end_date").val();
        var event_color = $("#event_color").val();

        $.ajax({
            method: 'POST',
            url: 'calendar.php',
            data: {
                title: event_name,
                start_date: event_start_date,
                end_date: event_end_date,
                color: event_color
            },
            success: function(response) {
                $('#event_entry_modal').hide();
                if (response.status) {
                    // Fetch updated events from the server
                    $.ajax({
                        method: 'GET',
                        url: 'fetch_events.php', // Replace with your endpoint to fetch events
                        success: function(data) {
                            calendar.fullCalendar('removeEvents');
                            calendar.fullCalendar('addEventSource', data);
                            calendar.fullCalendar('rerenderEvents');
                        },
                        error: function(error) {
                            console.error("Error fetching events: ", error);
                        }
                    });
                } else {
                    console.error("Error: " + response.msg);
                }
            },
            error: function(error) {
                console.error("Error saving event: ", error);
            }
        });
    }

    $("#saveEventButton").click(function() {
        save_event();
    });
});
    </script>

    
</body>
</html>