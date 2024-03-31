<?php
// Connection
include 'backend/dbcon.php';

// Include PHPMailer autoloader

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

// Function to generate a random 6-digit verification code
function generateVerificationCode()
{
    return sprintf("%06d", mt_rand(1, 999999));
}

if (isset($_POST['submit'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
    $lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, md5($_POST["password"]));
    $confirm_password = mysqli_real_escape_string($conn, md5($_POST["confirm-password"]));

    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM client WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        // Email already exists
        session_start();
        $_SESSION['registration_status'] = 'failed';
        header("Location: register.php");
        exit;
    }

    // Generate a 5-digit customer ID
    $clientID = sprintf("%05d", mt_rand(1, 99999));

    // Generate a 6-digit verification code
    $verificationCode = generateVerificationCode();

    // Insert customer data into the database
    $sql = "INSERT INTO client (id, firstName, lastName, email, password, confirmPass, code)
            VALUES ('$clientID', '$firstname', '$lastname', '$email', '$password', '$confirm_password', '$verificationCode')";

    if ($conn->query($sql) === TRUE) {
        // Registration was successful

        // Send verification code via email using PHPMailer
        $mail = new PHPMailer(true); // Set to true for exceptions

        try {
            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = 'araquejanvier@gmail.com';                     //SMTP username
            $mail->Password = 'sgjg jidy dxpy xzzp';                               //SMTP password
            $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
            $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('araquejanvier@gmail.com');
            $mail->addAddress($email);

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Hello new mr./ms ' . $firstname . ' ' . $lastname . '!';
            $mail->Body = 'Here is the verification code:<b>' . $verificationCode . ' </b>';

            $mail->send();

            echo '<script>alert("Register successfully! Verification code sent to your email.");</script>';
            echo '<script>window.location.href = "login.php";</script>';
            exit;
        } catch (Exception $e) {
            echo '<script>alert("Error sending email: ' . $mail->ErrorInfo . '");</script>';
        }
    }
}

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
    <link rel="short icon" href="picture/shortcut-logo.png" type="x-icon">
    <title>
        <?php echo "Icsm Production | Register Account"; ?>
    </title>

    <!---CSS--->
    <link rel="stylesheet" href="css/style.css">

    <!--ICON LINKS-->
    <link rel="stylesheet" href="font-awesome-6/css/all.css">

    <!--FONT LINKS-->
    <link rel="stylesheet" href="css/fonts.css">


</head>

<body>

    <!--background-->
    <main class="body_content">
        <div class="logo">
            <a href="homepage/homepage.php">
                <img src="picture/logo.png" alt="logo">
            </a>
        </div>
        <div class="text">
            <h1>Welcome to <br>ICSM Creatives</h1>
            <h4>We poured out our undying dedications In Capturing Sweet Memories. </h4>
        </div>
    </main>

    <!----FORM----->
    <section class="form-section">
        <div class="container">
            <div class="form_nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="login.php" class="<?php if ($page == "login.php") {
                            echo "nav-link active";
                        } else {
                            echo "nav-link";
                        } ?> " href="register.php">
                            Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="register.php" class="<?php if ($page == "register.php") {
                            echo "nav-link active";
                        } else {
                            echo "nav-link";
                        } ?> " href="register.php">
                            Register
                        </a>
                    </li>
                </ul>
            </div>
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
            </form>
        </div>
    </section>

    <script>

        // (alert) if successfully register
        <?php
        // Start the session
        session_start();

        // Check the registration status session variable and display an alert accordingly
        if (isset($_SESSION['registration_status'])) {
            $registrationStatus = $_SESSION['registration_status'];
            if ($registrationStatus === 'failed') {
                echo 'alert("Registration failed. Email already exists. Please try again.");';
            }

            // Clear the session variable
            unset($_SESSION['registration_status']);
        }
        ?>

            // Eye view hide
            let isPasswordVisible = false;
        const passwordField = document.getElementById('password');
        const passwordToggle = document.getElementById('password-toggle');

        function togglePassword() {
            isPasswordVisible = !isPasswordVisible;
            passwordField.type = isPasswordVisible ? 'text' : 'password';
            passwordToggle.className = isPasswordVisible ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash';
        }

        //validity if password and confirm is match
        function passwordsMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementsByName('confirm-password')[0].value;
            return password === confirmPassword;
        }

        // Function to validate 
        function validateForm() {
            if (!passwordsMatch()) {
                const strength = document.getElementById('password-strength');
                strength.textContent = 'Password and Confirm Password do not match.';
                strength.style.backgroundColor = '#f8d7da';
                strength.style.color = '#842029';
                strength.style.border = '2px solid #f5c2c7';
                return false;
            }
            return true; // Allow form submission
        }
        // password stregnth
        function checkPasswordStrength(input) {
            const password = input.value;
            const strength = document.getElementById('password-strength');
            const firstInput = document.getElementsByName('password')[0];

            let passwordStrength = 0;

            if (password.length >= 8) {
                passwordStrength++;
            }

            if (/[A-Z]/.test(password)) {
                passwordStrength++;
            }

            if (/[a-z]/.test(password)) {
                passwordStrength++;
            }

            if (/[0-9]/.test(password)) {
                passwordStrength++;
            }

            if (/[!@#\\$%^&*]/.test(password)) {
                passwordStrength++;
            }

            switch (passwordStrength) {
                case 1:
                    strength.textContent = 'Weak password';
                    strength.style.backgroundColor = '#f8d7da'; // Red background for weak password
                    strength.style.color = '#842029';
                    strength.style.border = "2px solid #f5c2c7";
                    firstInput.setCustomValidity('Weak password'); // Set custom validation message
                    break;
                case 2:
                    strength.textContent = 'Moderate password';
                    strength.style.backgroundColor = '#fff3cd'; // Orange background for moderate password
                    strength.style.color = '#664d03';
                    strength.style.border = "2px solid #ffecb5";
                    firstInput.setCustomValidity(''); // Reset custom validation message
                    break;
                case 3:
                    strength.textContent = 'Strong password';
                    strength.style.backgroundColor = '#d1e7dd'; // Green background for strong password
                    strength.style.color = '#0f5132';
                    strength.style.border = "2px solid #badbcc";
                    firstInput.setCustomValidity(''); // Reset custom validation message
                    break;
                case 4:
                case 5:
                    strength.textContent = 'Very strong password';
                    strength.style.backgroundColor = '#ace7cd'; // Green background for very strong password
                    strength.style.color = '#0a5331';
                    strength.style.border = "2px solid #badbcc";
                    firstInput.setCustomValidity(''); // Reset custom validation message
                    break;
                default:
                    strength.textContent = 'Password should contain at least 8 characters, including upper and lower case letters, numbers, and special characters.';
                    strength.style.backgroundColor = '#f8d7da'; // Red background for invalid password
                    strength.style.color = '#842029';
                    strength.style.border = "2px solid #f5c2c7";
                    firstInput.setCustomValidity('Weak password'); // Set custom validation message
                    break;
            }

            strength.style.display = 'block';
        }

    </script>
</body>

</html>