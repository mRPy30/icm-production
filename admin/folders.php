<?php 
// logout Automatically
include '../backend/logout.php';
//Connection
include '../backend/dbcon.php';

// Active Page
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = $components[2];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!---WEB TITLE--->
    <link rel="short icon" href="../picture/shortcut-logo.png" type="x-icon">
    <title>
        <?php echo "Admin | Client Folders"; ?>
    </title>

    <!---CSS--->
    <link rel="stylesheet" href="../css/admin.css">

    <!--ICON LINKS-->
    <link rel="stylesheet" href="../font-awesome-6/css/all.css">

    <!--FONT LINKS-->
    <link rel="stylesheet" href="../css/fonts.css">
    
    <style>
        body {
            overflow-y: auto;
        }       
    </style>
    
</head>
    
<body>

    <section class="folders">
        <div class="folder-box">
            <div class="top">
                <h4>Client's name Album</h4>
                <button id="addButton" class="add-button"><i class="fa-solid fa-plus"></i> New Album</button>
            </div>
            <div class="folder-body">
                <div class="album" onclick="window.location.href='../admin/gallery.php';" >
                    <i class="fa-regular fa-folder-open"></i>
                    <p>Album of client</p>
                </div>
            </div>
            <!-- Popup -->
                <div id="popup" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="hidePopup()">&times;</span>
                        <div class="form-container">
                            <form method="post" action="" id="addAlbum">
                                <h3>New Album</h3>
                                <input type="hidden" name="albumName" value="album"> 
                                <div class="form-group">
                                    <input type="text" name="album" id="" class="form-control" placeholder="Untitled Album">
                                </div>
                                <button type="submit" class="btn-save-event" id="submitBtn">Create</button>
                            </form>
                        </div>
                    </div>
                </div>                     
        </div>
    </section>
    <!----Navbar&Sidebar----->
    <?php 
        include '../admin/sidebar.php';
        include '../admin/navbar.php';
    ?>  

</body>
<script>
    function showPopup() {
                var popup = document.getElementById("popup");
                popup.style.display = "block";
            }
        
            function hidePopup() {
                var popup = document.getElementById("popup");
                popup.style.display = "none";
            }
        
            document.getElementById("addButton").addEventListener("click", function() {
                showPopup();
        });
</script>
</html>