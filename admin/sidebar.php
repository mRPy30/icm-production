<!--FONT LINKS-->
<link rel="stylesheet" href="../css/fonts.css">
<style>
    /*****Sidebar*****/

    /**Dark Mode**/
    body.dark-mode .side_bar {
        background-color: #444444; 
        color: #fff; 
    }
    body.dark-mode .side_bar_bottom{
        background-color: #444444;
        color: #fff; 
    } 
    body.dark-mode .wrapper{
        background-color: #f6f6f6;
        background-image: linear-gradient(315deg, #f6f6f6 0%, #e9e9e9 74%);
    }
    body.dark-mode .side_bar .side_bar_bottom ul .nav-link.active a{
        background-color: #f6f6f6;
        background-image: linear-gradient(315deg, #f6f6f6 0%, #e9e9e9 74%);
        color: #1c1c1c;
    }
    body.dark-mode .side_bar .side_bar_bottom ul .nav-link a{
        color: #FCF6F6;
    }
    body.dark-mode .side_bar .side_bar_bottom ul .nav-link:not(.active) a:hover {
        background: #5B5A5A;
        color: #fcfcfc;
        border-radius: 30px 0px 0px 30px;
    }
    body.dark-mode .logo-sidebar img.logo-image {
    content: url('../picture/logoDark.png');
}
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
        padding: 15% 0% 0% 10%;
        text-decoration: none;
        list-style: none;	
    }

    .side_bar .side_bar_bottom ul li{
        position: relative;
        list-style: none;	
    }

    .side_bar .side_bar_bottom ul .nav-link a{
        display: block;
        padding: 13px 15px 13px 50px;		
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
                <img class="logo-image" src="../picture/logo.png">
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
                <li class="nav-link">
                    <span class="top_curve"></span>
                    <a href="production.php" class="<?php if ($page == "..admin/production.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> "><span class="item">Production</span></a>
                    <span class="bottom_curve"></span>
                </li>
            </ul>
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

    function toggleDarkMode() {
        const body = document.body;
        const isDarkMode = body.classList.toggle('dark-mode');
        const moonIcon = document.querySelector('.dark-mode-toggle i');

        if (isDarkMode) {
            moonIcon.className = 'fas fa-sun';

            // Add transition class for animation
            moonIcon.classList.add('sun-transition');
            setTimeout(() => {
                moonIcon.classList.remove('sun-transition');
            }, 1000);
        } else {
            moonIcon.className = 'fas fa-moon';
        }

        // Save the dark mode preference to local storage or cookies if needed
        localStorage.setItem('darkMode', isDarkMode);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const body = document.body;
        const savedDarkMode = localStorage.getItem('darkMode');

        if (savedDarkMode === 'true') {
            body.classList.add('dark-mode');
            toggleDarkMode(); // Add this line to set the initial sun icon state
        }
    });
    
</script>
<!-------End Sidebar------------>