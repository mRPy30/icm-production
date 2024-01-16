<?php 
//Connection
include '../backend/dbcon.php';
session_start(); // Start the session
$clientID = $_SESSION['id'];
// Fetch the clients's data from the database
$sql = "SELECT * FROM client WHERE id = '$clientID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $clientID = $row['id'];
  $clientName = $row["firstName"] . " " .$row["lastName"];
  $clienFirstname = $row['firstName'];
  $clientLastame = $row['lastName'];
  $clientEmail = $row['email'];
  $clientProfilePicture = $row['profile'];
} else {
  echo "User data not found!";
  exit();
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
    <link rel="short icon" href="../picture/shortcut-logo.png" type="x-icon">
    <title>
        <?php echo "User | Booking Schedule"; ?>
    </title>

    <!---CSS--->
    <link rel="stylesheet" href="../css/client.css">

    <!--ICON LINKS-->
    <link rel="stylesheet" href="font-awesome-6/css/all.css">

    <!--FONT LINKS-->
    <link rel="stylesheet" href="../css/fonts.css">
    <style>
        body {
            overflow-y: hidden;
        }
    </style>
</head>
    
<body>
    <?php 
         include '../client/sidebar.php';
         include '../client/navbar.php';
    ?>  


<!---Profile-->
<div class="clientprofile">
<div class="left-column">
                <div class="profile">
                
                <h1> <?php echo htmlspecialchars($clientName); ?></h1>
                            <p>Client ID: <?php echo htmlspecialchars($clientID); ?></p>

                    <?php
                    // Check if a profile picture exists
                    if (!empty($clientProfilePicture)) {
                        // Display the current profile picture as a Base64 encoded image
                        echo '<div><img id="imagePreview" src="data:image/jpeg;base64,' . base64_encode($clientProfilePicture) . '" alt="Admin Profile" width="50%" height="50%"></div>';
                    } else {
                        echo "No profile picture available.";
                    }
                    ?>
                    
                    <form id="updateForm" action="../backend/update.php" method="post" enctype="multipart/form-data">
                        <div class="profile-section">
                            <label>
                                <input type="file" id="picture" name="picture" onchange="previewImage(event)">
                                Add new Photo+
                            </label>
                        </div>
                </div>

       </div>
<div>









<script>
        // JavaScript to preview the selected image
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.src = reader.result; // Update the src attribute
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // JavaScript function to update the profile picture
        function updateProfilePicture() {
            const fileInput = document.getElementById('picture');
            const file = fileInput.files[0];

            if (file) {
                const formData = new FormData();
                formData.append('picture', file);

                // Make an AJAX request to update.php to handle the update
                fetch('update.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.text())
                    .then(data => {
                        // On success, update the current profile picture on the page
                        const currentProfilePic = document.getElementById('currentProfilePic');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        }

        document.getElementById('updateForm').addEventListener('submit', function(event) {
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirm_password');
            const strength = document.getElementById('password-strength');
                
            if (!passwordsMatch()) {
                strength.textContent = 'Password and Confirm Password do not match.';
                strength.style.color = '#ff0000';
                strength.style.display = 'block'; 
                
                passwordInput.style.border = '2px solid #ff0000';
                confirmPasswordInput.style.border = '2px solid #ff0000';
                passwordInput.style.background = '#FCF6F6';
                confirmPasswordInput.style.background = '#FCF6F6';
                
                event.preventDefault();
            } else {
                strength.style.display = 'none';
                passwordInput.style.border = '1px solid #BCB4B5';
                confirmPasswordInput.style.border = '1px solid #BCB4B5';
                confirmPasswordInput.style.background = '#FCF6F6';
            }
        });
        
        function passwordsMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            return password === confirmPassword;
        }

        function resetForm() {
            document.getElementById('updateForm').reset();
            const strength = document.getElementById('password-strength');
            strength.style.display = 'none';
        }

        // Add the following script to periodically check for inactivity and logout
        var inactivityTimeout = 900; // 10 minutes in seconds

        function checkInactivity() {
            setTimeout(function () {
                window.location.href = '../login.php'; // Replace 'logout.php' with the actual logout page
            }, inactivityTimeout * 1000);
        }

        // Start checking for inactivity when the page loads
        document.addEventListener('DOMContentLoaded', function () {
            checkInactivity();
        });

        // Reset the inactivity timer when there's user activity
        document.addEventListener('mousemove', function () {
            clearTimeout(checkInactivity);
            checkInactivity();
        });

        document.addEventListener('keypress', function () {
            clearTimeout(checkInactivity);
            checkInactivity();
        });
        </script>
</body>
</html>