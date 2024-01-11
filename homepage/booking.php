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

    <!--FONT LINKS-->
    <link
        href="https://fonts.googleapis.com/css2?family=Abel&family=Inter:wght@400;800&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">
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
                <div id="step1" class="form-step">
                    <div class="form-group" style="padding: 10px;">
                        <label for="bookingDate">Date</label>
                        <input type="date" name="bookingDate" id="bookingDate" class="form-input"  required>
                        
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
                    
                        <label for="eventLocation">Event Location</label>
                        <input type="text" id="eventLocation" name="eventLocation" required>
                            
                        <label for="eventDescription">Booking Description</label>
                        <input type="text" id="eventDescription" name="eventDescription" required>
                        
                        <label for="package">Select Package</label>
                            <select name="package" id="package" required>
                                <?php
                                while ($package = mysqli_fetch_assoc($packageResult)) {
                                    echo "<option value='" . $package['packageName'] . "'>" . $package['packageCategory'] . ": " . $package['packageName'] . " ($" . $package['packagePrice'] . ")</option>";
                                }
                                ?>
                            </select>
                    </div>
                </div>

                <!--<div id="step2" class="form-step">
                    <form class="form-fillup needs-validation" method="POST" onsubmit="return validateForm()">
                    <input type="text" class="form" placeholder="Enter your First Name" name="firstname" required>
                    <br><br>
                    <input type="text" class="form" placeholder="Enter your Last Name" name="lastname" required>
                    <br><br>
                    <input type="text" class="form" placeholder="Enter your Email" name="email" required>
                    <br><br>
                    <input type="password" class="form" placeholder="Enter your Password" name="password" id="password"
                        required oninput="checkPasswordStrength(this)">
                    <i class="fa-solid fa-eye-slash" id="password-toggle" onclick="togglePassword()"
                        style="right: 17%; top: 50.5%; position: fixed;"></i>
                    <br><br>
                    <input type="password" class="form" placeholder="Enter your Confirm Password" name="confirm-password"
                        id="confirmpassword" required>
                    <br><br>
                    <div id="password-strength" class="alert"></div>
                    <button class="btn btn-lg btn-block btn-success" type="submit" name="submit"
                        value="Register">Register</button>
                </div>-->
                <div class="buttons">
                    <button id="prev">Prev</button>
                    <button id="next">Next</button>
                </div>
            </div>
        </div>
    </main>
</body>

</html>