<!--FONT LINKS-->
<link rel="stylesheet" href="../css/fonts.css">
<style>
    /*****Sidebar*****/

    .wrapper {
        height: 100%;
        display: flex;
        position: fixed;
        top: 0;
        left: 0;
        width: 14%;
        background-color: #000000;
        background-image: linear-gradient(147deg, #000000 0%, #434343 74%);
        z-index: 1001; 
    }


    .side_bar {
        width: 98%;
        height: 100vh;
        background: #EEEEEE;
    }

    .side_bar .logo-sidebar img{
        width: 50%;
        margin: 15% 0% 0% 27%;
    }

    .side_bar .side_bar_bottom{
        background: #EEEEEE;
        height: calc(100% - 200px);
        padding: 10% 0% 0% 10%;
        text-decoration: none;
        list-style: none;	
    }

    .side_bar .side_bar_bottom ul li{
        position: relative;
        list-style: none;	
    }

    .side_bar .side_bar_bottom ul .nav-link a{
        display: block;
        padding: 12px 15px 12px 50px;		
        color: #1c1c1c;
        font: normal 500 14px/20px 'Poppins';
        margin-bottom: 8px;		
        text-decoration: none;	
    }

    .side_bar .side_bar_bottom ul .nav-link.active a{
        background-color: #000000;
        background-image: linear-gradient(147deg, #000000 0%, #434343 74%);
        color: #fbf4fb;
        border-top-left-radius: 30px;
        border-bottom-left-radius: 30px;
        font: normal 500 14px/20px 'Poppins';
    }

    .side_bar .side_bar_bottom ul .nav-link.active .top_curve,
    .side_bar .side_bar_bottom ul .nav-link.active .bottom_curve{
        position: absolute;
        left: 0;
        width: 100%;
        height: 20px;
        background: #EEEEEE;
        transition: background-color 0.6s, color 1s;
    }

    .side_bar .side_bar_bottom ul .nav-link.active .top_curve{
        top: -20px;
    }

    .side_bar .side_bar_bottom ul .nav-link.active .bottom_curve{
        bottom: -20px;	
    }

    .side_bar .side_bar_bottom ul .nav-link.active .top_curve:before,
    .side_bar .side_bar_bottom ul .nav-link.active .bottom_curve:before{
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 90%;
        background: #EEEEEE;	
    }

    .side_bar .side_bar_bottom ul li.active .top_curve:before{
        border-bottom-right-radius: 25px;
    }

    .side_bar .side_bar_bottom ul li.active .bottom_curve:before{
        border-top-right-radius: 25px;
    }

    .side_bar .side_bar_bottom ul .nav-link:not(.active) a:hover {
        background: #D9D9D9;
        color: #1c1c1c;
        border-radius: 30px 0px 0px 30px;
    }

    .side_bar .side_bar_bottom ul .nav-link.active a:hover {
        background-color: #000000;
        color: #fbf4fb;
    }

    .side_bar .side_bar_bottom ul .nav-link.active .top_curve,
    .side_bar .side_bar_bottom ul .nav-link.active .bottom_curve {
        display: none;
    }
    
    
    .side_bar .side_bar_bottom .logout{
        padding: 10% 15% 15% 0%;		
    }
    .side_bar .side_bar_bottom .logout button{
        font: normal 600 14px/20px 'Poppins';
        color: #1c1c1c;
        background: #D9D9D9;
        border: none;
        width: 105%;
        height: 40px;
        border-radius: 10px;
        transition: all .3s ease;
    }

    .side_bar .side_bar_bottom .logout button:hover{
        transform: scale(1.02);
        background-color: #B3B3B3;
    }
    
    .popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 53%;
        height: 25%;
        width: 30%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 400px 900px rgba(0,0,0,0.28);
        z-index: 9999;
    }

    .popup-content {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
    }

    .popup-content p{
        font: normal 600 18px/20px 'Poppins';
        color: #1C1C1D;
        margin-bottom: 10%;
    }

    button#logoutYes {
        padding: 10px 15px;
        margin: 5px;
        background: #D25A5A;
        border: none;
        border-radius: 8px;
        color: #fff;
        font: normal 500 14px/20px 'Poppins';
        cursor: pointer;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.05);
        transition: all 200ms linear;
    }

    button#logoutNo {
        padding: 10px 15px;
        margin: 5px;
        background: #9b9b9b;
        border: none;
        border-radius: 8px;
        color: #ffffff;
        font: normal 600 14px/20px 'Poppins';
        cursor: pointer;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.05);
        transition: all 200ms linear;
    }

    #loadingOverlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            z-index: 10000;
            justify-content: center;
            align-items: center;
        }

        .loading-circle {
            border: 8px solid #1c1c1c;
            border-top: 8px solid #C2BE63;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 5s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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
<div class="wrapper">
    <nav class="side_bar">
            <div class="logo-sidebar">
                <img src="../picture/logo.png">
            </div> 
        <div class="side_bar_bottom">
            <ul>
                <li class="nav-link">
                    <span class="top_curve"></span>
                    <a href="dashboard.php" class="<?php if ($page == "dashboard.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> "><span class="item">Dashboard</span></a>
                    <span class="bottom_curve"></span>
                </li>
                <li class="nav-link">
                    <span class="top_curve"></span>
                    <a href="booking.php" class="<?php if ($page == "..admin/booking.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> "><span class="item">Booking</span></a>
                    <span class="bottom_curve"></span>
                </li>
                <li class="nav-link">
                    <span class="top_curve"></span>
                    <a href="calendar.php" class="<?php if ($page == "..admin/calendar.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> "><span class="item">Calendar</span></a>
                    <span class="bottom_curve"></span>
                </li>
                <li class="nav-link">
                    <span class="top_curve"></span>
                    <a href="client.php" class="<?php if ($page == "..admin/client.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> "><span class="item">Client</span></a>
                    <span class="bottom_curve"></span>
                </li>
                <li class="nav-link">
                    <span class="top_curve"></span>
                    <a href="feedback.php" class="<?php if ($page == "..admin/feedback.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> "><span class="item">Feedback</span></a>
                    <span class="bottom_curve"></span>
                </li>
                <li class="nav-link">
                    <span class="top_curve"></span>
                    <a href="analytics.php" class="<?php if ($page == "..admin/analytics.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> "><span class="item">Analytics</span></a>
                    <span class="bottom_curve"></span>
                </li>
                <li class="nav-link">
                    <span class="top_curve"></span>
                    <a href="finance.php" class="<?php if ($page == "..admin/finance.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> "><span class="item">Finance</span></a>
                    <span class="bottom_curve"></span>
                </li>
                <li class="nav-link">
                    <span class="top_curve"></span>
                    <a href="content.php" class="<?php if ($page == "..admin/content.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> "><span class="item">Content</span></a>
                    <span class="bottom_curve"></span>
                </li>
                <li class="nav-link">
                    <span class="top_curve"></span>
                    <a href="account.php" class="<?php if ($page == "..admin/account.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> "><span class="item">Profile</span></a>
                    <span class="bottom_curve"></span>
                </li>
            </ul>
            <div class="logout">
                <button type="text" class="btn-logout" onclick="openPopup()"> Logout </button>
            </div>
        </div>
    </nav>
</div>
    
<div id="loadingOverlay">
    <div class="loading-circle"></div>
</div>
    <!-----popup confirmation logout------>
    <div id="logoutPopup" class="popup">
        <div class="popup-content">
            <p>Are you sure you want to logout?</p>
            <button id="logoutNo">No</button>
            <button id="logoutYes">Yes</button>
        </div>
    </div>

<script>

    // JavaScript code to set the active page
    function setActivePage() {
        var currentUrl = window.location.href;

        // Remove any previously active links
        var activeLinks = document.querySelectorAll(".side_bar .side_bar_bottom ul li.active");
        for (var i = 0; i < activeLinks.length; i++) {
            activeLinks[i].classList.remove("active");
        }

        // Find the corresponding link and set it as active
        var links = document.querySelectorAll(".side_bar .side_bar_bottom ul li a");
        for (var i = 0; i < links.length; i++) {
            if (currentUrl.includes(links[i].getAttribute("href"))) {
                links[i].parentElement.classList.add("active");
                break; // Stop after the first match
            }
        }
    }

    // Call the setActivePage function when the page loads
    window.addEventListener("load", setActivePage);

   
    function openPopup() {
        document.getElementById("logoutPopup").style.display = "block";

        // Close the popup when clicking "No"
        document.getElementById("logoutNo").addEventListener("click", function () {
            document.getElementById("logoutPopup").style.display = "none";
        });

         // Handle the "Yes" click event for logout
         document.getElementById("logoutYes").addEventListener("click", function () {
            document.getElementById("loadingOverlay").style.display = "flex";

            setTimeout(function () {
                window.location.href = "../login.php";
            }, 2000); 
        });
    }
</script>
<!-------End Sidebar------------>