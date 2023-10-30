<?php 
//Connection
include '../dbcon.php';

session_start(); // Start the session
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Handle form submission

  // Retrieve and sanitize form data
  $bookingDate = $_POST['date'];
  $bookingTime = $_POST['time'];
  $eventType = $_POST['type_of_event'];
  $eventTitle = $_POST['title_event	'];
  $eventLocation = $_POST['venue'];
  $eventDescription = $_POST['description'];
  $paymentAmount = $_POST['paymentAmount'];

  // Insert the data into the "booking" table
  $sql = "INSERT INTO booking (date, time, type_of_event, title_event, venue, description, paymentAmount) 
          VALUES ('$bookingDate', '$bookingTime', '$eventType', '$eventTitle', '$eventLocation', '$eventDescription', '$paymentAmount')";

  if (mysqli_query($conn, $sql)) {
      // Data inserted successfully

      // Redirect to the same page to prevent form resubmission
      header('Location: ' . $_SERVER['PHP_SELF']);
      exit();
  } else {
      // Handle insertion error, you may want to show an error message
      $_SESSION['error_message'] = 'Error: ' . mysqli_error($conn);
      header('Location: booking.php'); // Redirect to the form page
      exit();
  }
}

// Display data in a table
$sql = "SELECT title_event, venue, eventDate FROM booking";
$result = mysqli_query($conn, $sql);

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
    <link rel="short icon" href="../picture/shortcut-logo.jpg" type="x-icon">
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
    <div class="background">
        <img src="../picture/logo.png">
    </div> 
    <?php 
        include '../client/sidebar.php';
    ?>
    <section class="booking-box">
        <div class="table-booking">
            <h4>Booking Details</h4>

                <div class="add-event">
                    <button class="add-button" id="addEvent">Set Schedule</button>
                </div>

            <table>
                <thead>
                    <tr>
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
                      echo '<td>' . $row['venue'] . '</td>';
                      echo '<td>' . $row['date'] . '</td>';
                      echo '<td>Status</td>'; // You can replace this with the actual status
                      echo '</tr>';
                  }
                  ?>
            </table>
        </div>
    </section>

   
        <!-- Set schedule form (hidden by default) -->
    <div id="setForm" class="form-popup">
        <form action="manageBooking.php" method="POST" class="" enctype="multipart/form-data">
            <header class="header">Booking Schedule</header>
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
            <div id="step1" class="form-step">
                <p>Set Date and Time Schedule</p>
                <label for="bookingDate">Date:</label>
                <input type="date" name="bookingDate" id="bookingDate" required>

                <label for="bookingTime">Time:</label>
                <input type="time" name="bookingTime" required>
            </div>

            <!-- Step 2 -->
            <div id="step2" class="form-step" style="display: none">
                <p>Set Event Title and Type</p>
                <label for="eventType">Type of Event</label>
                <input type="text" name="eventType" required>

                <label for="eventTitle">Title Event</label>
                <input type="text" name="eventTitle" required>
            </div>

            <!-- Step 3 -->
            <div id="step3" class="form-step" style="display: none">
                <p>Where is your event?</p>
                <label for="eventLocation">Address of Event</label>
                <input type="text" name="eventLocation" required>
            </div>

            <!-- Step 4 -->
            <div id="step4" class="form-step" style="display: none">
                <p>Choose your Packages</p>
                <div class="package-box basic" onclick="selectPackage('Basic', this)">
                    <h4>Basic</h4>
                </div>
                <div class="package-box standard" onclick="selectPackage('Standard', this)">
                    <h4>Standard</h4>
                </div>
                <div class="package-box premium" onclick="selectPackage('Premium', this)">
                    <h4>Premium</h4>
                </div>
            </div>


            <!-- Step 5 -->
            <div id="step5" class="form-step" style="display: none">
                <p>Booking Description</p>
                <input type="text" name="eventDescription" required>
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

                <button id="payButton" onclick="showConfirmationPopup()">Pay</button>
            </div>

            <div id="showConfirmationPopup" class="confirmation-popup" style="display: none;">
                <p>Do you want to proceed with this booking event?</p>
                <button id="confirmYes" class="confirm-button" onclick="confirmBooking()">Yes</button>
                <button id="confirmWait" class="confirm-button" onclick="hideConfirmationPopup()">Wait</button>
            </div>
            
            

            <div class="buttons">
                <button id="prev" disabled>Prev</button>
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
    
    var currentStep = 1; // Initialize the current step to 1
  var totalSteps = 7; // Define the total number of steps

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
       // Update the progress line position
        var progressLine = document.querySelector('.progress-line');
        if (progressLine) {
            var stepWidth = (100 / (totalSteps - 1)) * (currentStep - 1);
            progressLine.style.width = stepWidth + '%';
        }
    });

    // Enable or disable "Next" and "Prev" buttons based on the current step
    if (currentStep === 1) {
      prevButton.disabled = true;
    } else if (currentStep === totalSteps) {
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


// Initialize an object to store user input data
var data = {
    bookingDate: null,
    bookingTime: null,
    eventType: null,
    eventTitle: null,
    eventLocation: null,
    eventDescription: null,
    selectedPackage: null,
    paymentAmount: null
};

function updateData(step) {
    switch (step) {
        case 1:
            data.bookingDate = document.getElementById('bookingDate').value;
            data.bookingTime = document.getElementById('bookingTime').value;
            break;
        case 2:
            data.eventType = document.getElementsByName('eventType')[0].value;
            data.eventTitle = document.getElementsByName('eventTitle')[0].value;
            break;
        case 3:
            data.eventLocation = document.getElementsByName('eventLocation')[0].value;
            break;
        case 4:
            // You already have selectedPackage.
            break;
        case 5:
            data.eventDescription = document.getElementsByName('eventDescription')[0].value;
            break;
        case 6:
            // Display data on the receipt for step 6
            document.getElementById('receiptDate').textContent = data.bookingDate;
            document.getElementById('receiptTime').textContent = data.bookingTime;
            document.getElementById('receiptEventType').textContent = data.eventType;
            document.getElementById('receiptEventTitle').textContent = data.eventTitle;
            document.getElementById('receiptEventLocation').textContent = data.eventLocation;
            document.getElementById('receiptEventDescription').textContent = data.eventDescription;
            document.getElementById('selectedPackage').textContent = data.selectedPackage || 'N/A';
            break;
        case 7:
            data.paymentAmount = document.getElementById('paymentAmount').value;
            break;
    }
}
function showConfirmationPopup() {
    updateData(currentStep);

    // Show the confirmation popup
    var confirmationPopup = document.getElementById('confirmationPopup');
    if (confirmationPopup) {
        confirmationPopup.style.display = 'block';
    }
}



</script>

</body>
</html>
