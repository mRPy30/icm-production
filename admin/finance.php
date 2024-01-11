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


$sqlRevenue = "SELECT SUM(totalRevenue) AS totalRevenue FROM revenue"; 
$resultRevenue = $conn->query($sqlRevenue);

if ($resultRevenue->num_rows > 0) {
    $rowRevenue = $resultRevenue->fetch_assoc();
    $totalRevenue = $rowRevenue['totalRevenue'];
} else {
    $totalRevenue = 0;
}

$sqlExpenses = "SELECT date, category FROM expenses";
$resultExpenses = $conn->query($sqlExpenses);

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
        <?php echo "Admin | Finance"; ?>
    </title>

    <!---CSS--->
    <link rel="stylesheet" href="../css/admin.css">

    <!--ICON LINKS-->
    <link rel="stylesheet" href="../font-awesome-6/css/all.css">

    <!--FONT LINKS-->
    <link rel="stylesheet" href="../css/fonts.css">
    
    <style>
        body {
            overflow-y: auto;
        }       
    </style>
    
</head>
    
<body>

    <section class="finance">
        <div class="mid-fin">
            <div class="left-finance">
                <div class="top">
                    <div class="fin-box">
                        <h4>₱40,000</h4>
                        <p>Expenses</p>
                    </div>
                    <div class="fin-box">
                        <h4>₱ <?php echo $totalRevenue; ?></h4>
                        <p>Overall Revenue</p>
                    </div>
                </div>
                <div class="bottom">
                    <div class="projects">
                        <h4>Total Finish Project</h4>
                        <table class="header-table">
                            <thead>
                                <tr>
                                    <th>Year</th>
                                    <th>No. of Projects</th>
                                </tr>
                            </thread>
                        </table>
                    </div>
                </div>
            </div>
            <div class="right-finance">
                <div class="reports">
                    <h4>Expenses Reports</h4>
                    <table class="header-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Category</th>
                            </tr>
                        </thread>
                    </table>
                    <div class="data-container">
                            <table class="data-table">
                                <tbody>
                                    <?php
                                    while ($rowExpense = $resultExpenses->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . date('F j, Y', strtotime($rowExpense['date'])); "</td>";
                                        echo "<td>" . $rowExpense['category'] . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <div class="bot-button">
                        <button>View More</button>
                    </div>    
                </div>
            </div>
        </div>
            <div class="packages">
                <div class="pack-box">
                    <div class="top">
                        <h4>Packages Prices</h4>
                        <button class="add-button"><i class="fa-solid fa-plus"></i> Add New</button>
                    </div>
                    <div class="finance-tbl">
                        <table class="header-table">
                            <thead>
                                <tr>
                                    <th>Details</th>
                                    <th>Category</th>
                                    <th>Price Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="data-container">
                            <table class="data-table">
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>               
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
    document.addEventListener('DOMContentLoaded', function() {
        const viewMoreButton = document.querySelector('button');

        viewMoreButton.addEventListener('click', function() {
            window.location.href = '../admin/expenses.php';
        });
    });

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