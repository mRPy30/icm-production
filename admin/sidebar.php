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
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
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
        font: normal 500 12px/20px 'Poppins';

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
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
        text-decoration: none;
        list-style: none;	
    }

    .side_bar .side_bar_bottom ul li{
        position: relative;
        list-style: none;	
    }

    .side_bar .side_bar_bottom ul li a{
        display: block;
        padding: 15px 15px 15px 50px;		
        color: #FBF4F4;
        font: normal 500 15px/20px 'Poppins';
        margin-bottom: 5px;		
        text-decoration: none;	
    }

    .side_bar .side_bar_bottom ul li.active a{
        background: #FBF4F4;
        color:  #1c1c1c;
        border-top-left-radius: 25px;
        border-bottom-left-radius: 25px;
    }

    .side_bar .side_bar_bottom ul li.active .nav-link .top_curve,
    .side_bar .side_bar_bottom ul li.active .nav-link .bottom_curve{
        position: absolute;
        left: 0;
        width: 100%;
        height: 20px;
        background: #FBF4F4;
    }

    .side_bar .side_bar_bottom ul li.active .nav-link .top_curve{
        top: -20px;
    }

    .side_bar .side_bar_bottom ul li.active .nav-link .bottom_curve{
        bottom: -20px;	
    }

    .side_bar .side_bar_bottom ul li.active .nav-link .top_curve:before,
    .side_bar .side_bar_bottom ul li.active .nav-link .bottom_curve:before{
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #1C1C1D;	
    }

    .side_bar .side_bar_bottom ul li.active .nav-link .top_curve:before{
        border-bottom-right-radius: 25px;
    }

    .side_bar .side_bar_bottom ul li.active .nav-link .bottom_curve:before{
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
                <h3>Admin</h3>
                <p>icmproduction001@gmail.com</p>
            </div>
        </div>
        <div class="side_bar_bottom">
            <ul>
                <li class="active">
                    <span class="top_curve"></span>
                    <a href="dashboard.php" class="<?php if ($page == "dashboard.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link active";
                    } ?> "><span class="item">Dashboard</span></a>
                    <span class="bottom_curve"></span>
                </li>
                <li>
                    <span class="top_curve"></span>
                    <a href="booking.php" class="<?php if ($page == "..admin/booking.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link active";
                    } ?> "><span class="item">Booking</span></a>
                    <span class="bottom_curve"></span>
                </li>
                <li>
                    <span class="top_curve"></span>
                    <a href="client.php" class="<?php if ($page == "..admin/client.php") {
                        echo "nav-link active";
                    } else {
                        echo "nav-link active";
                    } ?> "><span class="item">Client</span></a>
                    <span class="bottom_curve"></span>
                </li>
                <li>
                    <span class="top_curve"></span>
                    <a href="#">
                        <span class="icon"><i class="far fa-newspaper"></i></span>
                        <span class="item">REPORTS</span></a>
                    <span class="bottom_curve"></span>
                </li>
                <li>
                    <span class="top_curve"></span>
                    <a href="#">
                        <span class="icon"><i class="fas fa-chart-pie"></i></span>
                        <span class="item">STATISTICS</span></a>
                    <span class="bottom_curve"></span>
                </li>
                <li>
                    <span class="top_curve"></span>
                    <a href="#">
                        <span class="icon"><i class="fas fa-cog"></i></span>
                        <span class="item">SETTINGS</span></a>
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
    function goBack() {
        window.location.href = "../login.php";
    }
    var li_items = document.querySelectorAll(".side_bar_bottom ul li");

    li_items.forEach(function(li_main){
        li_main.addEventListener("click", function(){
            li_items.forEach(function(li){
                li.classList.remove("active");
            })
            li_main.classList.add("active");
        })
    })
</script>
<!-------End Sidebar------------>