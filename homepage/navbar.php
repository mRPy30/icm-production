<style>
    /*****Sidebar*****/

    * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    .header-section {
        width: 100%;
        background-color: #FFEDED;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0px 10% 0px 10%;
        position: sticky;
    }

    .header-section img {

        width: 80px;
        height: 90px;
        left: 50px;
        top: 2px;
        cursor: pointer;
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
        margin-top: 25px;
    }

    .nav-item li {
        display: inline-block;
        padding-right: 1cm;
        margin-left: 20px;
    }

    .nav-item li a {
        transition: all 0.3s ease 0s;
        text-decoration: none;
        color: #000000;
        text-align: center;
        font-size: 13px;
        font-family: 'Inter';

    }

    .nav-item li a.hover {
        background-color: aqua;
        flex-shrink: 0;
    }

    button {
        width: 100px;
        height: 34px;
        left: 90vw;
        top: 18px;
        font-style: normal;
        font-size: 15px;
        line-height: 24px;
        max-height: 100%;
        font-family: 'Inter';
        display: inline-block;
        cursor: pointer;
        border-radius: 30px;
        display: inline-flex;

    }


    /*****End of Sidebar*****/
</style>

<!-------Topbar-------->

<header class="header-section">
    <img src="../picture/logo.png">

    <ul>
        <li class="nav-item">
            <a class="nav-link active" href="homepage.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="homepage.php">Gallery</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="homepage.php">Services</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="homepage.php">About</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="homepage.php">Contact</a>
        </li>
    </ul>
    <a class="cta" href="#"><button>Register</button></a>
</header>

<!-------End Topbar------->