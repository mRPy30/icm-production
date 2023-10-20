<style>
    /*****Sidebar*****/

    .wrapper{
	    background: #FBF4F4;
	    height: calc(100vh - 40px);
	    border-radius: 15px;
	    display: flex;
    }
    .side_bar{
	    width: 250px;
	    height: 106%;

    }

    .side_bar .side_bar_top{
        background: #1C1C1D;
        height: 250px;
        border-radius: 0px 20px 0px 0px;
        padding: 30px;
    }

    .side_bar .side_bar_top .profile_pic{
        display: flex;
        justify-content: center;
        margin-bottom: 20px;	
    }

    .side_bar .side_bar_top .profile_pic img{
        width: 115px;
        height: 115px;
        padding: 5px;
        border: 2px solid #FBF4F4;
        border-radius: 50%;
    }

    .side_bar .side_bar_top .profile_info{
        text-align: center;
        color: #fff;
        font: normal 500 15px/20px 'Poppins';

    }

    .side_bar .side_bar_top .profile_info p{
        margin-top: 5px;
        font: normal 400 11px/20px 'Poppins';	
    }

    .side_bar .side_bar_bottom{
        background: #1C1C1D;
        height: calc(100% - 250px);
        padding: 20px 0;
        padding-left: 15px;		
        border-radius: 0px 0px 20px 0px;        
        text-decoration: none;
        list-style: none;	
    }

    .side_bar .side_bar_bottom ul li{
        position: relative;
        list-style: none;	
    }

    .side_bar .side_bar_bottom ul .nav-link a{
        display: block;
        padding: 15px 15px 15px 50px;		
        color: #FBF4F4;
        font: normal 500 15px/20px 'Poppins';
        margin-bottom: 5px;		
        text-decoration: none;	
    }

    .side_bar .side_bar_bottom ul .nav-link.active a{
        background: #FBF4F4;
        color:  #1c1c1c;
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
        font: normal 500 15px/20px 'Poppins';
    }

    .side_bar .side_bar_bottom ul .nav-link.active .top_curve,
    .side_bar .side_bar_bottom ul .nav-link.active .bottom_curve{
        position: absolute;
        left: 0;
        width: 100%;
        height: 20px;
        background: #FBF4F4;
        transition: background-color 0.3s, color 0.3s;
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
        height: 100%;
        background: #1C1C1D;	
    }

    .side_bar .side_bar_bottom ul li.active .top_curve:before{
        border-bottom-right-radius: 25px;
    }

    .side_bar .side_bar_bottom ul li.active .bottom_curve:before{
        border-top-right-radius: 25px;
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
        <div class="side_bar_top">
            <div class="profile_pic">
                <img src="profile.png" alt="profile">
            </div>
            <div class="profile_info">
                <h3>Gycia Moran</h3>
                <p>Admin</p>
            </div>
        </div>
        <div class="side_bar_bottom">
            <ul>
                <li class="nav-link active">
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
                    <a href="client.php" class="<?php if ($page == "..admin/client.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> "><span class="item">Client</span></a>
                    <span class="bottom_curve"></span>
                </li>
                <li class="nav-link">
                    <span class="top_curve"></span>
                    <a href="reports.php" class="<?php if ($page == "..admin/reports.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> "><span class="item">Reports</span></a>
                    <span class="bottom_curve"></span>
                </li>
                <li class="nav-link">
                    <span class="top_curve"></span>
                    <a href="service.php" class="<?php if ($page == "..admin/service.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> "><span class="item">Service</span></a>
                    <span class="bottom_curve"></span>
                </li>
                <li class="nav-link">
                    <span class="top_curve"></span>
                    <a href="website.php" class="<?php if ($page == "..admin/website.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> "><span class="item">Website Management</span></a>
                    <span class="bottom_curve"></span>
                </li>
                <div class="logout">
                    <button type="button" class="btn-logout" onclick="goBack()"> LOGOUT </button>
                </div>
            </ul>
        </div>
    </nav>
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

    function goBack() {
        window.location.href = "../login.php";
    }
</script>
<!-------End Sidebar------------>