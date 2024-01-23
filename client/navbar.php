<?php
//Connection
include '../backend/dbcon.php';

$clientID = $_SESSION['id'];


$sql = "SELECT firstName , lastName, profile FROM client WHERE id = '$clientID'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row["firstName"] . " " .$row["lastName"];
    $profile = base64_encode($row["profile"]); // Corrected: Use base64_encode here
} else {
    // Handle the case where no data is found
    $name = "Name Not Found";
    $profile = "default_profile.jpg"; // Provide a default profile image
}

$pageTitles = array(
    "booking.php" => "Booking Event",
    "calendar.php" => "Calendar Details",
    "contacts.php" => "Message",
    "feedback.php" => "Feedback",
    "profile.php" => "My Profile",
    "gallery.php" => "My Gallery",
);

$currentPage = basename($_SERVER['SCRIPT_NAME']); 

$pageTitle = isset($pageTitles[$currentPage]) ? $pageTitles[$currentPage] : "Booking Event";
?>
<style>
    
    .navbar {
        width: 100%;
        height: 10%;
        background-color: #EEEEEE;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
    }

    .nav-left {
        margin: 0% 0% 0% 15%;
    }

    .nav-left h3 {
        color: #1c1c1c;
        font: normal 600 100%/1.7 'Poppins';
        
    }

    .nav-right {
        display: flex;
        align-items: center;
    }

    .nav-right i {
        font-size: 20px;
        color: #1c1c1c;
        margin-right: 10px;
    }

    .divider {
        width: 2px;
        height: 30px;
        background: #BCB4B5;
        margin: 0 15px;
    }

    .profile_info {
        text-align: right;
        color: #1c1c1c;
    }

    .profile_info h3 {
        margin-right: 10px;
        font: normal 600 95%/normal 'Poppins';
    }

    .profile_info p {
        margin-right: 10px;
        font: normal 400 70%/normal 'Poppins';
    }

    .profile_pic img {
        max-width: 35px;
        max-height: 35px;
        border-radius: 50%;
    }

    .profile_dropdown {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .profile_dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        margin-left: 75px;
    }

    .profile_dropdown:hover .profile_dropdown-content {
        display: block;
    }

    .profile_dropdown-content a {
        color: #1c1c1c;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        font: normal 600 14px/20px 'Poppins';
    }

    .profile_dropdown-content a:hover {
        background-color: #f1f1f1;
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
        padding: 10px 25px;
        margin: 5px;
        background: #FF8787;
        border: none;
        border-radius: 8px;
        color: #1c1c1c;
        font: normal 400 14px/20px 'Poppins';
        cursor: pointer;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        transition: all 200ms linear;
    }
    button#logoutYes:hover{
        background: #D25A5A;
    }

    button#logoutNo {
        padding: 10px 25px;
        margin: 5px;
        background: #DADADA;
        border: none;
        border-radius: 8px;
        color: #1c1c1c;
        font: normal 400 14px/20px 'Poppins';
        cursor: pointer;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);        
        transition: all 200ms linear;
    }
    button#logoutNo:hover{
        background: #9b9b9b;
    }

    #loadingOverlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);        
    z-index: 10000;
    justify-content: center;
    align-items: center;
    }

    .loading-circle {
        display: inline-block;
        width: 50px;
        height: 50px;
        border: 7px solid #E1DE8F;
        border-radius: 50%;
        border-top: 5px solid transparent;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

</style>





<header class="navbar">
<div class="nav-left">
        <h3><?php echo $pageTitle; ?></h3>
    </div>
    <div class="profile_dropdown">
        <div class="nav-right">
            <i class="far fa-bell"></i> 
            <i class="far fa-envelope"></i>
            <div class="divider"></div>
            <div class="profile_info">
                <h3><?php echo $name; ?></h3>
                <p>Client</p>
            </div>
            <div class="profile_pic">
                <img src="data:image/jpeg;base64,<?php echo $profile; ?>" alt="client image">
            </div>
        </div>
        <div class="profile_dropdown-content">
            <a href="profile.php">Profile</a>
            <a href="#" class="btn-logout">Logout</a>        
        </div>
    </div>
</header>

<body>
    <!-----popup confirmation logout------>
    <div id="logoutPopup" class="popup">
        <div class="popup-content">
            <p>Are you sure you want to logout?</p>
            <button id="logoutNo">No</button>
            <button id="logoutYes">Yes</button>
        </div>

        <div id="loadingOverlay">
            <div class="loading-circle"></div>
        </div>
    </div>
</body>

<script>
    

    document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".btn-logout").forEach(function (btn) {
                btn.addEventListener("click", openPopup);
            });

            document.getElementById("logoutNo").addEventListener("click", closePopup);

            document.getElementById("logoutYes").addEventListener("click", handleLogout);
        });

        function openPopup() {
            document.getElementById("logoutPopup").style.display = "block";
        }

        function closePopup() {
            document.getElementById("logoutPopup").style.display = "none";
        }

        function handleLogout() {
            document.getElementById("loadingOverlay").style.display = "flex";

            setTimeout(function () {
                document.getElementById("loadingOverlay").style.display = "none";

                window.location.href = "../login.php";
            }, 3000);
        }
</script>