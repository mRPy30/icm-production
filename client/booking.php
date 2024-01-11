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
    <div class="navbar">
        <h3>Booking Event</h3>
        <i class="fa-regular fa-bell"></i>
    </div> 
    
    <section class="booking-box">
        <div class="table-booking">
          <div class="table-top">
            <h4>Booking Details</h4>
                <div class="add-event">
                    <button class="add-button" id="addEvent">Set Schedule <i class="fa-solid fa-plus"></i></button>
                </div>
          </div>
            <table>
                <thead>
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
        include '../client/sidebar.php';
    ?>
        <!-- Set schedule form (hidden by default) -->
    <div id="setForm" class="form-popup">
    <span class="close-button" onclick="closeForm()" style="font-size: 20px; font-weight: 600;">&#10006;</span>
        <form action="../backend/request.php" method="POST" class="" enctype="multipart/form-data">
            <header class="header" style="font-size: 30px;font-weight:bold; text-align: center; font-family: Poppins; padding: 20px">Book Schedule</header>
            <div class="steps">
              <div class="circle active">
                <i class="fa-solid fa-check"></i>
              </div>
              <div class="progress-line"></div>
              <div class="circle">
                <i class="fa-solid fa-check"></i>
              </div>
              <div class="progress-line"></div>
              <div class="circle">
                <i class="fa-solid fa-check"></i>
              </div>
              <div class="progress-line"></div>
              <div class="circle">
                <i class="fa-solid fa-check"></i>
              </div>
              <div class="progress-line"></div>
              <div class="circle">
                <i class="fas fa-check"></i>
              </div>
              <div class="progress-line"></div>
              <div class="circle">
                <i class="fas fa-check"></i>
              </div>
              <div class="progress-line"></div>
              <div class="circle">
                <i class="fas fa-check"></i>
              </div>
            </div>

            <!-- Step 1 -->
            <p style="font-size: 15px; font-family: Poppins; padding: 20px; padding-left: 20px;">Set Date and Time Schedule</p>
            <div id="step1" class="form-step">
                
                <form style="background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                  <div class="form-group" style="padding: 10px;">
                    <p>Date</p>
                <label for="bookingDate" ></label>
                <input type="date" name="bookingDate" id="bookingDate" class="form-input"  required>
              
              <p>Time</p>
                <label for="bookingTime"></label>
                <input type="time" name="bookingTime" class="form-input" required>
              </div>
            </div>

            <!-- Step 2 -->
            <div id="step2" class="form-step" >
                <p style="font-size: 25px; padding:20px; text-align:left;">Set Event Title and Type</p>
                <label for="eventType">Type of Event</label>
                <select name="eventType" id="eventType" required >
                    <?php
                    while ($event = mysqli_fetch_assoc($eventResult)) {
                        echo "<option value='" . $event['eventName'] . "'>" . $event['eventName'] . "</option>";
                    }
                    ?>
                </select>
                  
                <label for="eventTitle">Title Event</label>
                <input type="text" id="eventTitle" name="eventTitle" required>
            </div>

            <!-- Step 3 -->
            <div id="step3" class="form-step" style="display: none">
                <p>Where is your event?</p>
                <label for="eventLocation">Address of Event</label>
                <input type="text" id="eventLocation" name="eventLocation" required>
            </div>

            <!-- Step 4 -->
            <div id="step4" class="form-step" style="display: none">
                <p>Choose your Packages</p>
                <?php
                while ($package = mysqli_fetch_assoc($packageResult)) {
                    echo "<div class='package-box' onclick='selectPackage(\"" . $package['packageName'] . "\", this)'>";
                    echo "<h4>" . $package['packageName'] . "</h4>";
                    echo "<p>Price: $" . $package['packagePrice'] . "</p>";
                    echo "<p>" . $package['packageDetails'] . "</p>";
                    echo "</div>";
                }
                ?>
            </div>

            <!-- Step 5 -->
            <div id="step5" class="form-step" style="display: none">
                <p>Booking Description</p>
                <input type="text" id="eventDescription" name="eventDescription" required>
            </div>

            <!-- Step 6 -->
            <div id="step6" class="form-step" style="display: none">
                <p>Receipt</p>
                <p>Date: <span id="receiptDate"></span></p>
                <p>Time: <span id="receiptTime"></span></p>
                <p>Type of Event: <span id="receiptEventType"></span></p>
                <p>Title Event: <span id="receiptEventTitle"></span></p>
                <p>Address of Event: <span id="receiptEventLocation"></span></p>
                <p>Description: <span id="receiptEventDescription"></span></p>
                <p>Selected Package: <span id="selectedPackage"></span></p>
            </div>
            
            <!--Step 7 -->
            <div id="step7" class="form-step" style="display: none">
                <p>Payment</p>
                <label for="paymentAmount">Payment Amount:</label>
                <input type="number" name="paymentAmount" id="paymentAmount" required>

                <button id="payButton" onclick="closeFormAndShowConfirmation()">Pay</button>
            </div>

            <div id="showConfirmationPopup" class="confirmation-popup" style="display: none;">
              <p>Do you want to proceed with this booking event?</p>
              <button id="confirmWait" class="confirm-button" onclick="hideConfirmationPopup()">Wait</button>
              <button id="confirmYes" class="confirm-button" onclick="confirmBooking()">Yes</button>

            </div>
            
            

            <div class="buttons">
                <button id="prev">Prev</button>
                <button id="next">Next</button>
            </div>
        </form>
    </div>

    

    <script>
    // Get the button element
    var addEvent = document.getElementById('addEvent');

    // Get the popup form element
    var addEventForm = document.getElementById('setForm');

    // Add an event listener to the button for the click event
    addEvent.addEventListener('click', function (event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Show the popup form
        addEventForm.style.display = 'block';

        // Initialize the current step to 1 when the form is opened
        currentStep = 1;
        updateStepDisplay();
    });
    
    function closeForm() {
    var addEventForm = document.getElementById('setForm');
    addEventForm.style.display = 'none';
}
    var selectedPackage = null;

    function selectPackage(packageName, packageElement) {
    selectedPackage = packageName;
    updateStepDisplay();

    // Remove the 'glowing' class from all package boxes
    var packageBoxes = document.querySelectorAll('.package-box');
    packageBoxes.forEach(function (box) {
        box.classList.remove('glowing');
    });

    // Add the 'glowing' class to the clicked package box
    packageElement.classList.add('glowing');
}
    //alert after submit data in booking
    document.addEventListener("DOMContentLoaded", function() {
    <?php
    if (isset($_SESSION['booking_success'])) {
        if ($_SESSION['booking_success']) {
            echo "alert('Booking data has been successfully inserted into the database.');";
            header('Location: ../client/booking.php');
            exit();
        } else {
            $errorMessage = isset($_SESSION['booking_error_message']) ? $_SESSION['booking_error_message'] : 'An error occurred while inserting booking data.';
            echo "alert('$errorMessage');";
            header('Location: ../client/booking.php');
            exit();
        }
    }
    unset($_SESSION['booking_success']);
    unset($_SESSION['booking_error_message']);
    ?>
});

   // JavaScript to handle "Prev" and "Next" buttons

var currentStep = 1;
var totalSteps = 7;

// Get the "Next" and "Prev" buttons
var nextButton = document.getElementById('next');
var prevButton = document.getElementById('prev');

// Get the circle indicators
var circles = document.querySelectorAll('.circle');

// Add an event listener to the "Next" button
nextButton.addEventListener('click', function (event) {
    event.preventDefault();
    nextStep();
});

// Add an event listener to the "Prev" button
prevButton.addEventListener('click', function (event) {
    event.preventDefault();
    prevStep();
});

// Initialize the form, enabling or disabling "Next" and "Prev" buttons
updateStepDisplay();

function nextStep() {
    if (currentStep < totalSteps) {
        if (validateFields(currentStep)) {
            currentStep++;
            updateStepDisplay();
        } else {
            // Validation failed, don't proceed to the next step
        }
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        updateStepDisplay();
    }
}

function updateStepDisplay() {
    // Hide all form steps
    var formSteps = document.querySelectorAll('.form-step');
    formSteps.forEach(function (step) {
        step.style.display = 'none';
    });

    // Show the current step
    var currentStepElement = document.getElementById('step' + currentStep);
    if (currentStepElement) {
        currentStepElement.style.display = 'block';
    }

    // Update the circle indicators
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
        var stepWidth = (80 / (totalSteps - 1)) * (currentStep - 1);
        progressLine.style.width = stepWidth + '%';
        progressLine.style.left = '10%';
    }

    // Enable or disable "Next" and "Prev" buttons based on the current step
    if (currentStep === 1) {
        prevButton.disabled = true;
        nextButton.disabled = false;
    } else if (currentStep === totalSteps) {
        prevButton.disabled = true;
        nextButton.disabled = true;
    } else {
        prevButton.disabled = false;
        nextButton.disabled = false;
    }
}

    function validateFields(step) {
    if (step === 1) {
      const bookingDate = document.getElementById('bookingDate').value;
      if (bookingDate === '') {
        alert('Please enter a booking date.');
        return false;
      }
    } else if (step === 2) {
      const eventType = document.getElementsByName('eventType')[0].value;
      const eventTitle = document.getElementsByName('eventTitle')[0].value;
      if (eventType === '' || eventTitle === '') {
        alert('Please fill in all required fields.');
        return false;
      }
    } else if (step === 3) {
      const eventLocation = document.getElementsByName('eventLocation')[0].value;
      if (eventLocation === '') {
        alert('Please enter the event location.');
        return false;
      }
    } else if (step === 4) {
      if (selectedPackage === null) {
        alert('Please choose a package.');
        return false;
      }
    } else if (step === 5) {
      const eventDescription = document.getElementsByName('eventDescription')[0].value;
      if (eventDescription === '') {
        alert('Please provide an event description.');
        return false;
      }
    } else if (step === 7) {
      const paymentAmount = document.getElementById('paymentAmount').value;
      if (paymentAmount === '') {
        alert('Please enter the payment amount.');
        return false;
      }
    }

    // Add similar validation for other steps

    return true;
  }


function collectAndDisplayData() {
    // Collect data from all steps
    var formData = {
        bookingDate: document.getElementById('bookingDate').value,
        bookingTime: document.getElementById('bookingTime').value,
        eventType: document.getElementsByName('eventType')[0].value,
        eventTitle: document.getElementsByName('eventTitle')[0].value,
        eventLocation: document.getElementsByName('eventLocation')[0].value,
        eventDescription: document.getElementsByName('eventDescription')[0].value,
        selectedPackage: selectedPackage || 'N/A',
        paymentAmount: document.getElementById('paymentAmount').value,
    };

    // Display the collected data in the summary receipt
    document.getElementById('receiptDate').textContent = formData.bookingDate;
    document.getElementById('receiptTime').textContent = formData.bookingTime;
    document.getElementById('receiptEventType').textContent = formData.eventType;
    document.getElementById('receiptEventTitle').textContent = formData.eventTitle;
    document.getElementById('receiptEventLocation').textContent = formData.eventLocation;
    document.getElementById('receiptEventDescription').textContent = formData.eventDescription;
    document.getElementById('selectedPackage').textContent = formData.selectedPackage;

    // Show the summary section (Step 6)
    document.getElementById('step6').style.display = 'block';
    // Hide the "Next" button and show the "Previous" button
    document.getElementById('next').style.display = 'none';     
    document.getElementById('prev').style.display = 'block';
}

  /// Add an event listener to the "Submit" button
document.getElementById('next').addEventListener('click', function (event) {
    event.preventDefault();
    collectAndDisplayData();
});

// Add an event listener to the "Previous" button
document.getElementById('prev').addEventListener('click', function (event) {
    event.preventDefault();
    // Hide the summary section (Step 6) and show the previous step
    document.getElementById('step6').style.display = 'none';
    document.getElementById('next').style.display = 'block';
    document.getElementById('prev').style.display = 'none';

  });

  // Function to show the confirmation popup
function showConfirmationPopup() {
    var confirmationPopup = document.getElementById('showConfirmationPopup');
    confirmationPopup.style.display = 'block';
}

    // Function to hide the confirmation popup
    function hideConfirmationPopup() {
        var confirmationPopup = document.getElementById('showConfirmationPopup');
        confirmationPopup.style.display = 'none';
    }

 // Check if the "Wait" button was clicked in the confirmation popup
 var waitButtonClicked = false;
    document.getElementById('confirmWait').addEventListener('click', function (event) {
        event.preventDefault();
        waitButtonClicked = true;
    });

    // If "Wait" was clicked, close the confirmation popup
    if (waitButtonClicked) {
        hideConfirmationPopup();
    }
    // Function to confirm the booking (you can customize this part)
    function confirmBooking() {
        // Here you can submit the form to the database
        document.querySelector('form').submit();
    }

// Add an event listener to the "Pay" button
document.getElementById('payButton').addEventListener('click', function (event) {
    event.preventDefault();
    showConfirmationPopup();
});


</script>

</body>
</html>
