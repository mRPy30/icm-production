<?php
//Connection
include '../dbcon.php';

$adminID = $_SESSION['id'];


$sql = "SELECT name, profile FROM administrator WHERE id = '$adminID'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $profile = base64_encode($row["profile"]); // Corrected: Use base64_encode here
} else {
    // Handle the case where no data is found
    $name = "Name Not Found";
    $profile = "default_profile.jpg"; // Provide a default profile image
}
?>
<style>
    /*****Sidebar*****/

<<<<<<< HEAD
    .wrapper{
	    height: calc(100vh - 40px);
	    border-radius: 15px;
	    display: flex;
=======
    .wrapper {
        background: #FBF4F4;
        height: calc(100vh - 40px);
        border-radius: 15px;
        display: flex;
>>>>>>> 40bfe7071e58dab8d6d6d46dd59cb2ac5cde1397
        position: absolute;
    }
<<<<<<< HEAD
    .side_bar{
	    width: 97%;
	    height: 99.5%;
=======

    .side_bar {
        width: 100%;
        height: 99.5%;
>>>>>>> 40bfe7071e58dab8d6d6d46dd59cb2ac5cde1397

    }

    .side_bar .side_bar_top {
        background: #1C1C1D;
        height: 245px;
        border-radius: 0px 17px 0px 0px;
        padding: 50px 0px 0px 0px;
    }

    .side_bar .side_bar_top .profile_pic {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .side_bar .side_bar_top .profile_pic img {
        width: 110px;
        height: 110px;
        padding: 5px;
        border-radius: 50%;
    }

    .side_bar .side_bar_top .profile_info {
        text-align: center;
        color: #fff;
        font: normal 500 15px/20px 'Poppins';

    }

    .side_bar .side_bar_top .profile_info p {
        margin-top: 5px;
        font: normal 400 12px/20px 'Poppins';
    }

    .side_bar .side_bar_bottom {
        background: #1C1C1D;
        height: calc(100% - 200px);
<<<<<<< HEAD
        padding: 15px 0px 0px 30px;
        border-radius: 0px 0px 20px 0px;        
=======
        padding: 0px 0px 0px 30px;
        border-radius: 0px 0px 20px 0px;
>>>>>>> 40bfe7071e58dab8d6d6d46dd59cb2ac5cde1397
        text-decoration: none;
        list-style: none;
    }

    .side_bar .side_bar_bottom ul li {
        position: relative;
        list-style: none;
    }

    .side_bar .side_bar_bottom ul .nav-link a {
        display: block;
        padding: 15px 15px 15px 50px;
        color: #FBF4F4;
<<<<<<< HEAD
        font: normal 500 80%/20px 'Poppins';
        margin-bottom: 5px;		
        text-decoration: none;	
=======
        font: normal 500 14px/20px 'Poppins';
        margin-bottom: 5px;
        text-decoration: none;
>>>>>>> 40bfe7071e58dab8d6d6d46dd59cb2ac5cde1397
    }

    .side_bar .side_bar_bottom ul .nav-link.active a {
        background: #FBF4F4;
        color: #1c1c1c;
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
        font: normal 500 83%/20px 'Poppins';
    }

    .side_bar .side_bar_bottom ul .nav-link.active .top_curve,
    .side_bar .side_bar_bottom ul .nav-link.active .bottom_curve {
        position: absolute;
        left: 0;
        width: 100%;
        height: 40%;
        background: #FBF4F4;
        transition: background-color 0.7s, color 1s;
    }

    .side_bar .side_bar_bottom ul .nav-link.active .top_curve {
        top: -20px;
    }

    .side_bar .side_bar_bottom ul .nav-link.active .bottom_curve {
        bottom: -20px;
    }

    .side_bar .side_bar_bottom ul .nav-link.active .top_curve:before,
    .side_bar .side_bar_bottom ul .nav-link.active .bottom_curve:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #1C1C1D;
    }

    .side_bar .side_bar_bottom ul li.active .top_curve:before {
        border-bottom-right-radius: 25px;
    }

    .side_bar .side_bar_bottom ul li.active .bottom_curve:before {
        border-top-right-radius: 25px;
    }

<<<<<<< HEAD
    .side_bar .side_bar_bottom .logout{
        padding: 10% 15px 15px 50px;		
    }
    .side_bar .side_bar_bottom .logout button{
        font: normal 500 75%/20px 'Poppins';
=======
    .side_bar .side_bar_bottom .logout {
        padding: 17% 15px 15px 50px;
    }

    .side_bar .side_bar_bottom .logout button {
        font: normal 500 14px/20px 'Poppins';
>>>>>>> 40bfe7071e58dab8d6d6d46dd59cb2ac5cde1397
        color: #FBF4F4;
        background: #1C1C1D;
        border: none;
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
        background: #747473;;
        border: none;
        border-radius: 8px;
        color: #ffffff;
        font: normal 500 14px/20px 'Poppins';
        cursor: pointer;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.05);
        transition: all 200ms linear;
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
                <img src="data:image/jpeg;base64,<?php echo $profile; ?>" alt="admin image">
            </div>
            <div class="profile_info">
                <h3>
                    <?php echo $name; ?>
                </h3>
                <p>Admin</p>
            </div>
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
                    <a href="finance.php" class="<?php if ($page == "..admin/finance.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link";
                    } ?> "><span class="item">Finance</span></a>
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
            </ul>
            <div class="logout">
                <button type="text" class="btn-logout" onclick="goBack()"> Logout </button>
            </div>
        </div>
    </nav>
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

   

            // JavaScript code to show the logout confirmation popup
        document.querySelector(".btn-logout").addEventListener("click", function() {
            document.getElementById("logoutPopup").style.display = "block";
        });

        // Close the popup when clicking "No"
        document.getElementById("logoutNo").addEventListener("click", function() {
            document.getElementById("logoutPopup").style.display = "none";
        });

        // Handle the "Yes" click event for logout
        document.getElementById("logoutYes").addEventListener("click", function() {
            // Redirect to the logout page
            window.location.href = "../login.php";
        });
</script>
<!-------End Sidebar------------>