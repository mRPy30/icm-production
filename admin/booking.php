<?php
// logout Automatically
include '../backend/logout.php';
// Connection
include '../backend/dbcon.php';

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
                <table class="data-table booking">
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
                                <button class="accept" onclick="openPopup('<?php echo $booking['bookingId']; ?>')">Accept</button>
                                <button class="decline" onclick="openDeclinePopup('<?php echo $booking['bookingId']; ?>')">Decline</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- Popup -->
        <div id="customPopup" class="popup">
            <div class="popup-content">
                <p>Do you want to accept this booking request?</p>
                <input type="hidden" id="bookingId">
                <button id="acceptNo" onclick="closeAcceptPopup()">No</button>
                <button id="acceptYes" onclick="acceptBooking()">Yes</button>
            </div>
        </div>

        <div id="declinePopup" class="popup">
    <span class="close" onclick="closeDeclinePopup()">&times;</span>
    <div class="form-decline">
        <label for="declineReason">Reason for declining booking request?</label>
        <input type="hidden" id="declineBookingId">
        <!-- Use a select dropdown for the reason -->
        <select id="declineReason" name="declineReason">
            <option value="" selected disabled>Select a reason</option>
            <option value="Transport/Travel Distance Issue">Transport/Travel Distance Issue</option>
            <option value="Fully booked schedule">Fully booked schedule</option>
            <option value="Personal Commitment">Personal Commitment</option>
            <option value="Equipment unavailability">Equipment unavailability</option>
            <option value="Weather Conditions">Weather Conditions</option>
        </select>
        <button class="btn-save-event" onclick="declineBooking()">Submit</button>
    </div>
</div>
    </div>
    </section>
</body>
<script>

function openPopup(bookingId) {
        document.getElementById('customPopup').style.display = 'block';
        document.getElementById('bookingId').value = bookingId;
    }

    function closeAcceptPopup() {
        document.getElementById('customPopup').style.display = 'none';
    }


    function acceptBooking() {
        var bookingId = document.getElementById('bookingId').value;

        // Perform the update to the status in the database using AJAX or form submission
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../backend/status.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Check the response from the server if needed
                console.log(xhr.responseText);
                // Close the popup
                closePopup();
                // Reload the page to update the displayed data
                window.location.reload();
            }
        };

        // Send the request with the bookingId and action (accept)
        xhr.send('schedule_id=' + bookingId + '&accept=1');
    }


    function openDeclinePopup(bookingId) {
    document.getElementById('declinePopup').style.display = 'block';
    document.getElementById('declineBookingId').value = bookingId;
}

function closeDeclinePopup() {
    document.getElementById('declinePopup').style.display = 'none';
}

function declineBooking() {
    var bookingId = document.getElementById('declineBookingId').value;
    var reasonSelect = document.getElementById('declineReason');
    var reason = reasonSelect.options[reasonSelect.selectedIndex].value;

    // Perform the update to the status and reason in the database using AJAX or form submission
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../backend/status.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Check the response from the server if needed
            console.log(xhr.responseText);
            // Close the popup
            closeDeclinePopup();
            // Reload the page to update the displayed data
            window.location.reload();
        }
    };

    // Send the request with the bookingId, action (decline), and reason
    xhr.send('schedule_id=' + bookingId + '&decline=1&reason=' + encodeURIComponent(reason));
}
    // Add the following script to periodically check for inactivity and logout
    var inactivityTimeout = 900; // 15 minutes in seconds

function checkInactivity() {
    setTimeout(function () {
        window.location.href = '../login.php'; // Replace 'logout.php' with the actual logout page
    }, inactivityTimeout * 1000);
}

// Start checking for inactivity when the page loads
document.addEventListener('DOMContentLoaded', function () {
    checkInactivity();
});

// Reset the inactivity timer when there's user activity
document.addEventListener('mousemove', function () {
    clearTimeout(checkInactivity);
    checkInactivity();
});

document.addEventListener('keypress', function () {
    clearTimeout(checkInactivity);
    checkInactivity();
});
</script>
</html>