<?php 
//Connection
include '../dbcon.php';

session_start(); // Start the session

$sql = "SELECT COUNT(photographerID) AS total FROM staff";
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
    <link rel="short icon" href="../picture/shortcut-logo.jpg" type="x-icon">
    <title>
        <?php echo "Admin | Dashboard"; ?>
    </title>

    <!---CSS--->
    <link rel="stylesheet" href="../css/admin.css">

    <!--CSS FRAMEWORK-->


    <!--ICON LINKS-->
    <script src="https://kit.fontawesome.com/11a4f2cc62.js" crossorigin="anonymous"></script>

    <!--FONT LINKS-->
    <link
        href="https://fonts.googleapis.com/css2?family=Abel&family=Inter:wght@400;800&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">
</head>
    
<body>
    <div class="background">
        <img src="../picture/logo.png">
    </div> 
    <!----Sidebar----->
    <?php 
        include '../admin/sidebar.php';
    ?>  

    <!----Main Content----->
    <main class="admin_main">   
        <div class="total-result">
            <!---BOXES--->
            <div class='staff'>
                <p>Staff</p>
                <h1><?php echo $total_number; ?></h1>
            </div>
            <div class='Client'>
                <p></p>
                <h1></h1>
            </div>
            <div class='events'>
            </div>
        </div>
    </main>

    
    
</body>
</html>