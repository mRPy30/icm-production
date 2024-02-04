<?php
// Connection
include '../backend/dbcon.php';

session_start(); // Start the session
$clientID = $_SESSION['id'];


// Display data in a table
$sql = "SELECT title_event, eventLocation, eventDate, status FROM booking WHERE clientID = $clientID";

$result = mysqli_query($conn, $sql);

// Fetch data from the "event" table
$eventQuery = "SELECT eventName FROM event";
$eventResult = mysqli_query($conn, $eventQuery);

// Fetch data from the "package" table
$packageQuery = "SELECT packageName, packagePrice, packageDetails FROM package";
$packageResult = mysqli_query($conn, $packageQuery);

// Active Page
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = $components[2];

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!---WEB TITLE--->
        <link rel="short icon" href="../picture/shortcut-logo.png" type="x-icon">
        <link rel=stylesheet>
        <title>
            <?php echo "User | Booking Schedule"; ?>
        </title>

        <!---CSS--->
        <link rel="stylesheet" href="../css/client.css">

        <!--ICON LINKS-->
        <link rel="stylesheet" href="../font-awesome-6/css/all.css">


        <!--FONT LINKS-->
        <link rel="stylesheet" href="../css/fonts.css">

    </head>

    <body>

        <section class="booking-box">
            <div class="table-booking">
                <div class="table-top">
                    <h4>Booking Details</h4>
                    <div class="add-event">
                        <button class="add-button" id="addEvent">Set Schedule <i class="fa-solid fa-plus"></i></button>
                    </div>
                </div>
                <table class="data-table">
                    <thead class="header-table">
                        <tr style="font-family: Poppins">
                            <th>Title Event</th>
                            <th>Event Location</th>
                            <th>Select Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                  while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>' . $row['title_event'] . '</td>';
                      echo '<td>' . $row['eventLocation'] . '</td>';
                      echo '<td>' . $row['eventDate'] . '</td>';
                      echo '<td>' . $row['status'] . '</td>';
                      echo '</tr>';
                }
                ?>
                    </tbody>
                </table>
            </div>
        </section>
        
        <?php 
         include '../client/navbar.php';
         include '../client/sidebar.php';
    ?>
        <!-- Set schedule form (hidden by default) -->
        <div id="setForm" class="form-popup" style="display: none;">
        <span class="close-button" onclick="closeForm()" style="font-size: 20px; font-weight: 600;">&#10006;</span>
            <div class="top-book">
                <div class="title-book">
                    <h3>Start an Event with us!</h3>
                </div>
                <div class="steps">
                    <div class="circle active">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div class="progress-line"></div>
                    <div class="circle">
                        <i class="fa-solid fa-check"></i>
                    </div>
                </div>
            </div>
            <!-- Step 1 -->
            <div class="forms">
            <form id="bookingForm" action="../backend/request.php" method="POST" class="form-fillup needs-validation" enctype="multipart/form-data">         
                    <div id="step1" class="form-step">
                        <div class="form-group">
                            <div class="left-info">
                                <label for="bookingDate">Date</label>
                                <input type="date" name="bookingDate" id="formattedDateDisplay" class="form-input" onchange="formatDate()" required>
                                <label for="bookingTime">Time</label>
                                <input type="time" name="bookingTime" class="form-input" required>
                                <label for="eventType">Type of Event</label>
                                    <select name="eventType" id="eventType" required >
                                        <?php
                                        while ($event = mysqli_fetch_assoc($eventResult)) {
                                            echo "<option value='" . $event['eventName'] . "'>" . $event['eventName'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                <label for="eventTitle">Name of Event</label>
                                <input type="text" id="eventTitle" name="eventTitle" required>
                            </div>
                                    
                            <div class="right-info">
                                <label for="eventLocation">Event Location</label>
                                <input type="text" id="eventLocation" name="eventLocation" required>
                                <label for="eventDescription">Booking Description</label>
                                <input type="text" id="eventDescription" name="eventDescription" required>
                                <label for="package">Select Package</label>
                                    <select name="package" id="package" required>
                                        <?php
                                        while ($package = mysqli_fetch_assoc($packageResult)) {
                                            echo "<option value='" . $package['packageName'] . "'>" . $package['packageCategory'] . " " 
                                            . $package['packageName'] 
                                            . " (₱" . number_format($package['packagePrice'] ). ")</option>";
                                        }
                                        ?>
                                    </select>
                            </div>
                        </div>
                    </div>
            </div>

            <!-- Step 2 (Receipt) -->
                    <div id="step2" class="form-step" style="display: none;">
                        <div class="receipt">
                             <h2>Receipt</h2>
                        <div id="receiptDetails"></div>
                        </div>               
                    </div>
                    <div class="buttons-book">
                        <button id="prev">Prev</button>
                        <button id="next">Next</button>
                    </div>
        </div>
    </div>
    <div id="popup-payment" class="popup-payment" style="display: none;">
            <div class="popup-content">
                <span class="close" onclick="hidePopup()">&times;</span>
                <div class="form-container">
                        <input type="hidden" name="bookingId" value="123"> <!-- Add the actual booking ID here -->
                        <div class="form-group">
                            <label for="paymentOption">Select Payment Option:</label>
                            <select name="paymentOption" id="paymentOption" class="form-control" required>
                                <option value="downpayment">Downpayment</option>
                                <option value="fullpayment">Full Payment</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pay Via: </label>
                            <div class="payment-options">
                                <label class="payment-icon">
                                    <span class="payment-label">GCash</span>
                                    <img src="../picture/gcash.png" alt="GCash Logo" class="payment-logo">
                                    <input type="radio" name="paymentOption" value="gcash" required>
                                </label>
                                <label class="payment-icon">
                                    <span class="payment-label">Mastercard</span>
                                    <img src="../picture/mc.png" alt="Mastercard Logo" class="payment-logo">
                                    <input type="radio" name="paymentOption" value="mastercard" required>
                                </label>
                                <label class="payment-icon">
                                    <span class="payment-label">BDO</span>
                                    <img src="../picture/bdo.png" alt="BDO Logo" class="payment-logo">
                                    <input type="radio" name="paymentOption" value="bdo" required>
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn-booking ">Pay now</button>
                    </form>
                </div>
            </div>
        </div>
    </body>

    <script>
    var currentStep = 1;
var totalSteps = 2; // Update this if you add more steps

var circles = document.querySelectorAll('.circle');
var prevButton = document.getElementById('prev');
var nextButton = document.getElementById('next');

prevButton.addEventListener('click', function () {
    if (currentStep > 1) {
        currentStep--;
        updateStepDisplay();
    }
});

nextButton.addEventListener('click', function () {
        if (currentStep < totalSteps) {
            if (currentStep === totalSteps - 1) {
                // If it's the last step (Step 2), change the button text to "Pay Booking"
                nextButton.textContent = 'Pay Booking';
            }
            currentStep++;
            updateStepDisplay();
        } else if (currentStep === totalSteps && nextButton.textContent === 'Pay Booking') {
            // If the current step is already the last step and the button text is "Pay Booking"
            // Handle the "Next" button click after changing the text
            showPaymentPopup();
        }
    });

    // Handle the "Payment Booking" button click
    document.getElementById('next').addEventListener('click', function () {
        if (currentStep === totalSteps && nextButton.textContent === 'Pay Booking') {
            // If the current step is the last step and the button text is "Pay Booking"
            showPaymentPopup();
        }
    });

    function showPaymentPopup() {
        // Display the payment popup
        document.getElementById('popup-payment').style.display = 'block';
    }

    function hidePopup() {
        // Hide the payment popup
        document.getElementById('popup-payment').style.display = 'none';
    }


function updateStepDisplay() {
    // Update the step display
    var formSteps = document.querySelectorAll('.form-step');
    formSteps.forEach(function (stepElement) {
        stepElement.style.display = 'none';
    });

    // Show the current step
    var currentStepElement = document.getElementById('step' + currentStep);
    if (currentStepElement) {
        currentStepElement.style.display = 'block';
    }

    // Update the progress line and circles
    circles.forEach(function (circle, index) {
        if (index < currentStep) {
            circle.classList.add('active');
        } else {
            circle.classList.remove('active');
        }
    });

    // Update the progress line position
    var progressLine = document.querySelector('.progress-line');
    if (progressLine) {
        var stepWidth = (12 / (totalSteps - 1)) * (currentStep - 1);
        progressLine.style.width = stepWidth + '%';
    }

    // Update the "Next" button text to "Pay" in step 3
    if (currentStep === totalSteps) {
        nextButton.innerText = 'Pay Booking';
    } else {
        nextButton.innerText = 'Next';
    }
}


document.getElementById('addEvent').addEventListener('click', function() {
    document.getElementById('setForm').style.display = 'block';
});

function closeForm() {
    document.getElementById('setForm').style.display = 'none';
}


    document.querySelector('.btn-booking').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Create a new FormData object
    var formData = new FormData(document.getElementById('bookingForm'));

    // Send an AJAX request to the server
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../backend/request.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Redirect to a success page or handle the response
            window.location.href = '../client/booking.php';
        } else {
            // Handle errors
            console.error('Form submission failed. Status:', xhr.status);
        }
    };

    // Set the appropriate headers for form data
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Convert FormData to URL-encoded format
    var urlEncodedData = '';
    for (var pair of formData.entries()) {
        if (urlEncodedData.length > 0) {
            urlEncodedData += '&';
        }
        urlEncodedData += encodeURIComponent(pair[0]) + '=' + encodeURIComponent(pair[1]);
    }

    // Send the URL-encoded data
    xhr.send(urlEncodedData);
});
    
// Update the displayReceipt function
function displayReceipt(data) {
    var receiptDiv = document.getElementById('receiptDetails');
    receiptDiv.innerHTML = '';

    var receiptData = {
        'Booking Date': data.bookingDate,
        'Booking Time': data.bookingTime,
        'Package': data.package,
        'Event Type': data.eventType,
        'Event Title': data.eventTitle,
        'Event Location': data.eventLocation,
    };

    for (var key in receiptData) {
        receiptDiv.innerHTML += '<p><strong>' + key + ':</strong> ' + receiptData[key] + '</p>';
    }
}

// In the "Next" button event listener
document.getElementById('next').addEventListener('click', function () {
    // Capture data from Step 1 form
    var bookingDate = document.getElementById('formattedDateDisplay').value;
    var bookingTime = document.getElementsByName('bookingTime')[0].value;
    var eventType = document.getElementById('eventType').value;
    var eventTitle = document.getElementById('eventTitle').value;
    var eventLocation = document.getElementById('eventLocation').value;
    var eventDescription = document.getElementById('eventDescription').value;
    var package = document.getElementById('package').value;

    // Create an object with the captured data
    var formData = {
        bookingDate: bookingDate,
        bookingTime: bookingTime,
        eventType: eventType,
        eventTitle: eventTitle,
        eventLocation: eventLocation,
        eventDescription: eventDescription,
        package: package
    };

    // Update the receipt details
    displayReceipt(formData);

});



    </script>

</html>