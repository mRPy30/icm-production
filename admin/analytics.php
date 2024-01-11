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

// Count total clients
$sqlClients = "SELECT COUNT(*) AS totalClients FROM client"; 
$resultClients = $conn->query($sqlClients);

// Check if there's a result for clients
if ($resultClients->num_rows > 0) {
    $rowClients = $resultClients->fetch_assoc();
    $totalClients = $rowClients['totalClients'];
} else {
    $totalClients = 0;
}

// Calculate total revenue
$sqlRevenue = "SELECT SUM(totalRevenue) AS totalRevenue FROM revenue"; 
$resultRevenue = $conn->query($sqlRevenue);

// Check if there's a result for revenue
if ($resultRevenue->num_rows > 0) {
    $rowRevenue = $resultRevenue->fetch_assoc();
    $totalRevenue = $rowRevenue['totalRevenue'];
} else {
    $totalRevenue = 0;
}

// Calculate average rating
$sqlRatings = "SELECT AVG(rating) AS averageRating FROM feedback";
$resultRatings = $conn->query($sqlRatings);

// Check if there's a result for ratings
if ($resultRatings->num_rows > 0) {
    $rowRatings = $resultRatings->fetch_assoc();
    $averageRating = $rowRatings['averageRating'];
} else {
    $averageRating = 0;
}

$sql = "SELECT COUNT(staffID) AS total FROM staff";
$result = $conn->query($sql);

// Check if there's a result
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_number = $row['total'];
} else {
    $total_number = 0;
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
        <?php echo "Admin | Analytics"; ?>
    </title>

    <!---CSS--->
    <link rel="stylesheet" href="../css/admin.css">

    <!--ICON LINKS-->
    <link rel="stylesheet" href="../font-awesome-6/css/all.css">

    <!--FONT LINKS-->
    <link rel="stylesheet" href="../css/fonts.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        body {
            overflow-y: hidden;
        }       
    </style>
</head>
    
<body>
    

<main class="analytics">
    <div class="row">
        <h3 id="monthHeader">Month <?php echo date('Y'); ?></h3>
        <div class="select">
            <select id="monthSelect" onchange="showSelectedMonth()" placeholder="Select">
                <option value="" selected disabled>Select Month</option>
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
                <option value="<?php echo date('F'); ?>">Current Month</option>
            </select>                       
            <button><i class="fa-solid fa-print"></i> Print</button>
        </div>
    </div>


    <!-- Move the row above the left and right sections -->
    
    <div class="middle-section">
        <div class="column">
            <div class="col-box">
                <div class="dashboard-item-content">
                    <p>Total Client</p>
                    <h2><?php echo $totalClients; ?></h2>
                </div>
                <div class="icon-container-client">
                    <i class="fas fa-user" style="font-size: 36px; color: #D25A5A;"></i>
                </div>
            </div>
            <div class="col-box">
                <div class="dashboard-item-content">
                    <p>Revenue</p>
                    <h2>₱<?php echo $totalRevenue; ?></h2>
                </div>
                <div class="icon-container-chart">
                    <i class="fas fa-chart-line" style="font-size: 36px; color: #00008B;"></i>
                </div>
            </div>
            <div class="col-box">
                <div class="dashboard-item-content">
                    <p>Rating</p>
                    <h2><?php echo $averageRating; ?>%</h2>
                </div>
                <div class="icon-container-rate">
                <i class="fas fa-star" style="font-size: 36px; color: #FFF500;"></i>
                </div>
            </div>
        </div>
        <div class="databox">
            <div class="graphs">
                <h4>Total Revenue</h4>
                <canvas id="revenueChart"></canvas>
            </div>
            <div class="graphs"></div>
        </div>
    </div>
</main>

    <!----Navbar&Sidebar----->
    <?php 
        include '../admin/sidebar.php';
        include '../admin/navbar.php';
    ?>   

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const revenueData = [100, 150, 200, 180, 250, 220];

            const ctx = document.getElementById('revenueChart').getContext('2d');

            const revenueChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Monthly Revenue',
                        data: revenueData,
                        borderColor: 'background-color: #0d0a0b;',
                        borderWidth: 3,
                        pointBackgroundColor: 'background-color:  #7a7adb;',
                        pointRadius: 5,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
        function showSelectedMonth() {
            var monthHeader = document.getElementById("monthHeader");
            var selectedMonth = document.getElementById("monthSelect").value;
            var currentYear = new Date().getFullYear(); // Get the current year
            
            if (selectedMonth === "") {
                monthHeader.textContent = "Month " + currentYear;
            } else {
                monthHeader.textContent = selectedMonth + " " + currentYear;
            }
        }
        // Function to automatically select the current month
        window.onload = function() {
            var currentMonth = new Date().toLocaleString('default', { month: 'long' });
            var selectElement = document.getElementById("monthSelect");
            
            for (var i = 0; i < selectElement.options.length; i++) {
                if (selectElement.options[i].value === currentMonth) {
                    selectElement.selectedIndex = i;
                    break;
                }
            }

            // Trigger the function to display the selected month
            showSelectedMonth();
        };

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
</body>
</html>