<?php 
//Connection
include '../backend/dbcon.php';
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
            overflow-y: hidden;
        }       
    </style>
</head>
    
<body>
    <!----Navbar&Sidebar----->
    <?php 
        include '../admin/navbar.php';
        include '../admin/sidebar.php';
    ?>   

    
    
</body>
</html>