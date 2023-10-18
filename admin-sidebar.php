<style>
    /*****Sidebar*****/

    .sidebar {
        width: 200px;
        height: 100vh;
        border-radius: 0px 15px 15px 0px;
        background: #1C1C1D;
    }
    .sidebar .nav .nav-link {
        padding: 10px 90px 10px 15px;
        color: #FBF4F4;
        font-size: 15px;
        font-family: 'Poppins';
        font-style: normal;
        line-height: 20px;
    }
    .sidebar .nav-link.active a{
        color: #000;
        border-radius: 15px;
        background-color: #FBF4F4;
    }

    /*******RESPONSIVE**********/

    @media (max-width: 992px) {
        .sidebar {
            position: relative;
            top: 70px;
            left: 0px;
            bottom: 0;
            width: 250px;
            height: 90vh;
            overflow-y: auto;
            background: rgba(255, 255, 255, 0.92);
        }
    }

    @media (max-width: 768px) {
        .sidebar {
            position: relative;
            top: 70px;
            left: 0px;
            bottom: 0;
            width: 250px;
            height: 90vh;
            background: rgba(255, 255, 255, 0.92);
        }

    }

    /****End Sidebar*****/
</style>

<!---------Sidebar------------>
<nav class="sidebar">
    <div class="navbar-nav">
        <ul class="nav">


                <li class="nav-link active">
                    <a href="admin.php" class="<?php if ($page == "admin.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> "> Dashboard </a>
                </li>

                <li class="nav-link">
                    <a href="admin.php" class="<?php if ($page == "admin.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> ">  Schedule </a>
                </li>

                <li class="nav-link">
                    <a href="admin.php" class="<?php if ($page == "admin.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> "> Client </a>
                </li>

                
                <li class="nav-link">
                    <a href="admin.php" class="<?php if ($page == "admin.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> "> Services </a>
                </li>
                
                <li class="nav-link">
                    <a href="admin.php" class="<?php if ($page == "admin.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> "> Finances </a>
                </li>

                <li class="nav-link">
                    <a href="admin.php" class="<?php if ($page == "admin.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> "> Photographers </a>
                </li>

                <li class="nav-link">
                    <a href="admin.php" class="<?php if ($page == "admin.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> "> Website </a>
                </li>

            </ul>
            <div class="logout">
                <button type="button" class="btn-logout" onclick="goBack()"> LOGOUT </button>
            </div>
        </div>
    </div>
</nav>
</div>
<!-------End Sidebar------------>