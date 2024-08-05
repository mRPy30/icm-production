<?php
// Connection
include '../backend/dbcon.php';

session_start(); // Start the session
$clientID = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['booking']['package'] = $_POST['package'];
    header('Location: payment.php');
    exit();
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
        <?php echo "Choose Your Package"; ?>
    </title>

    <!---CSS--->
    <link rel="stylesheet" href="../css/client.css">

    <!--ICON LINKS-->
    <link rel="stylesheet" href="../font-awesome-6/css/all.css">

    <!--FONT LINKS-->
    <link rel="stylesheet" href="../css/fonts.css">

</head>

<body>
    <!-----Navbar------->
    <?php include '../client/navbar.php'; ?>

    <main class="main-content">
        <section class="booking-feed">
            <div class="content">
                <div class="fillup-book">
                    <div class="form-book">
                        <div class="top-book">
                            <div class="title">
                                <h3>Choose Your Package</h3>
                            </div>
                            <div class="steps">
                                <div class="circle">
                                    <h4>1</h4>
                                </div>
                                <div class="progress-line"></div>
                                <div class="circle active">
                                    <h4>2</h4>
                                </div>
                                <div class="progress-line"></div>
                                <div class="circle">
                                    <h4>3</h4>
                                </div>
                            </div>
                        </div>
                        <form id="serviceForm" class="form-fillup needs-validation" method="POST" action="service.php">
                            <div id="step2" class="form-step">
                                <div class="form-group">
                                    <label for="package">Select Package</label>
                                    <select name="package" id="package" required>
                                        <!-- Options here -->
                                    </select>
                                </div>
                            </div>
                            <div class="buttons-book">
                                <button type="button" onclick="history.back()">Prev</button>
                                <button type="submit">Next</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="going-back">
            <div class="arrow-up-button back-to-top-hidden">
                <button class="back-to-top" onclick="scrollToTop()"><i class="fas fa-arrow-up"></i></button>
            </div>
        </section>

        <section class="container-credential">
            <div class="credit-info">
                <div class="rights-definition">
                    <p>© 2023-2024 ICSMCREATIVES.COM ALL RIGHTS RESERVED. TERMS OF USE | PRIVACY POLICY</p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>