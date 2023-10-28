<?php 
//Connection
include '../dbcon.php';

session_start();

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
        <?php echo "Admin | Booking"; ?>
    </title>

    <!---CSS--->
    <link rel="stylesheet" href="../css/admin.css">

    <!--ICON LINKS-->
    <link rel="stylesheet" href="font-awesome-6/css/all.css">

    <!--FONT LINKS-->
    <link rel="stylesheet" href="../css/fonts.css">

</head>
    
<body>
    <div class="background">
        <img src="../picture/logo.png">
    </div>

    <?php 
        include '../admin/sidebar.php';
    ?>
    
    <section class="booking-box">
        <div class="table-booking">
            <h4>Booking Details</h4>
            <table>
        <thead>
            <tr>
                <th>Title Event</th>
                <th>Title Event</th>
                <th>Title Event</th>
                <th>Title Event</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 3</td>
            </tr>
            <tr>
                <td>Data 4</td>
                <td>Data 5</td>
                <td>Data 6</td>
                <td>Data 3</td>
            </tr>
            <tr>
                <td>Data 7</td>
                <td>Data 8</td>
                <td>Data 9</td>
                <td>Data 3</td>
            </tr>
        </tbody>
    </table>
        </div>
    </section>

    
    
</body>
</html>