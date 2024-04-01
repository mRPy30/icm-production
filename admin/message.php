<?php 
// logout Automatically
include '../backend/logout.php';
//Connection
include '../backend/dbcon.php';

// Set the last activity time
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
    // Last request was more than 10 minutes ago
    session_unset();     
    session_destroy();   
}
$_SESSION['LAST_ACTIVITY'] = time(); 

$query = "SELECT 'client' AS sender, message.messageID, message.messageSender, message.messageReceiver, message.date, client.firstName, client.lastName, client.profile
          FROM message
          INNER JOIN client ON message.clientID = client.id
          ORDER BY date ASC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}

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
        <?php echo "Admin | Message"; ?>
    </title>

    <!---CSS--->
    <link rel="stylesheet" href="../css/message.css">

    <!--ICON LINKS-->
    <link rel="stylesheet" href="../font-awesome-6/css/all.css">

    <!--FONT LINKS-->
    <link rel="stylesheet" href="../css/fonts.css">

    <!--_Navbar--->
    <header class="navbar">
        <div class="nav-left">
            <h3>chat message</h3>
        </div>
        <div class="profile_dropdown">
            <div class="nav-right">
                <div class="icons">
                    <div class="notification-dropdown">
                        <i class="far fa-bell" onclick="toggleNotifications()" title="Notification"></i>
                        <div class="notification-dropdown-content">
                            <div class="top_notif">
                                <h4>Notifications</h4>
                            </div>
                            <div class="notification">Notification 1</div> 
                            <div class="notification">Notification 2</div>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="logo-nav">
                    <img class="logo-image" src="../picture/logo.png" id="logo">
                </div>             
            </div>
        </div>
    </header>
</head>

<body>


    <!---Sidebar--->

    <div class="wrapper">
        <nav class="side_bar">
            <div class="search-bar">
                <input type="text" placeholder="Search..." id="search" title="search message">
            </div>
            <div class="client-message">
                <?php 
                while ($row = mysqli_fetch_assoc($result)) {
                    // Base64 encode the profile image
                    $profileImage = base64_encode($row['profile']);
                    echo "<div class='profile'><img src='data:image/jpeg;base64,{$profileImage}' alt='Profile Image'></div>";
                    echo "<div class='name'>{$row['firstName']} {$row['lastName']}</div>";
                    echo "<div class='message'><p>{$row['messageSender']}</p></div>";
                }
                ?>
            </div>
        </nav>
    </div>   
    
    <main class="convo-area">
        <div class="date">
            <?php
                mysqli_data_seek($result, 0);
                while ($row = mysqli_fetch_assoc($result)) {
                    $formattedDate = date("F j, Y", strtotime($row['date']));
                    echo "<div class='chat-date'><p>{$formattedDate}</p></div>";
                }
            ?>
        </div>
        <div class="convo">
        <?php
        mysqli_data_seek($result, 0);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='chat'>";
            echo "<div class='chat-profile'><img src='data:image/jpeg;base64,{$profileImage}' alt='Profile Image'></div>";
            echo "<div class='chat-message'><p>{$row['messageSender']}</p></div>";
            echo "</div>";

            // Check if the message has a receiver
            if (!empty($row['messageReceiver'])) {
                echo "<div class='reply'>";
                echo "<div class='reply-message'><p>{$row['messageReceiver']}</p></div>";
                echo "</div>";
            }
        }
        ?>
        </div>
        <div class="send-message-container">
            <input type="text" placeholder="Type your message..." id="send-message-input">
            <button id="send-message-button" title="Send Message">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </main>

</body>
    <script>
        document.getElementById('logo').addEventListener('click', function() {
            window.location.href = '../admin/dashboard.php';
    });

    function toggleNotifications() {
        const notificationDropdownContent = document.querySelector('.notification-dropdown-content');
        notificationDropdownContent.classList.toggle('show');
    }

    document.addEventListener('click', function(event) {
        const notificationDropdownContent = document.querySelector('.notification-dropdown-content');
        const bellIcon = document.querySelector('.fa-bell');

        if (!event.target.matches('.fa-bell') && !event.target.matches('.notification-dropdown-content')) {
            if (notificationDropdownContent.classList.contains('show')) {
                notificationDropdownContent.classList.remove('show');
            }
        }
    });

    var inactivityTimeout = 1000; 

        function checkInactivity() {
            setTimeout(function () {
                window.location.href = '../login.php'; 
            }, inactivityTimeout * 1100);
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

        //message
        document.getElementById('send-message-button').addEventListener('click', function() {
    sendMessage();
});

function sendMessage() {
    const messageInput = document.getElementById('send-message-input');
    const message = messageInput.value.trim();

    if (message !== '') {
        // Use fetch to send the message to the server
        fetch('../backend/send_message.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'message=' + encodeURIComponent(message),
        })
            .then(response => response.json())
            .then(data => handleResponse(data))
            .catch(error => console.error('Error:', error));
    }
    messageInput.value = ''; // Clear the input field
}

function handleResponse(response) {
    if (response.status === 'success') {
        alert(response.message);
        // You can update the UI or reload messages here
    } else {
        alert(response.message);
    }
}

    </script>
</html>