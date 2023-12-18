<?php
// Connection and fetching data
include '../backend/dbcon.php';

session_start();

$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = end($components);

$query = "SELECT client.id, client.firstname AS firstname, client.profile, feedback.feedback_Title, feedback.select_photo, feedback.feedback_description, feedback.feedback_date
          FROM feedback
          INNER JOIN client ON feedback.clientID = client.id";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($connection));
}
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
        <?php echo "Admin | Feedback"; ?>
    </title>

    <!---CSS--->
    <link rel="stylesheet" href="../css/admin.css">

    <!--ICON LINKS-->
    <link rel="stylesheet" href="../font-awesome-6/css/all.css">

    <!--FONT LINKS-->
    <link rel="stylesheet" href="../css/fonts.css">

    <style>
        body {
            overflow-y: hidden;
        }       
    </style>
</head>
    
<body>
    
    

<section class="feedbox-inner">
    <div class="feedback-details">
        <div class="details">
            <div class="user_profile">
            <?php
                // Display user profile picture using base64
                mysqli_data_seek($result, 0); // Reset pointer to start of the result set
                while ($row = mysqli_fetch_assoc($result)) {
                    $profilePicture = !empty($row['profile']) ? $row['profile'] : 'path_to_default_image/default_profile.jpg';
                    // Output the profile picture as a base64 encoded string
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($profilePicture) . '" alt="Profile Picture">';
                    break; // Break the loop after displaying the profile picture once
                }
                ?>
            </div>
            <div class="info">
                <!-- Display name of user -->
                <?php
                // Displaying user name and formatted feedback_date
                mysqli_data_seek($result, 0); // Reset pointer to start of the result set
                while ($row = mysqli_fetch_assoc($result)) {
                    // Format the feedback_date to display month, date, and year
                    $formattedDate = date('F j, Y', strtotime($row['feedback_date']));
                    echo '<h5>' . $row['firstname'] .'</h5>' . '<p>' . $formattedDate . '</p>';
                    break; // Break the loop after displaying the user name and feedback_date once
                }
                ?>
            </div>
        </div>
        <div class="middle">
            <div class="select_photo">
                <!-- Display feedback photos -->
                <?php
                mysqli_data_seek($result, 0); // Reset pointer to start of the result set
                while ($row = mysqli_fetch_assoc($result)) {
                    $imageData = !empty($row['select_photo']) ? $row['select_photo'] : 'path_to_default_image/default.jpg';
                    // Output the image as a base64 encoded string or default image
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Select Photo">';
                }
                ?>
            </div>
            <div class="right">
                <div class="title">
                    <?php
                    mysqli_data_seek($result, 0); // Reset pointer to start of the result set
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<h2>' . $row['feedback_Title'] . '</h2>';
                        break; // Break the loop after displaying the feedback title once
                    }
                    ?>
                </div>
                <div class="rate">
                    <span class="rating" data-rating="0">
                        <i class="fas fa-star" data-index="1"></i>
                        <i class="fas fa-star" data-index="2"></i>
                        <i class="fas fa-star" data-index="3"></i>
                        <i class="fas fa-star" data-index="4"></i>
                        <i class="fas fa-star" data-index="5"></i>
                    </span>
                </div>
                <div class="description">
                    <?php
                    mysqli_data_seek($result, 0); // Reset pointer to start of the result set
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<p>' . $row['feedback_description'] . '</p>';
                        break; // Break the loop after displaying the feedback description once
                    }
                    ?>
                </div>
                <div class="buttons">
                    <button id="backButton">back</button>
                    <button id="postedButton">posted</button>
                </div>
            </div>
        </div>
    </div>
</section>

    
    <!----Navbar&Sidebar----->
    <?php 
        include '../admin/navbar.php';
        include '../admin/sidebar.php';
    ?> 
   

    
</body>
<script>
    // Get the back button element
    const backButton = document.getElementById('backButton');

    // Add click event listener to the back button
    backButton.addEventListener('click', function() {
        // Go back to the previous page in history
        history.back();
    });

    // Get all the star elements
    const stars = document.querySelectorAll('.rating i');

    stars.forEach((star, index) => {
        star.addEventListener('click', function() {
            const ratingValue = index + 1; // Calculate the rating value (starts from 1)
            const feedbackTitle = document.querySelector('.title h2').textContent.trim();
            const feedbackDescription = document.querySelector('.description p').textContent.trim();

            // Assuming you have clientID available in PHP session
            const clientID = <?php echo $_SESSION['clientID']; ?>;

            // Create an object to send to the backend (using fetch API for simplicity)
            const data = {
                feedback_Title: feedbackTitle,
                feedback_date: new Date().toISOString().slice(0, 19).replace('T', ' '), // Current date and time
                clientID: clientID,
                select_photo: '', // You can add photo data here if required
                feedback_description: feedbackDescription,
                rating: ratingValue // Include the rating value
            };

            // Send the data to your backend PHP file for database insertion
            fetch('../backend/insert_feedback.php', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                // Handle the response from the server
                // You can add further logic here if needed
                console.log('Feedback submitted successfully!');
            }).catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script>


</html>