<?php
// Connection
include '../backend/dbcon.php';
// Fetch data from the "event" table
$eventQuery = "SELECT eventName FROM event";
$eventResult = mysqli_query($conn, $eventQuery);

// Fetch data from the "package" table
$packageQuery = "SELECT packageCategory, packageName, packagePrice, packageDetails FROM package";
$packageResult = mysqli_query($conn, $packageQuery);


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
        <?php echo "Book Event"; ?>
    </title>

    <!---CSS--->
    <link rel="stylesheet" href="../css/homepage.css">

    <!--ICON LINKS-->
    <link rel="stylesheet" href="../font-awesome-6/css/all.css">

    <!--FONT LINKS-->
    <link rel="stylesheet" href="../css/fonts.css">
    <style>
            body{
                background-color: #FBF4F4;
            }
    </style>
</head>
</body>
<!-----Navbar------->
<?php include '../homepage/navbook.php'; ?>

    <main class="main-book">
        <div class="coverbook">
                <div class="text-book">
                    <h4>Booking Event</h4>
                    <p>Starting from just PHP 2,500.</p>
                </div>
                <div class="line"></div>   
        </div>
        <div class="form-book">
            <div class="top-book">
                <div class="title">
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
                    <div class="progress-line"></div>
                    <div class="circle">
                        <i class="fa-solid fa-check"></i>
                    </div>
                </div>
            </div>
            <div class="forms">
            <form id="bookingForm" class="form-fillup needs-validation" method="POST" action="../backend/booking.php" onsubmit="return validateForm()">
                    <div id="step1" class="form-step">
                        <div class="form-group">
                            <div class="left-info">
                                <label for="bookingDate">Date</label>
                                <input type="date" name="bookingDate" id="formattedDateDisplay" class="form-input" onchange="formatDate()" required>
                                <br>
                                <label for="bookingTime">Time</label>
                                <input type="time" name="bookingTime" class="form-input" required>
                                <br>
                                <label for="eventType">Type of Event</label>
                                    <select name="eventType" id="eventType" required >
                                        <?php
                                        while ($event = mysqli_fetch_assoc($eventResult)) {
                                            echo "<option value='" . $event['eventName'] . "'>" . $event['eventName'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <br>
                                <label for="eventTitle">Name of Event</label>
                                <input type="text" id="eventTitle" name="eventTitle" required>
                            </div>
                                    
                            <div class="right-info">
                                <label for="eventLocation">Event Location</label>
                                <input type="text" id="eventLocation" name="eventLocation" required>
                                <br>
                                <label for="eventDescription">Booking Description</label>
                                <input type="text" id="eventDescription" name="eventDescription" required>
                                <br>
                                <label for="package">Select Package</label>
                                    <select name="package" id="package" required>
                                        <?php
                                        while ($package = mysqli_fetch_assoc($packageResult)) {
                                            echo "<option value='" . $package['packageName'] . "'>" . $package['packageCategory'] . ": " 
                                            . $package['packageName'] 
                                            . " (₱" . number_format($package['packagePrice'] ). ")</option>";
                                        }
                                        ?>
                                    </select>
                            </div>
                        </div>
                    </div>

                    <div id="step2" class="form-step" style="display: none;">
                        <div class="form-group">
                            <div class="left-info">
                                <form class="form-fillup needs-validation" method="POST" onsubmit="return validateForm()">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-input" placeholder="Enter your First Name" name="firstname">
                                    <label for="">Last Name</label>
                                    <input type="text" class="form-input" placeholder="Enter your Last Name" name="lastname">
                                    <label for="">Email</label>
                                    <input type="text" class="form-input" placeholder="Enter your Email" name="email">
                            </div>
                            <div class="right-info">
                                <label for="">Password</label>
                                <input type="password" class="form-input" placeholder="Enter your Password" name="password" id="password" oninput="checkPasswordStrength(this)">
                                <i id="togglePassword" class="fa-solid fa-eye"></i>                                
                                <label for="">Confirm Password</label>
                                <input type="password" class="form-input" placeholder="Enter your Confirm Password" name="confirm-password" id="confirmpassword">
                                <i id="toggleConfirmPassword" class="fa-solid fa-eye"></i> 
                                <div id="password-strength" class="alert"></div>
                            </div>
                        </div>
                    </div>

                    <div id="step3" class="form-step" style="display: none;">
                        <div class="receipt">
                                    
                        </div>               
                    </div>
                    <div class="buttons-book">
                        <button id="prev">Prev</button>
                        <button id="next">Next</button>
                    </div>
                </div>
        </div>
        <div id="popup" class="popup" style="display: none;">
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
                        <button type="submit" class="btn-save-event">Pay now</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>


<script>
    
    
    var currentStep = 1;
    var totalSteps = 3; 
    var prevButton = document.getElementById('prev');
    var nextButton = document.getElementById('next');
    var circles = document.querySelectorAll('.circle'); 
                                    
    function setForm(step) {
        // Hide all form steps
        var formSteps = document.querySelectorAll('.form-step');
        formSteps.forEach(function (stepElement) {
            stepElement.style.display = 'none';
        });
    
        // Show the current step
        var currentStepElement = document.getElementById('step' + step);
        if (currentStepElement) {
            currentStepElement.style.display = 'block';
        }
    
        // Update the progress line and circles
        updateStepDisplay();
    
        // Update the "Next" button text to "Pay" in step 3
        if (step === totalSteps) {
            nextButton.innerText = 'Pay Booking';
        } else {
            nextButton.innerText = 'Next';
        }
    }
    
    nextButton.addEventListener('click', function (event) {
    event.preventDefault();
    if (currentStep < totalSteps) {
        updateFormData(); // Update formData before moving to the next step
        currentStep++;
        setForm(currentStep);
        if (currentStep === totalSteps) {
            displayReceipt(); // Display receipt on the final step
        }
    } else {
        // If it's the last step, show the payment popup
        showPopup();
    }
});

// Function to show the payment popup
function showPopup() {
    var popup = document.getElementById('popup');
    if (popup) {
        popup.style.display = 'block';
    }
}

// Function to hide the payment popup
function hidePopup() {
    var popup = document.getElementById('popup');
    if (popup) {
        popup.style.display = 'none';
    }
}
    
    prevButton.addEventListener('click', function (event) {
        event.preventDefault();
        if (currentStep > 1) {
            updateFormData(); // Update formData before moving to the previous step
            currentStep--;
            setForm(currentStep);
        }
    });
    
    document.querySelector('.btn-save-event').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default form submission
    
    // Create a new FormData object
    var formData = new FormData(document.getElementById('bookingForm'));

    // Send an AJAX request to the server
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../backend/booking.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Redirect to a success page or handle the response
            window.location.href = '../client/booking.php';
        } else {
            // Handle errors
            console.error('Form submission failed. Status:', xhr.status);
        }
    };
    
    // Send the FormData object
    xhr.send(formData);
});

    // Function to update the step display
    function updateStepDisplay() {
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
            var stepWidth = (11 / (totalSteps - 1)) * (currentStep - 1);
            progressLine.style.width = stepWidth + '%';
            progressLine.style.left = '80.5%';
        }
    }
    
    var formData = {
        bookingDate: '',
        bookingTime: '',
        eventType: '',
        eventTitle: '',
        eventLocation: '',
        eventDescription: '',
        package: '',
        firstname: '',
        lastname: '',
        email: '',
    };
    
    function updateFormData() {
        formData.bookingDate = document.getElementById('formattedDateDisplay').value;
        formData.bookingTime = document.getElementsByName('bookingTime')[0].value;
        formData.eventType = document.getElementById('eventType').value;
        formData.eventTitle = document.getElementById('eventTitle').value;
        formData.eventLocation = document.getElementById('eventLocation').value;
        formData.eventDescription = document.getElementById('eventDescription').value;
        formData.package = document.getElementById('package').value;
        formData.firstname = document.getElementsByName('firstname')[0].value;
        formData.lastname = document.getElementsByName('lastname')[0].value;
        formData.email = document.getElementsByName('email')[0].value;
    }
    
    // Function to display receipt in step 3
    function displayReceipt() {
    var receiptDiv = document.querySelector('#step3 .receipt');
    receiptDiv.innerHTML = '<h2>Receipt</h2>';
    
    var receiptData = {
        'Costumer Name': formData.firstname + ' ' + formData.lastname,
        'Booking Date': formData.bookingDate,
        'Booking Time': formData.bookingTime,
        'Package Price': formData.package,
        'Event Type': formData.eventType,
        'Event Name': formData.eventTitle,
        'Location': formData.eventLocation,
    };

    for (var key in receiptData) {
        receiptDiv.innerHTML += '<p><strong>' + key + ':</strong> ' + receiptData[key] + '</p>';
    }
}

    // Function to toggle password visibility
    function togglePasswordVisibility(inputId, eyeId) {
        var passwordInput = document.getElementById(inputId);
        var eyeIcon = document.getElementById(eyeId);
    
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }
    
    // Add event listeners for the eye icons
    document.getElementById('togglePassword').addEventListener('click', function () {
        togglePasswordVisibility('password', 'togglePassword');
    });
    
    document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
        togglePasswordVisibility('confirmpassword', 'toggleConfirmPassword');
    });

</script>
</html>