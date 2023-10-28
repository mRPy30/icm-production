<?php 
//Connection
include '../dbcon.php';

session_start(); // Start the session

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
    <link rel="stylesheet" href="font-awesome-6/css/all.css">

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
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

   
        <!-- Set schedule form (hidden by default) -->
    <div id="setForm" class="form-popup">
        <form action="manageBooking.php" method="POST" class="" enctype="multipart/form-data">
            <header class="header">Booking Schedule</header>
            <div class="steps">
                <div class="circle active">1</div>
                <div class="circle">2</div>
                <div class="circle">3</div>
                <div class="circle">4</div>
                <div class="circle">5</div>
                <div class="circle">6</div>
            </div>
            <div class="progress-bar">
                <div class="progress-line"></div>
                <div class="indicator"></div>
            </div>

            <div class="buttons">
                <button id="prev" disabled>Prev</button>
                <button id="next">Next</button>
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
                <div class="package-box">
                    <h4>Basic</h4>
                </div>
                <div class="package-box">
                    <h4>Basic</h4>
                </div>
                <div class="package-box">
                    <h4>Basic</h4>
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

    var currentStep = 1;
    var totalSteps = 6; // Update this if you have more or fewer steps

    // Function to move to the next step
    function nextStep() {
        if (currentStep < totalSteps) {
            currentStep++;
            updateStepDisplay();
        }
    }

    // Function to move to the previous step
    function prevStep() {
        if (currentStep > 1) {
            currentStep--;
            updateStepDisplay();
        }
    }

    // Function to update the step display
    function updateStepDisplay() {
        // Hide all steps
        for (var step = 1; step <= totalSteps; step++) {
            var stepElement = document.getElementById('step' + step);
            if (stepElement) {
                stepElement.style.display = 'none';
            }
        }

        // Show the current step
        var currentStepElement = document.getElementById('step' + currentStep);
        if (currentStepElement) {
            currentStepElement.style.display = 'block';
        }

        // Update the active circle indicators
        for (var step = 1; step <= totalSteps; step++) {
            var circle = document.querySelector('.circle:nth-child(' + step + ')');
            if (circle) {
                if (step === currentStep) {
                    circle.classList.add('active');
                } else {
                    circle.classList.remove('active');
                }
            }
        }

        // Disable/enable navigation buttons
        var prevButton = document.getElementById('prev');
        var nextButton = document.getElementById('next');

        if (currentStep === 1) {
            prevButton.disabled = true;
        } else {
            prevButton.disabled = false;
        }

        if (currentStep === totalSteps) {
            nextButton.disabled = true;
        } else {
            nextButton.disabled = false;
        }
    }

    // Add event listeners to navigation buttons
    document.getElementById('prev').addEventListener('click', prevStep);
    document.getElementById('next').addEventListener('click', nextStep);
    
</script>

</body>
</html>