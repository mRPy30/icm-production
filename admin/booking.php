<?php
// Connection
include '../dbcon.php';
include '../backend/status.php';
session_start();

// Active Page
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = $components[2];

// Fetch booking details from the database
$sql = "SELECT scheduleId, eventDate, eventTime, venue, type_of_event, title_event, paymentAmount, description, clientName, status FROM booking";
$result = $conn->query($sql);

// Check if there's a result
if ($result->num_rows > 0) {
    $bookingData = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $bookingData = [];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!---WEB TITLE--->
    <link rel="short icon" href="../picture/shortcut-logo.jpg" type="x-icon">
    <title>
        <?php echo "Admin | Booking"; ?>
    </title>

    <!---CSS--->
    <link rel="stylesheet" href="../css/admin.css">

    <!--ICON LINKS-->
    <link rel="stylesheet" href="../font-awesome-6/css/all.css">

    <!--FONT LINKS-->
    <link rel="stylesheet" href="../css/fonts.css">

</head>
    
<body>
    <div class="background">
        <img src="../picture/logo.png">
        <i class="fa-regular fa-bell"></i>
    </div> 

    <?php 
        include '../admin/sidebar.php';
    ?>
    
    <section class="booking-box">
        <div class="table-booking">
            <h4>Booking Details</h4>
            <table class="header-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Title Event</th>
                    <th>Event Address</th>
                    <th>Date</th>
                    <th>Packages</th>
                    <th>Status</th>
                </tr>
            </thead>
        </table>

        <!-- Data Table -->
        <div class="data-table-container">
            <table class="data-table">
                <tbody>
                    <?php
                    foreach ($bookingData as $booking) {
                        echo '<tr>';
                        echo '<td>' . $booking['clientName'] . '</td>';
                        echo '<td>' . $booking['title_event'] . '</td>';
                        echo '<td>' . $booking['venue'] . '</td>';
                        echo '<td>' . $booking['eventDate'] . '</td>';
                        echo '<td>' . $booking['type_of_event'] . '</td>';
                        echo '<td>'; if ($booking['status'] == 'Pending') {
                            echo '<form method="POST" action="../backend/status.php">';
                            echo '<input type="hidden" name="schedule_id" value="' . $booking['scheduleId'] . '">';
                            echo '<button type="submit" name="accept">Accept</button>';
                            echo '<button type="submit" name="decline">Decline</button>';
                            echo '</form>';
                        }
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>