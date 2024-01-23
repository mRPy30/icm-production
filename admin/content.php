<?php 
// logout Automatically
include '../backend/logout.php';
//Connection
include '../backend/dbcon.php';


// Active Page

$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = $components[2];

// Fetch data from the content table
$query = "SELECT pictureID, pictureName, datePosted FROM content";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
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
        <?php echo "Admin | Website Management"; ?>
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
    

    <section class="content">
        <div class="content-box">
            <div class="content-box">
                <div class="top">
                    <h4>Upload Content Details</h4>
                    <button class="add-button"><i class="fa-solid fa-plus"></i> Add New</button>
                </div>
                <div class="content-tbl">
                    <table class="header-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Counter variable for numbering rows
                            $counter = 1;

                            // Loop through the fetched data and display it in the table
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $counter . "</td>";
                                echo "<td>" . $row['pictureName'] . "</td>";
                                echo "<td>" . date('F j, Y', strtotime($row['datePosted'])) . "</td>";
                                echo "<td>" . '<form method="post" action="" id="">
                                                <button type="button" name="edit" >Edit</button>
                                                <button type="submit" name="delete">Delete</button>
                                            </form>'. 
                                        "</td>";
                                echo "</tr>";

                                // Increment the counter
                                $counter++;
                            }

                            // Free the result set
                            mysqli_free_result($result);
                            ?>
                        </tbody>
                    </table>
                </div>               
            </div>
        </div>
    </section>
    
    <!----Navbar&Sidebar----->
    <?php 
        include '../admin/sidebar.php';
        include '../admin/navbar.php';
    ?>    

    
    
</body>
<script>
    // Add the following script to periodically check for inactivity and logout
    var inactivityTimeout = 900; // 15 minutes in seconds

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
</html>