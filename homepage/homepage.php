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
                <div class="carousel">
                    <img src="../picture/coverpage1.jpg" alt="coverpage">
                    <img src="../picture/prenup.jpg" alt="coverpage">
                    <img src="../picture/girls.jpg" alt="coverpage">
                    <img src="../picture/self.jpg" alt="coverpage">
                    <img src="../picture/wedding.jpg" alt="coverpage">
                </div>
                <div class="text">
                    <h2>Capture every precious moment through our lenses </h2>
                    <p>Get expert photographers and amazing photos, and <br>videos, starting from just PHP 2,500.</p>
                    <button class="button">Book Now</button>
                </div>
                <div class="carousel-page-numbers">
                    <span class="page-number-text">1/5</span>
                </div>
                <div class="horizontal-line"></div>
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
                            <a href="portfolio.php">
                                <img src="../picture/wed.jpg" alt="Wedding-Engagement">
                            </a>
                            <h2>Wedding + Engagement</h2>

                        </div>
                    </div>
                </div>
                <div class="box2">
                    <div class="box5">
                        <div class="portfolio-content2">
                            <a href="portfolio.php">
                                <img src="../picture/birthday.jpg" alt="Birthday">
                            </a>
                            <h2>Birthday</h2>
                        </div>
                    </div>
                </div>
                <div class="box3">
                    <div class="box6">
                        <div class="portfolio-content3">
                            <a href="portfolio.php">
                                <img src="../picture/portrait.jpg" alt="Portrait">
                            </a>
                            <h2>Portrait + Family</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="services">
            <div class="services-title">
                <h2>Check out these special deals!</h2>
                <h6>The ICSM price ratings</h6>
            </div>
            <div class="services-box-section">
                <!-- services price items -->
                <div class="service-box" style="padding-bottom:130px;">
                    <div class="package-name">
                        <h6>Package A</h6>
                        <p>Photoshoot</p>
                    </div>
                    <div class="price">
                        <h2>₱ 2,500</h2>
                    </div>
                    <div class="feature">
                        <h4>Things what you get:</h4>
                    </div>
                    <div class="price-details">
                        <div class="top">
                            <i class="fa-solid fa-check"></i>
                            <p>1 Hour Photoshoot</p>
                        </div>
                        <div class="bottom">
                            <i class="fa-solid fa-check"></i>
                            <p>100 pieces photo edited</p>
                        </div>
                    </div>
                </div>
                <div class="service-box" style="padding-bottom:130px;">
                    <div class="package-name">
                        <h6>Package B</h6>
                        <p>Video</p>
                    </div>
                    <div class="price">
                        <h2>₱ 30,000</h2>
                    </div>
                    <div class="feature">
                        <h4>Things what you get:</h4>
                    </div>
                    <div class="price-details">
                        <div class="top">
                            <i class="fa-solid fa-check"></i>
                            <p>Same day Edit</p>
                        </div>
                        <div class="bottom">
                            <i class="fa-solid fa-check"></i>
                            <p>10 minutes max video duration</p>
                        </div>
                    </div>
                </div>
                <div class="service-box">
                    <div class="package-name">
                        <h6>Package C</h6>
                        <p>Wedding Package</p>
                    </div>
                    <div class="price">
                        <h2>₱ 50,000</h2>
                    </div>
                    <div class="feature">
                        <h4>Things what you get:</h4>
                    </div>
                    <div class="price-details">
                        <div class="top">
                            <i class="fa-solid fa-check"></i>
                            <p>Same day Edit</p>
                        </div>
                        <div class="top">
                            <i class="fa-solid fa-check"></i>
                            <p>Unlimited Photoshoot</p>
                        </div>
                        <div class="bottom">
                            <i class="fa-solid fa-check"></i>
                            <p>Prenup Photoshoot</p>
                        </div>
                        <div class="bottom">
                            <i class="fa-solid fa-check"></i>
                            <p>Prenup Video
                        </div>
                        <div class="bottom">
                            <i class="fa-solid fa-check"></i>
                            <p>Video Highlights</p>
                        </div>
                    </div>
                </div>
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
                        <h4>"Hands down one of our best decisions in our wedding planning
                            process!"</h4>

                        <p>"Where do I even begin with these two!? Such amazing photographers -
                            so amazing for our
                            wedding. They are amazing at communicating their vision and aligning
                            it with yours, and
                            make sure it comes alive on your wedding day. They were patient and
                            fun and personable,
                            and felt more like friends than photographers on the big day. Their
                            images are striking,
                            being able to capture both beautiful posed shots as well as
                            heartfelt candids. Truly
                            amazing photos and we feel so lucky that they were there to capture
                            such a great and
                            memorable day."<br><br>
                            <i>- Kathryn Bernardo & Daniel Padilla </i>
                        </p>
                        <div class="testimonial-arrow"><i class="fa-solid fa-arrow-left"></i>
                            <i class="fa-solid fa-arrow-right" style="margin-left:10px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="about">
            <div class="about-page">
                <div class="about-left-content">
                    <div class="about-title">
                        <h1>Our Mission</h1>
                        <h5>is to make Life Memorable</h5>
                    </div>
                    <div class="about-description">
                        <p><B>We capture any occasion, easy and fast.</B><br>
                            Our days are shaped by moments; joyful moments, big important life achievements, but also
                            the
                            ordinary, everyday moments. Anything could be special when you do it with the people closest
                            to
                            you. But sometimes, these moments pass you by.<br><br>
                            Looking forward to work with you.</p>
                    </div>
                    <div class="more-button">
                        <a href="../about.php"><button>About Us</button></a>
                    </div>
                </div>
                <div class="about-right-content">
                    <div class="image1">
                        <img src="../picture/team.jpg" alt="Team-Picture">
                    </div>
                    <div class="image2">
                        <img src="../picture/behind-the-cam.jpg" alt="Behind-the-cam">
                    </div>
                </div>
            </div>
        </section>



    </main>

    <script>

        const images = document.querySelectorAll('.carousel img');
        const pageNumbers = document.querySelectorAll('.carousel-page-numbers .page-number');
        let idx = 0;

        function showImage(index) {
            images.forEach((image) => {
                image.style.display = 'none';
            });

            images[index].style.display = 'block';
            idx = index;

            // Update active page number
            pageNumbers.forEach((pageNumber, i) => {
                if (i === index) {
                    pageNumber.classList.add('active');
                } else {
                    pageNumber.classList.remove('active');
                }
            });

            updatePageNumberText(index);
        }

        function nextImage() {
            idx = (idx + 1) % images.length;
            showImage(idx);
        }

        function updatePageNumberText(index) {
            const currentPage = index + 1;
            const totalPages = images.length;
            const pageNumberText = document.querySelector('.page-number-text');
            pageNumberText.textContent = currentPage + '/' + totalPages;
        }

        setInterval(nextImage, 5000); // Change image every 5 seconds (adjust this value as needed)

        // Add click event listeners to page numbers
        pageNumbers.forEach((pageNumber, index) => {
            pageNumber.addEventListener('click', () => {
                showImage(index);
            });
        });
    </script>
</body>
<script>
    document.querySelector(".button").addEventListener("click", function() {
        window.location.href = "../homepage/booking.php";
    });
</script>
</html>