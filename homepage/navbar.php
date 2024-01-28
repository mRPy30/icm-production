<style>
    /***** Homepage Navbar *****/

    * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    .cover-content-style {
        background-color: transparent !important;
        box-shadow: none !important;
    }

    .cover-content-style .nav-item a {
        color: #fcf6f6 !important;
    }

    .cover-content-style .logo img {
        content: url('../picture/logoDark.png');
    }
    .cover-content-style .register button{
        background-color: #fcf6f6;
        color: #1c1c1d;
    }

    .cover-content-style .nav-item a:hover {
        color: #C2BE63 !important;
        transition: all 0.3s;
    }

    .header-section {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0px 5% 0px 5%;
        position: fixed;
        background: #fcf6f6;
        z-index: 9999;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.2);
    }

    .logo {
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

    .register button {
        width: 100px;
        height: 34px;
        left: 95vw;
        font: normal 500 15px/normal 'Poppins';
        filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));
        display: inline-block;
        cursor: pointer;
        background: #1C1C1D;
        border-radius: 25px;
        padding: 3px 17px;
        transition: background-color 0.3s;
        color: #FCF6F6;
        border: none;
    }

    .register button:hover {
        background-color: #454548;
        color: #fcfcfc;
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
            cursor: pointer;
            padding: 3px 17px;
            margin: 10px 0px 0px 0px;
            border-radius: 25px;
            border: 1px solid #000;
            background: #1C1C1D;
            width: 25%;
            height: 6vh;
            font: normal 500 13px/normal 'Poppins';
            color: #FCF6F6;
        }

    }

    .register button:hover {
        background-color: #454548;
        color: #fcfcfc;
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
        <a class="register" href="../register.php"><button>Register</button></a>
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
    </script>
</body>

</html>