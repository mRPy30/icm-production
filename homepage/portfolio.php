<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!---WEB TITLE--->
    <link rel="short icon" href="../picture/shortcut-logo.png" type="x-icon">
    <title>
        <?php echo "ICSM Portfolio"; ?>
    </title>


    <!---CSS--->
    <link rel="stylesheet" href="../css/homepage.css">

    <!--FONT LINKS-->
    <link
        href="https://fonts.googleapis.com/css2?family=Abel&family=Inter:wght@400;800&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet"><!--ICON LINKS-->
    <link rel="stylesheet" href="../font-awesome-6/css/all.css">

    <!--FONT LINKS-->
    <link rel="stylesheet" href="../css/fonts.css">

</head>

<body>
    <!-----Navbar------->
    <?php include '../homepage/navbar.php'; ?>

    <main class="portfolio-page">
        <section class="coverpage">
            <div class="cover-content">
                <img src="../picture/portfolio01.jpg" alt="coverpage">
                <div class="text">
                    <h2>Featured Projects</h2>
                </div>
            </div>
        </section>

        <section class="featured_projects">
            <div class="container-portfolio">
                <div class="grind-portfolio">
                    <img src="../picture/portfolio-wedding.jpg" alt="coverpage">
                    <div class="text-portfolio-title">
                        <p>Wedding</p>
                    </div>
                </div>
                <div class="grind-portfolio">
                    <img src="../picture/portrait.jpg" alt="coverpage">
                    <div class="text-portfolio-title">
                        <p>Portrait</p>
                    </div>
                </div>
                <div class="grind-portfolio">
                    <img src="../picture/birthday.jpg" alt="coverpage">
                    <div class="text-portfolio-title">
                        <p>Birthday</p>
                    </div>
                </div>
                <div class="grind-portfolio">
                    <img src="../picture/portfolio-family.jpg" alt="coverpage">
                    <div class="text-portfolio-title">
                        <p>Family</p>
                    </div>
                </div>
                <div class="grind-portfolio">
                    <img src="../picture/portfolio-prenup.jpg" alt="coverpage">
                    <div class="text-portfolio-title">
                        <p>Prenup</p>
                    </div>
                </div>
            </div>
        </section>



    </main>


</body>

</html>