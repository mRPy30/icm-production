<!DOCTYPE html>
<html>

<head>
    <style>
        /***** Sidebar *****/

        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        .header-section {
            width: 100%;
            background-color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 5% 0px 5%;
            position: fixed;
            background: #fff;
            z-index: 9999;
        }

        .header-section img {
            width: 9vw;
            height: 9vh;
            cursor: pointer;
            margin: 10px;
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
            transition: all 0.3s ease 0s;
            text-decoration: none;
            color: #1C1C1D;
            font: normal 600 17px/normal 'Poppins';
            cursor: pointer;
            letter-spacing: 1px;
            position: relative;
        }

        .nav-item a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background-color: #E46F80;
            transition: width 0.3s ease;
        }

        .nav-item a:hover::after {
            width: 100%;
        }

        .nav-item a.active {
            color: #E46F80;
        }

        .nav-item a:hover {
            color: #E46F80;
            cursor: pointer;
            padding: 5px;
        }

        .nav-item .nav-link .header-section .register a:hover {
            text-decoration: none;
            cursor: pointer;
        }

        button {
            width: 100px;
            height: 34px;
            left: 95vw;
            font: normal 500 15px/normal 'Poppins';
            line-height: 24px;
            display: inline-block;
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

        button:hover {
            background-color: #E46F80;
            color: black;
        }

        /***** End of Sidebar *****/
    </style>
</head>

<body>
    <header class="header-section">
        <img src="../picture/logotry1.png">

        <ul>
            <li class="nav-item">
                <a class="nav-link" href="homepage.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="gallery.php">Gallery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#services">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#about">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#contact ">Contact</a>
            </li>
        </ul>
        <a class="register" href="../register.php"><button>Register</button></a>
    </header>
</body>

</html>