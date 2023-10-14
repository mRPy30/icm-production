<?php 
//Connection
include 'dbcon.php';

if (isset($_POST['submit'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
    $lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, md5($_POST["password"]));
    $confirm_password = mysqli_real_escape_string($conn, md5($_POST["confirm-password"]));
    

    // Generate a 5-digit customer ID
    $clientID = sprintf("%05d", mt_rand(1, 99999));

    // Insert customer data into the database
    $sql = "INSERT INTO client (clientID, firstName, lastName, email, password, confirmPass)
            VALUES ('$clientID', '$firstname', '$lastname', '$email', '$password', '$confirm_password')";

     if ($conn->query($sql) === TRUE) {
        $clientID = $conn->insert_id; // Get the automatically generated customer ID
        echo "Customer registered successfully with ID: " . $clientID;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!---WEB TITLE--->
    <link rel="short icon" href="logo.jpg" type="x-icon">
    <title><?php echo "Icm Production | Register Account"; ?></title>

    <!---CSS--->
    <link rel="stylesheet" href="styles.css">

    <!--CSS FRAMEWORK-->
   

    <!--ICON LINKS-->
    <script src="https://kit.fontawesome.com/11a4f2cc62.js" crossorigin="anonymous"></script>

    <!--FONT LINKS-->
    <link href="https://fonts.googleapis.com/css2?family=Abel&family=Inter:wght@400;800&family=Poppins:wght@400;500&display=swap" rel="stylesheet">



</head>
<body>


    <section class="form-section">
        <div class="container">
            <h3>Register</h3>              
            <form class="form-fillup needs-validation" method="POST" onsubmit="return validateForm()">
                <div id="password-strength" class="alert"></div>                 
                <input type="text" class="form" placeholder="Enter your First Name" name="firstname" required><br><br>
                <input type="text" class="form" placeholder="Enter your Last Name" name="lastname" required><br><br>
                <input type="text" class="form" placeholder="Enter your Email" name="email" required><br><br>
                <input type="password" class="form" placeholder="Enter your Password" name="password" id="password" required oninput="checkPasswordStrength(this)"><br><br>
                <i class="fa-solid fa-eye-slash" id="password-toggle" onclick="togglePassword()"></i>
                <input type="password" class="form" placeholder="Enter your Confirm Password" name="confirm-password" required><br><br>
                <button class="btn btn-lg btn-block btn-success" type="submit" name="submit" value="Register">Register</button>
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
        
        function checkPasswordStrength(input) {
            const password = input.value;
            const strength = document.getElementById('password-strength');
            const firstInput = document.getElementsByName('firstname')[0]; // Get the first input field

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
                    strength.style.backgroundColor = '#ff9b93'; // Red background for weak password
                    strength.style.color = 'red';
                    strength.style.border = "2px solid #ff0000";
                    firstInput.setCustomValidity('Weak password'); // Set custom validation message
                    break;
                case 2:
                    strength.textContent = 'Moderate password';
                    strength.style.backgroundColor = '#ffd993'; // Orange background for moderate password
                    strength.style.color = '#FFA500';
                    strength.style.border = "2px solid #FFA500";
                    firstInput.setCustomValidity(''); // Reset custom validation message
                    break;
                case 3:
                    strength.textContent = 'Strong password';
                    strength.style.backgroundColor = '#73ff78'; // Green background for strong password
                    strength.style.color = '#00c407';
                    strength.style.border = "2px solid #00c407";
                    firstInput.setCustomValidity(''); // Reset custom validation message
                    break;
                case 4:
                case 5:
                    strength.textContent = 'Very strong password';
                    strength.style.backgroundColor = '#73ff78'; // Green background for very strong password
                    strength.style.color = '#00c407';
                    strength.style.border = "2px solid #00c407";
                    firstInput.setCustomValidity(''); // Reset custom validation message
                    break;
                default:
                    strength.textContent = 'Password should contain at least 8 characters, including upper and lower case letters, numbers, and special characters.';
                    strength.style.backgroundColor = '#ff9b93'; // Red background for invalid password
                    strength.style.color = 'red';
                    firstInput.setCustomValidity('Weak password'); // Set custom validation message
                    break;
            }

            strength.style.display = 'block';
        }
        
    </script>
</body>
</html>