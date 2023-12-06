<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!---WEB TITLE--->
    <link rel="short icon" href="../picture/shortcut-logo.png" type="x-icon">
    <title>
        <?php echo "Online Event Booking"; ?>
    </title>


    <!---CSS--->
    <link rel="stylesheet" href="../css/homepage.css">

    <!--CSS FRAMEWORK-->


    <!--ICON LINKS-->
    <script src="https://kit.fontawesome.com/11a4f2cc62.js" crossorigin="anonymous"></script>

    <!--FONT LINKS-->
    <link
        href="https://fonts.googleapis.com/css2?family=Abel&family=Inter:wght@400;800&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet"><!--ICON LINKS-->
    <link rel="stylesheet" href="font-awesome-6/css/all.css">

    <!--FONT LINKS-->
    <link rel="stylesheet" href="../css/fonts.css">

</head>

<body>
    <!-----Navbar------->
    <?php
    include '../homepage/navbar.php';
    ?>
    <!-----End of Navbar------->

    <!----Main Content----->

    <main>
        <div class="main-content" stylesheet="">
            <svg id="curve" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1416.99 174.01">
                <path class="cls-1" d="M0,280.8S283.66,59,608.94,163.56s437.93,150.57,808,10.34V309.54H0V280.8Z"
                    transform="translate(0-135.53)" />
            </svg>


            <div class="text">
                <h2>Capture the moments of the world through our lenses</h2>
                <button class="button2">Book Now</button>
            </div>
        </div>


    </main>

    <div class="events">
        <div class="box">
            <img src="../picture/wedding.jpg" alt="wedding">
            <span class="first-event-box">Wedding</span>
        </div>
        <div class="box">
            <img src="../picture/birthday.jpg" alt="birthday">
            <span class="second-event-box">Birthday</span>
        </div>
        <div class="box">
            <img src="../picture/graduation.jpg" alt="graduation">
            <span class="third-event-box">Graduation</span>
        </div>
    </div>

    <div class="">

    </div>

    <!----End of Main Content----->

</body>

</html>