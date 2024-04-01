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
                <div class="first-row">
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
                </div>
                <div class="second-row">
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
            </div>
        </section>
        <footer class="footer-page">
            <div class="footer">
                <div class="footer-row">
                    <ul class="footer-left-link">
                        <li><a href="../login.php">Login</a></li>
                        <li><a href="../about.php">About</a></li>
                        <li><a href="../portfolio.php">Portfolio</a></li>
                        <li><a href="../review.php">Testimonial</a></li>
                        <li><a href="../contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="vertical-line-left"></div>
                <div class="footer-center-content">

                    <div class="footer-center">
                        <h6>About ICSM Creatives</h6>
                        <p>We are dedicated to serving women of color in an underrepresented bridal market. All brides
                            will find inspiration on our blog, in our digital publication, on our social circuit and at
                            our national bridal events.</p>

                        <div class="social-meadia-links">
                            <h6>Connect with us</h6>
                            <div class="icons">
                                <a class="facebook" href="https://www.facebook.com/icsmcreatives" target="_blank"><i
                                        class="fa-brands fa-facebook"></i>
                                </a>
                                <a class="mail" href="https://www.facebook.com/cvsuimusofficialpage" target="_blank"><i
                                        class="fa-solid fa-envelope"></i>
                                </a>
                                <a class="instagram" href="https://www.instagram.com/icsmcreatives">
                                    <i class=" fa-brands fa-instagram"></i>
                                </a>
                                <a class="tiktok" href="https://www.tiktok.com/@icsm.creatives">
                                    <i class="fa-brands fa-tiktok"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="vertical-line-right"></div>
                <div class="footer-logo">
                    <a href="../homepage/homepage.php">
                        <img src="../picture/logo.png" alt="logo">
                    </a>
                </div>
            </div>
        </footer>

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