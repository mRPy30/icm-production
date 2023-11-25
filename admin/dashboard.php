<?php 
//Connection
include '../backend/dbcon.php';

session_start(); // Start the session

$sql = "SELECT COUNT(staffID) AS total FROM staff";
$result = $conn->query($sql);

// Check if there's a result
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_number = $row['total'];
} else {
    $total_number = 0;
}

$sql = "SELECT staffID, name, profile, email, role FROM staff";
$result = $conn->query($sql);

// Check if there's a result
if ($result->num_rows > 0) {
    $staffData = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $staffData = array(); // Empty array if no data
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
        <?php echo "Admin | Dashboard"; ?>
    </title>

    <!---CSS--->
    <link rel="stylesheet" href="../css/admin.css">

    <!--ICON LINKS-->
    <link rel="stylesheet" href="../font-awesome-6/css/all.css">

    <!--FONT LINKS-->
    <link rel="stylesheet" href="../css/fonts.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!----css---->
    <style>
        body {
            overflow-y: hidden;
        }       
    </style>

    
</head>
    
<body>
      
    <!----Navbar&Sidebar----->
    <?php 
        include '../admin/sidebar.php';
        include '../admin/navbar.php';
    ?>   

    <!----Main Content----->
    <main>
        <div class="dashboard">
            <div class="dashboard-item">
                <div class="dashboard-item-content">
                    <p>Total Client</p>
                    <h2><?php echo $total_number; ?></h2>
                </div>
                <div class="icon-container-client">
                    <i class="fas fa-user" style="font-size: 36px; color: #D25A5A;"></i>
                </div>
            </div>
            <div class="dashboard-item">
                <div class="dashboard-item-content">
                    <p>Revenue</p>
                    <h2><?php echo $total_number; ?></h2>
                </div>
                <div class="icon-container-chart">
                    <i class="fas fa-chart-line" style="font-size: 36px; color: #00008B;"></i>
                </div>
            </div>
            <div class="dashboard-item">
                <div class="dashboard-item-content">
                    <p>Rating</p>
                    <h2><?php echo $total_number; ?></h2>
                </div>
                <div class="icon-container-rate">
                <i class="fas fa-star" style="font-size: 36px; color: #FFF500;"></i>
                </div>
            </div>
        </div>

        <div class="dashboard-bottom">
            <div class="total-revenue">
                <h4>Total Revenue</h4>
                <canvas id="revenueChart"></canvas>
            </div>
            <div class="tbl-prod">
                <div class="title-bar">
                    <h4>Production Member</h4>
                </div>
                <div class="table-container">
                    <table class="prod-table">
                        <thead>
                            <tr>
                                <th colspan="2" style="padding-right: 30px">Name</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($staffData as $staff): ?>
                                <tr>
                                    <td style="padding-left: 30px; vertical-align: middle;"><img src="data:image/jpeg;base64,<?php echo base64_encode($staff['profile']); ?>" alt="Profile" style="width: 40px; height: 40px; border-radius: 100%;"></td>
                                    <td style="padding: 0px; text-align: start; color: #1C1C1D; font: normal 500 15px/normal 'Poppins'; ">
                                        <?php echo $staff['name']; ?><br>
                                        <span style="font: normal 400 11px/normal 'Poppins'; color: #929292;"><?php echo $staff['email']; ?></span>
                                    </td>
                                    <td>
                                        <?php
                                        $roles = explode(",", $staff['role']);
                                        echo implode("<br>", $roles);
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <main>
    
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
    </script>
</body>
</html>