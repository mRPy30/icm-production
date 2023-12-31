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
            SELECT id, 'admin' as role FROM administrator WHERE email = '$email' AND password = '$password'";
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

            if ($role == 'admin') {
                header("location: admin/dashboard.php?id=$id");
                exit();
            } elseif ($role == 'client') {
                header("location: client/booking.php?id=$id");
                exit();
            }
        } else {
            // No matching user found
            echo ("No matching user found.");
            exit();
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
    <link rel="stylesheet" href="../css/fonts.css">


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
                <input type="text" class="form" placeholder="Enter your Email" name="email" required><br><br>
                <input type="password" class="form" placeholder="Enter your Password" name="password" id="password"
                    required oninput="checkPasswordStrength(this)"><br><br>
                <i class="fa-solid fa-eye-slash" id="password-toggle" onclick="togglePassword()"
                    style="right: 17%; top: 29.5%;"></i>
                <button class="btn btn-lg btn-block btn-success" type="submit" name="submit" value="Submit"
                    style="height: 7vh;">Login</button>
            </form>
        </div>
    </section>

    <script>

        let isPasswordVisible = false;
        const passwordField = document.getElementById('password');
        const passwordToggle = document.getElementById('password-toggle');

        function togglePassword() {
            isPasswordVisible = !isPasswordVisible;
            passwordField.type = isPasswordVisible ? 'text' : 'password';
            passwordToggle.className = isPasswordVisible ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash';
        }

    </script>
</body>

</html>