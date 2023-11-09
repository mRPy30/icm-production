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

    <!----css---->
    <style>
        body {
            overflow-y: hidden;
        }       
    </style>

    
</head>
    
<body>
    <div class="navbar">
        <h3>Admin Dashboard</h3>
        <i class="fa-regular fa-bell"></i>
    </div>  
    <!----Sidebar----->
    <?php 
        include '../admin/sidebar.php';
    ?>  

    <!----Main Content----->
    <main class="admin_main">   
        <div class="total-result">
            <!---BOXES---
            <div class='staff'>
                <p>Staff</p>
                <h1><?php echo $total_number; ?></h1>
            </div>
            <div class='staff'>
                <p>Staff</p>
                <h1><?php echo $total_number; ?></h1>
            </div>
            <div class='staff'>
                <p>Staff</p>
                <h1><?php echo $total_number; ?></h1>
            </div>
            <div class='staff'>
                <p>Staff</p>
                <h1><?php echo $total_number; ?></h1>
            </div>
            <div class='staff2'>
                <p>Staff</p>
                <h1><?php echo $total_number; ?></h1>
            </div>
        </div>
    --
        <section class="graph">
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <div style="padding: 0px 0px 20px 0px; margin: 3% 0% 0% 24%; border-radius: 5px; filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25)); width: 69.3%; background-color:#ffffff;">
                <h5 style="border-bottom: 1px solid #CCCCCC; border-radius: 7px 7px 0px 0px; padding: 20px 0px 20px 20px; color: #FBF4F4; background-color: #1c1c1c; font: normal 500 14px/normal 'Poppins';">Total Clients</h5>
                    <canvas style="height: 50px;" id="lineChart"></canvas>
            </div>
    
            <script>
                async function fetchData() {
                    const response = await fetch('../admin/dashboard.php');
                    const data = await response.json();
                    return data;
                }

                async function createChart() {
                    const data = await fetchData();
                    
                    const years = data.map(entry => entry.year);
                    const passingRates = data.map(entry => entry.passing_rate);
                    
                    const ctx = document.getElementById('lineChart').getContext('2d');
                    const chart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: years,
                            datasets: [{
                                label: 'Total ',
                                data: passingRates,
                                borderColor: '#008A0E',
                                backgroundColor: '#008A0E',
                                borderWidth: 3
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }

                createChart();
            </script>
        </section>
    </main>
            -->
    
    
</body>
</html>