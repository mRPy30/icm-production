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
    <?php include '../homepage/navbar.php'; ?>

    <main class="main-content">
        <section class="coverpage">
            <div class="cover-content">
                <img src="../picture/coverpage1.jpg" alt="coverpage">
                <div class="text">
                    <h2>Capture the moments of the World through our Lenses</h2>
                    <button class="button">Book Now</button>
                </div>
            </div>
        </section>

        <section class="portfolio">
            <!-- Portfolio content here -->
            <div class="portfolio-title">
                <hr class="horizontal-line1">
                <h2>Explore Portfolio</h2>
                <hr class="horizontal-line2">
            </div>

            <div class="box-section">
                <!-- Portfolio items -->
                <div class="box1">
                    <div class="box4">
                        <div class="portfolio-content1">
                            <img src="../picture/wed.jpg" alt="Wedding-Engagement">
                            <h2>Wedding + Engagement</h2>
                        </div>
                    </div>
                </div>
                <div class="box2">
                    <div class="box5">
                        <div class="portfolio-content2">
                            <img src="../picture/birthday.jpg" alt="Birthday">
                            <h2>Birthday</h2>
                        </div>
                    </div>
                </div>
                <div class="box3">
                    <div class="box6">
                        <div class="portfolio-content3">
                            <img src="../picture/portrait.jpg" alt="Portrait">
                            <h2>Portrait + Family</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="services">
            <div class="services-title">
                <h2>Service Price</h2>
                <h6>Photography / Videography ICSM Ratings:</h6>
            </div>

            <div class="services-box-section">
                <!-- services price items -->
                <div class="service-box"></div>
                <div class="service-box"></div>
                <div class="service-box"></div>
                <div class="service-box"></div>
            </div>
            <button class="button-services-section">Book Now</button>
        </section>

        <section class="review">
            <div class="review-part">
                <div class="review-left">
                    <img src="../picture/review.jpg" alt="">
                </div>
                <div class="review-right">
                    <div class="testimonial">
                        <h5> Testimonial</h5>
                        <h4>"Hands down one of our best decisions in our wedding planning process!"</h4>

                        <p>"Where do I even begin with these two!? Such amazing photographers - so amazing for our
                            wedding. They are amazing at communicating their vision and aligning it with yours, and
                            make sure it comes alive on your wedding day. They were patient and fun and personable,
                            and felt more like friends than photographers on the big day. Their images are striking,
                            being able to capture both beautiful posed shots as well as heartfelt candids. Truly
                            amazing photos and we feel so lucky that they were there to capture such a great and
                            memorable day."<br><br>
                            <i>- Kathryn & Daniel </i>
                        </p>
                        <div class="testimonial-arrow"><i class="fa-solid fa-arrow-left"></i><i
                                class="fa-solid fa-arrow-right"></i></div>

                    </div>

                </div>
            </div>
        </section>

    </main>
</body>
<script>
    document.querySelector(".button").addEventListener("click", function() {
        window.location.href = "../homepage/booking.php";
    });
</script>
</html>