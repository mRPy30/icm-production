<?php
// logout Automatically
include '../backend/logout.php';
// Connection
include '../backend/dbcon.php';

// Active Page
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = $components[2];

$sqlStaff = "SELECT staffID, name, email, role FROM staff";
$resultStaff = $conn->query($sqlStaff);

$sqlAdmin = "SELECT id, name, email FROM administrator";
$resultAdmin = $conn->query($sqlAdmin);
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
        <?php echo "Admin | Production"; ?>
    </title>

    <!---CSS--->
    <link rel="stylesheet" href="../css/admin.css">

    <!--ICON LINKS-->
    <link rel="stylesheet" href="../font-awesome-6/css/all.css">

    <!--FONT LINKS-->
    <link rel="stylesheet" href="../css/fonts.css">

    <style>
        body {
            overflow-y: hidden;
        }
    </style>
</head>

<body>
    
    <section class="production">
            <div class="prod-box">
                    <button id="addButton" class="add-button"><i class="fa-solid fa-plus"></i> Add New</button>
                    <div class="search-bar">
                    <input type="text" placeholder="Search expenses " id="search">
                  <i class="fa-solid fa-magnifying-glass" type="button" onclick="search()" title="Search"></i>
                    </div>
                <div class="prod-tbl">
                    <table class="header-table">
                        <thead>
                            <tr>
                                <th>Staff ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="data-container">
                        <table class="data-table">
                        <tbody>
                            <?php
                            // Display data from the administrator table
                            if ($resultAdmin->num_rows > 0) :
                                while ($rowAdmin = $resultAdmin->fetch_assoc()) :
                            ?>
                                    <tr>
                                        <td><?php echo $rowAdmin['id']; ?></td>
                                        <td><?php echo $rowAdmin['name']; ?></td>
                                        <td><?php echo $rowAdmin['email']; ?></td>
                                        <td>Admin</td>
                                        <td>
                                            <form method="post" action="">
                                                <button name="edit">Edit</button>
                                                <button name="delete">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile;
                            endif;

                            // Display data from the staff table
                            if ($resultStaff->num_rows > 0) :
                                while ($rowStaff = $resultStaff->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td><?php echo $rowStaff['staffID']; ?></td>
                                        <td><?php echo $rowStaff['name']; ?></td>
                                        <td><?php echo $rowStaff['email']; ?></td>
                                        <td><?php echo $rowStaff['role']; ?></td>
                                        <td>
                                            <form method="post" action="">
                                                <button name="edit">Edit</button>
                                                <button name="delete">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile;
                            endif;
                            ?>
                        </tbody>
                        </table>
                    </div>
                </div>
                <!-- Popup -->
                <div id="popup" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="hidePopup()">&times;</span>
                        <div class="form-container">
                            <form method="post" action="../backend/production.php" id="addMemberForm">
                                <input type="hidden" name="tableName" value="package"> <!-- Specify the table name -->
                                <div class="form-group">
                                    <label for="details">Name</label>
                                    <input type="text" name="username" id="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="category">Select Role</label>
                                    <select name="category" id="roleSelect" class="form-control" onchange="changeRole()">
                                        <option value="Admin">Admin</option>
                                        <option value="Staff">Staff</option>
                                    </select>
                                </div>
                                <div class="form-group" id="emailField">
                                    <label for="packageName">Email</label>
                                    <input type="text" name="email" id="email" class="form-control">
                                </div>
                                <div class="form-group" id="roleField">
                                    <label for="amount">Role</label>
                                    <div class="input-group">
                                        <input type="text" name="role" id="role" class="form-control" oninput="formatAmount()">
                                    </div>
                                </div>
                                <div class="form-group" id="passwordFields" style="display:none;">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input type="password" name="confirmPassword" id="confirmPassword" class="form-control">
                                </div>
                                <button type="submit" class="btn-save-event" id="submitBtn">Add Production Member</button>
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

        function search() {
            var searchValue = document.getElementById("search").value.toLowerCase().trim();

            var rows = document.querySelectorAll(".data-table tbody tr");

            for (var i = 0; i < rows.length; i++) {
                var nameColumn = (rows[i].querySelector("td:nth-child(2)").textContent + " " + rows[i].querySelector("td:nth-child(4)").textContent).toLowerCase();

                if (nameColumn.includes(searchValue)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }

        function changeRole() {
            var roleSelect = document.getElementById("roleSelect");
            var emailField = document.getElementById("emailField");
            var roleField = document.getElementById("roleField");
            var passwordFields = document.getElementById("passwordFields");

            if (roleSelect.value === "Admin") {
                emailField.style.display = "block";
                roleField.style.display = "none";
                passwordFields.style.display = "block";
            } else {
                emailField.style.display = "block";
                roleField.style.display = "block";
                passwordFields.style.display = "none";
            }
        }


        // Add the following script to periodically check for inactivity and logout
        var inactivityTimeout = 900; // 15 minutes in seconds

        function checkInactivity() {
            setTimeout(function () {
                window.location.href = '../login.php'; // Replace 'logout.php' with the actual logout page
            }, inactivityTimeout * 1000);
        }

        // Start checking for inactivity when the page loads
        document.addEventListener('DOMContentLoaded', function () {
            checkInactivity();
        });

        // Reset the inactivity timer when there's user activity
        document.addEventListener('mousemove', function () {
            clearTimeout(checkInactivity);
            checkInactivity();
        });

        document.addEventListener('keypress', function () {
            clearTimeout(checkInactivity);
            checkInactivity();
        });
    </script>
</body>
</html>