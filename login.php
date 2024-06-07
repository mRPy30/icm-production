<?php
// Connection
include 'backend/dbcon.php';

session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Hash the user's input password with md5
        $hashedPassword = md5($password);

        // Query the client and coordinator tables for a matching email and password
        $query = "SELECT id, 'client' as role FROM client WHERE email = '$email' AND password = '$hashedPassword'
            UNION
            SELECT id, 'admin' as role FROM administrator WHERE email = '$email' AND password = '$password'
            UNION
            SELECT staffID, 'staff' as role FROM staff WHERE email = '$email' AND password = '$password'";

        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        $matchedRows = mysqli_num_rows($result);

        if ($matchedRows > 0) {
            $row = mysqli_fetch_assoc($result);
            $id = $row['id'];
            $role = $row['role'];

            $_SESSION['name'] = $email;
            $_SESSION['id'] = $id;

            // Show loading overlay using inline style
            echo '<style>
                body { overflow: hidden; }
                .loading-overlay {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(255, 255, 255, 0.8);
                    z-index: 10000;
                }
                .loading-circle {
                    display: inline-block;
                    width: 40px;
                    height: 40px;
                    border: 7px solid #E1DE8F;
                    border-radius: 50%;
                    border-top: 5px solid transparent;
                    animation: spin 1s linear infinite;
                }
                @keyframes spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }
            </style>';
            echo '<div class="loading-overlay">
                    <div class="loading-circle"></div>
                  </div>';

            // Redirect after a delay
            echo '<script>
                setTimeout(function() {
                    if ("' . $role . '" === "admin") {
                        window.location.href = "admin/dashboard.php?id=' . $id . '";
                    } else if ("' . $role . '" === "client") {
                        window.location.href = "client/booking.php?id=' . $id . '";
                    } else if ("' . $role . '" === "staff") {
                        window.location.href = "staff/dashboard.php?id=' . $id . '";
                    }
                }, 2000);
            </script>';
            exit();
        } else {
            // Set login error to true if no matching user found
            $loginError = true;
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
        <?php echo "Icsm Production | Login Account"; ?>
    </title>

    <!---CSS--->
    <link rel="stylesheet" href="css/style.css">

    <!--CSS FRAMEWORK-->

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
                    <input type="text" class="form" placeholder="Enter your Email" name="email" required>
                    <br><br>
                    <input type="password" class="form" placeholder="Enter your Password" name="password" id="password" required oninput="checkPasswordStrength(this)">
                        <i class="fa-solid fa-eye-slash" id="password-toggle" onclick="togglePassword()" style="right: 17%; top: 29.5%;"></i>
                        <br><br>
                        <div id="popup" class="popup">
                            <p id="popup-message"></p>
                        </div>
                    <button class="btn btn-lg btn-block btn-success" type="submit" name="submit" value="Submit"
                        style="height: 7vh;">Login</button>
                        <br><br>
                        <p><a href="forgotpassword.php">Forget Password?</a><p>
                </form>
        </div>
        <div id="popup" class="popup">
            <p id="popup-message"></p>
        </div>
    </section>

    <script>
        // Eye view hide
        let isPasswordVisible = false;
        const passwordField = document.getElementById('password');
        const passwordToggle = document.getElementById('password-toggle');

        function togglePassword() {
            isPasswordVisible = !isPasswordVisible;
            passwordField.type = isPasswordVisible ? 'text' : 'password';
            passwordToggle.className = isPasswordVisible ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash';
        }

         document.addEventListener("DOMContentLoaded", function () {

     
            // Display popup if login was unsuccessful
            <?php if ($loginError): ?>
                var popup = document.getElementById("popup");
                var popupMessage = document.getElementById("popup-message");

                // Set the error message
                popupMessage.innerText = "Wrong credentials. Invalid email or password.";

                // Style the popup
                popup.style.display = "block";
                popup.style.backgroundColor = '#f8d7da';
                popup.style.color = '#842029';
                popup.style.border = '2px solid #f5c2c7';
                popup.style.padding = '10px';
                popup.style.font = 'normal 500 13px/normal "Poppins"';
                popup.style.borderRadius = '5px';
                popup.style.textAlign = 'center';

                // Close the popup after 3 seconds
                setTimeout(function () {
                    popup.style.display = "none";
                }, 7000);
            <?php endif; ?>
        });
    </script>
</body>

</html>
