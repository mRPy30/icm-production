<?php
// Connection
include '../dbcon.php';
session_start();

// Active Page
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = $components[2];

// Fetch client data from the database
$sql = "SELECT id, profile, firstName, lastName FROM client";
$result = $conn->query($sql);

// Check if there's a result
if ($result->num_rows > 0) {
    $clientData = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $clientData = [];
}

// Handle client deletion
if (isset($_POST['delete'])) {
    $clientId = $_POST['client_id'];
    // Perform a SQL DELETE operation to remove the client with the specified ID
    $deleteSql = "DELETE FROM client WHERE id = $clientId";
    if ($conn->query($deleteSql) === true) {
        echo "Client with ID $clientId has been deleted successfully.";
        // You can add a redirect here if needed
    } else {
        echo "Error deleting client: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!---WEB TITLE--->
    <link rel="short icon" href="../picture/shortcut-logo.jpg" type="x-icon">
    <title>
        <?php echo "Admin | Dashboard"; ?>
    </title>

    <!---CSS--->
    <link rel="stylesheet" href="../css/admin.css">

    <!--ICON LINKS-->
    <link rel="stylesheet" href="../font-awesome-6/css/all.css">

    <!--FONT LINKS-->
    <link rel="stylesheet" href="../css/fonts.css">
    
</head>
    
<body>
    <div class="background">
        <img src="../picture/logo.png">
        <i class="fa-regular fa-bell"></i>
    </div>  
    <?php 
        include '../admin/sidebar.php';
    ?>

    <section class="booking-box">
        <div class="table-booking">
            <h4>Client Details</h4>
            <div class="search-bar">
                <input type="text" placeholder="Search client name" id="client-search">
                <i class="fa-solid fa-magnifying-glass" type="button" onclick="searchClient()" title="Search"></i>
            </div>
            <table class="header-table">
                <thead>
                    <tr>
                        <th>Client ID</th>
                        <th>Profile</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>

            <!-- Data Table -->
            <div class="data-table-container">
                <table class="data-table">
                    <tbody>
                    <?php
                        foreach ($clientData as $client) {
                            echo '<tr>';
                            echo '<td>' . $client['id'] . '</td>';
                            echo '<td><img src="data:image/jpeg;base64,' . base64_encode($client['profile']) . '" class="profile-image"></td>';
                            echo '<td>' . $client['firstName'] . '</td>';
                            echo '<td>' . $client['lastName'] . '</td>';
                            echo '<td><form method="POST" action="../admin/client.php">
                                    <input type="hidden" name="client_id" value="' . $client['id'] . '">
                                    <button type="submit" name="delete">Delete</button>
                                </form></td>';
                            echo '</tr>';
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    
    <script>
        function searchClient() {
            // Get the search input value and trim it
            var searchValue = document.getElementById("client-search").value.toLowerCase().trim();

            // Get the table rows
            var rows = document.querySelectorAll(".data-table tbody tr");

            // Loop through all the table rows
            for (var i = 0; i < rows.length; i++) {
                var nameColumn = (rows[i].querySelector("td:nth-child(3)").textContent + " " + rows[i].querySelector("td:nth-child(4)").textContent).toLowerCase();

                // If the combined name contains the search value, display the row, otherwise hide it
                if (nameColumn.includes(searchValue)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    </script>

</body>
</html>