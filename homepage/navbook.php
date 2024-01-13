<style>
    /***** Homepage Navbar *****/

    * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    .header-section {
        width: 100%;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0px 5% 0px 5%;
        position: fixed;
        background: #fff;
        z-index: 9999;
    }

    .logo{
        width: 10%;
    }
    .header-section .logo img {
        width: 80%;
        height: 11%;
        cursor: pointer;
        margin-top: 5px;
    }

    .nav-item {
        list-style: none;
        display: inline-block;
        margin: 5px 40px 5px 10px;
    }

    .nav-item ul {
        display: flex;
        list-style: none;
        margin: 20px 100px;
    }

    .nav-item li {
        display: inline-block;
    }

    .nav-item a {
        text-decoration: none;
        color: #1C1C1D;
        font: normal 600 17px/normal 'Poppins';
        cursor: pointer;
        letter-spacing: 1px;
        position: relative;
    }

    .nav-item a.active {
        color: #C2BE63;
    }

    .nav-item a:hover {
        color: #C2BE63;
        transition: all 0.3s;
    }

    .nav-item .nav-link .header-section .register a:hover {
        text-decoration: none;
        cursor: pointer;
    }

    .right i{
        margin-left: 10px;
        font-size: 20px;
        cursor: pointer;
        transition: all .3s ease;
    }

    .right i:hover{
        transform: scale(1.05);
        color: #616161;
    }

    .register button:hover {
        background-color: #525256;
        color: white;
    }

    .nav-list {
        display: flex;
        list-style: none;
        margin: 20px 100px;
    }

    .mobile-menu-button {
        display: none;
    }

    @media screen and (max-width: 768px) {
        .header-section {
            flex-direction: column;
            align-items: flex-start;
        }

        .nav-list {
            display: none;
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
            position: absolute;
            background-color: white;
            padding: 10px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .nav-list.active {
            display: flex;
        }

        .nav-item {
            margin: 10px 0;
        }

        .mobile-menu-button {
            display: block;
        }

        /* Add the following styles to the existing ones */
        .nav-list li {
            display: block;
            margin: 10px 0;
        }

        /* Adjust the position of the register button */
        .register {
            margin-top: 10px;
        }

        /* Move the register button inside the mobile menu */
        .nav-list .register {
            margin-top: 0;
        }

        /* Adjust the styling of the register button */
        .register button {
            width: 100%;
            height: 34px;
            font: normal 500 15px/normal 'Poppins';
            line-height: 24px;
            cursor: pointer;
            fill: #FBF4F4;
            stroke-width: 1px;
            border-radius: 30px;
            stroke: #000;
            filter: drop-shadow(0px 3px 3px rgba(0, 0, 0, 0.25));
            display: inline-flex;
            padding: 3px 17px;
            transition: background-color 0.3s;
            color: black;
        }

        .register button:hover {
            background-color: #E46F80;
            color: black;
        }
    }
</style>

<body>
    <header class="header-section">
        <div class="logo">
            <a href="../homepage/homepage.php">
                <img src="../picture/logo.png" alt="logo">
            </a>
        </div>

        <button class="mobile-menu-button">&#9776; Menu</button>

        <ul class="nav-list">
            <li class="nav-item">
                <a class="nav-link" href="homepage.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="portfolio.php">Portfolio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="services.php">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
            </li>
        </ul>
        <div class="right">
                <i id="facebookIcon" class="fa-brands fa-facebook"></i>
                <i id="EmailIcon" class="fa-regular fa-envelope"></i>
        </div>
    </header>

    <script>
            document.addEventListener('DOMContentLoaded', function () {
                const mobileMenuButton = document.querySelector('.mobile-menu-button');
                const navList = document.querySelector('.nav-list');

                mobileMenuButton.addEventListener('click', function () {
                    navList.classList.toggle('active');

                    // Toggle the display property to fix the issue
                    if (navList.classList.contains('active')) {
                        navList.style.display = 'flex';
                    } else {
                        navList.style.display = 'none';
                    }
                });
            });

            document.addEventListener('DOMContentLoaded', function () {
            const facebookPageUrl = 'https://www.facebook.com/icsmcreatives';
            
            const facebookIcon = document.getElementById('facebookIcon');

            facebookIcon.addEventListener('click', function () {
                window.open(facebookPageUrl, '_blank');
            });
        });

        const emailUrl = 'mailto:icsmcreatives@gmail.com';
            const emailIcon = document.getElementById('EmailIcon');

            emailIcon.addEventListener('click', function () {
                window.location.href = emailUrl;
        });
    </script>
</body>

</html>