<?php
// Connection
include 'backend/dbcon.php';

session_start();

require 'vendor/autoload.php';

use Facebook\Facebook;

// Initialize the Facebook SDK
$fb = new Facebook([
    'app_id' => '1015239673328681', // Replace with your Facebook app id
    'app_secret' => 'fff768c23626870c46c9d3b2d2e48cac', // Replace with your Facebook app secret
    'default_graph_version' => 'v2.10',
]);

$helper = $fb->getRedirectLoginHelper();

if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}

if (isset($_GET['code'])) {
    try {
        $accessToken = $helper->getAccessToken();
        $response = $fb->get('/me?fields=id,first_name,last_name,email', $accessToken);
        $user = $response->getGraphUser();

        $facebookID = $user['id'];
        $firstname = $user['first_name'];
        $lastname = $user['last_name'];
        $email = $user['email'];

        // Check if the email already exists
        $checkEmailQuery = "SELECT * FROM client WHERE email = '$email'";
        $result = $conn->query($checkEmailQuery);

        if ($result->num_rows > 0) {
            // Email already exists, log in the user
            $_SESSION['user_email'] = $email;
            header("Location: client/booking.php"); // Redirect to client page
            exit;
        } else {
            // Register the user
            $clientID = sprintf("%05d", mt_rand(1, 99999));
            $defaultProfilePic = 'default_profile.jpg';

            $sql = "INSERT INTO client (id, firstName, lastName, email, profile)
                    VALUES ('$clientID', '$firstname', '$lastname', '$email', '$defaultProfilePic')";

            if ($conn->query($sql) === TRUE) {
                $_SESSION['user_email'] = $email;
                header("Location: client/booking.php"); // Redirect to client page
                exit;
            }
        }
    } catch (Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
    }
}

$loginUrl = $helper->getLoginUrl('http://localhost/icsm-production/client/booking.php'); // Replace with your actual URL

function generateVerificationCode()
{
    return sprintf("%06d", mt_rand(1, 999999));
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
    <main>
        <section class="container">
            <div class="logo">
                <a href="homepage/homepage.php">
                    <img src="picture/logo.png" alt="logo">
                </a>
            </div>
            <div class="text">
                <h1>Welcome to <br>ICSM Creatives</h1>
                <h4>We poured out our undying dedications In Capturing Sweet Memories. </h4>
            </div>
        </section>

    <!----FORM----->
    <section class="form-section">
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
            <div class="fillup">
                <input type="text" class="form" placeholder="Enter your First Name" name="firstname" required>
            </div>
            <div class="fillup">
                <input type="text" class="form" placeholder="Enter your Last Name" name="lastname" required>
            </div>
            <div class="fillup">
                <input type="text" class="form" placeholder="Enter your Email" name="email" required>
            </div>
            <div class="fillup">
                <input type="password" class="form" placeholder="Enter your Password" name="password" id="password"
                required oninput="checkPasswordStrength(this)">
            </div>
            <div class="fillup">
                <input type="password" class="form" placeholder="Enter your Confirm Password" name="confirm-password" id="confirmpassword" required>
            </div>
            <div id="password-strength" class="alert"></div>
            <button class="btn btn-lg btn-block btn-success" type="submit" name="submit" value="Register">
                Register
            </button>
        </form>
        <div class="separator">
                <div class="separator-line"></div>
                <p>OR</p>
                <div class="separator-line"></div>
            </div>
            <div class="auth-btn-container">
                <a href="<?php echo htmlspecialchars($loginUrl); ?>" class="auth-button facebook">
                    <img src="picture/fb_logo.png"> Register with Facebook
                </a>
                <button class="google">
                    <img src="picture/google-logo.png"> Register with Google
                </button>
            </div>
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