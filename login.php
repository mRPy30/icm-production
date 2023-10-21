<?php
// Connection
include 'dbcon.php';

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
    <link rel="short icon" href="logo.jpg" type="x-icon">
    <title><?php echo "Icm Production | Login Account"; ?></title>

    <!---CSS--->
    <link rel="stylesheet" href="css/styles.css">

    <!--CSS FRAMEWORK-->
   

    <!--ICON LINKS-->
    <script src="https://kit.fontawesome.com/11a4f2cc62.js" crossorigin="anonymous"></script>

    <!--FONT LINKS-->
    <link href="https://fonts.googleapis.com/css2?family=Abel&family=Inter:wght@400;800&family=Poppins:wght@400;500&display=swap" rel="stylesheet">



</head>
<body>


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
                <input type="password" class="form" placeholder="Enter your Password" name="password" id="password" required oninput="checkPasswordStrength(this)"><br><br>
                <i class="fa-solid fa-eye-slash" id="password-toggle" onclick="togglePassword()" style= "right: 19%; top: 30.5%;"></i>
                <button class="btn btn-lg btn-block btn-success" type="submit" name="submit" value="Submit">Login</button>
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