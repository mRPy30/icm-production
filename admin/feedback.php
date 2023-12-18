<?php 
//Connection
include '../backend/dbcon.php';

session_start(); // Start the session

// Active Page

$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = $components[2];

// Fetch data from the database
$query = "SELECT client.firstname, feedback.feedback_Title, feedback.feedback_description
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
    

   

    <section class="feedbox">
        <div class="table-feedback">
            <table class="header-feedback">
                <thead>
                    <tr>
                        <th style="width: 10%;"></th>
                        <th style="padding: 1.5% 0% 1% 1%; width: 15%;">Name</th>
                        <th style="padding: 1.5% 0% 1% 1%; width: 15%;">Title</th>
                        <th style="padding: 1.5% 0% 1% 0%;">Feedback</th>
                        <th><i class="fa-regular fa-trash-can"></i><th>                
                    </tr>
                </thead>
            </table>
            <div class="data-container">
                <table class="data-table">
                    <tbody>
                        <?php
                        // Output data from the database
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr class='clickable-row'>";
                            echo "<td style='width: 7%'><input type='checkbox'></td>";
                            echo "<td style='padding: 1.5% 0% 1% 1%; width: 15%;'>" . $row['firstname'] . "</td>";
                            echo "<td style='padding: 1.5% 0% 1% 1%; width: 10%;'>" . $row['feedback_Title'] . "</td>";
                            echo "<td class='feedback-description' style='padding: 1.5% 3% 1% 7.8%; color: #959595;'>" . $row['feedback_description'] . "</td>";
                            echo "</tr>";
                        }                    
                        ?>
                    </tbody>
                </table>
            </div>

    <!----Navbar&Sidebar----->
    <?php 
        include '../admin/sidebar.php';
        include '../admin/navbar.php';
    ?> 
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tableRows = document.querySelectorAll(".data-table tbody tr");

            tableRows.forEach(row => {
            row.addEventListener("click", function(event) {
                if (event.target.tagName !== 'INPUT') { // Check if the clicked element is not an input
                window.location.href = '../admin/details.php'; // Redirect only if the clicked element is not an input
                }
            });
            });
        });
        </script>
        </div>
    </section>    
</body>
</html>