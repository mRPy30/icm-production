<?php
// Connection
include '../backend/dbcon.php';
session_start();

// Active Page
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = $components[2];

// Fetch all booking details from the database, joining with the client table using the clientID foreign key
$sql = "SELECT b.bookingId, b.eventDate, b.eventTime, b.eventLocation, b.type_of_event, b.title_event, b.paymentAmount, b.description, CONCAT(c.firstName, ' ', c.lastName) AS clientName, b.status FROM booking AS b
        LEFT JOIN client AS c ON b.clientID = c.id";
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
    <link rel="short icon" href="../picture/shortcut-logo.png" type="x-icon">
    <title>
        <?php echo "Admin | Booking"; ?>
    </title>

    <!---CSS--->
    <link rel="stylesheet" href="../css/admin.css">

    <!--ICON LINKS-->
    <link rel="stylesheet" href="../font-awesome-6/css/all.css">

    <!--FONT LINKS-->
    <link rel="stylesheet" href="../css/fonts.css">

    <style>
        body {
            overflow-y: hidden;
        }       
    </style>
</head>
    
<body>

    <!----Navbar&Sidebar----->
    <?php 
        include '../admin/sidebar.php';
        include '../admin/navbar.php';
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
                    <?php foreach ($bookingData as $booking): ?>
                <tr>
                    <td><?php echo $booking['clientName']; ?></td>
                    <td><?php echo $booking['title_event']; ?></td>
                    <td><?php echo $booking['eventLocation']; ?></td>
                    <td><?php echo date('F d Y', strtotime($booking['eventDate'])); ?></td>
                    <td><?php echo $booking['type_of_event']; ?></td>
                    <td>
                        <?php if ($booking['status'] == 'Accepted' || $booking['status'] == 'Declined'): ?>
                            <?php echo $booking['status']; ?>
                        <?php elseif ($booking['status'] == 'Pending'): ?>
                            <form method="POST" action="../backend/status.php">
                                <input type="hidden" name="schedule_id" value="<?php echo $booking['bookingId']; ?>">
                                <button type="submit" name="accept">Accept</button>
                                <button type="submit" name="decline">Decline</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>