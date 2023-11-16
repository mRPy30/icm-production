<?php
// Connection
include '../backend/dbcon.php';
session_start();
$adminID = $_SESSION['id'];

// Fetch all admin IDs
$adminIds = [];
$sqlAdminIds = "SELECT id FROM administrator";
$resultAdminIds = $conn->query($sqlAdminIds);

if ($resultAdminIds->num_rows > 0) {
    while ($rowAdminIds = $resultAdminIds->fetch_assoc()) {
        $adminIds[] = $rowAdminIds['id'];
    }
}

// Fetch admin data
$sql = "SELECT name, email, profile FROM administrator WHERE id = '$adminID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $email = $row["email"];
    $profile = base64_encode($row["profile"]); // Corrected: Use base64_encode here
} else {
    // Handle the case where no data is found
    $name = "Name Not Found";
    $email = "Email Not Found";
    $profile = "default_profile.jpg"; // Provide a default profile image
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Check which button was clicked
    if ($_POST['submit'] === 'save') {
        // Handle file upload
        if ($_FILES['fileToUpload']['size'] > 0) {
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($targetFile)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                    // Update the database with the new file name or binary data
                    $updateSql = "UPDATE administrator SET profile = '$targetFile' WHERE id = $adminID";
                    if ($conn->query($updateSql) === TRUE) {
                        echo "Profile picture updated successfully.";
                    } else {
                        echo "Error updating profile picture: " . $conn->error;
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }

        // Handle other form data updates
        $newName = $_POST['firstname'];
        $newEmail = $_POST['lastname'];

        // Update the database with the new data
        $updateSql = "UPDATE administrator SET name = '$newName', email = '$newEmail' WHERE id = $adminID";
        if ($conn->query($updateSql) === TRUE) {
            echo "Data updated successfully.";
        } else {
            echo "Error updating data: " . $conn->error;
        }
    } elseif ($_POST['submit'] === 'reset-form') {
        // Reset form logic here
        // You can redirect or reload the page
    }
}

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
        <?php echo "Admin | Profile"; ?>
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
<!----Navbar&Sidebar----->
<?php
include '../admin/navbar.php';
include '../admin/sidebar.php';
?>

<main class="account">
    <div class="account-management">
            <div class="profile">
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']) && $_POST['submit'] === 'save') {
                    // If a file is uploaded, use the uploaded file
                    $uploadedFile = $_FILES["fileToUpload"]["tmp_name"];
                    $profileImage = $uploadedFile ? base64_encode(file_get_contents($uploadedFile)) : $profile;
                } else {
                    // Use the existing profile image
                    $profileImage = $profile;
                }
                ?>
                <img id="profile-image" src="data:image/jpeg;base64,<?php echo $profileImage; ?>" alt="admin image" style="max-width: 15%; max-height: 15%; border-radius: 50%;">
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="fileToUpload" class="add-photo-label">Add new photo +</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" style="display: none;">
                    <input type="submit" value="Upload Photo" name="submit" style="display: none;">
                </form>
                <p>Admin ID: <?php echo $adminID; ?></p>
            </div>
        <form class="form-fillup needs-validation" method="POST" onsubmit="return validateForm()">
            <label>Name</label>
            <input type="text" class="form" placeholder="Enter your Name" name="firstname" value="<?php echo $name; ?>" required>
            <br><br>
            <label>Email</label>
            <input type="text" class="form" placeholder="Enter your Email" name="lastname" value="<?php echo $email; ?>" required>
            <br><br>
            <label>Password</label>
            <input type="password" class="form" placeholder="Enter your Password" name="password" id="password" required oninput="checkPasswordStrength(this)">
            <i class="fa-solid fa-eye-slash" id="password-toggle" onclick="togglePassword()" style="right: 17%; top: 49.9%; position: fixed;"></i>
            <br><br>
            <label>Confirm Password</label>
            <input type="password" class="form" placeholder="Enter your Confirm Password" name="confirm-password" id="confirmpassword" required>
            <br><br>
            <div id="password-strength" class="alert"></div>
            <button class="btn btn-lg btn-block btn-success" type="submit" name="submit" value="save">SAVE CHANGES</button>
            <button class="btn btn-lg btn-block btn-success" type="submit" name="submit" value="reset-form">RESET</button>
        </form>
    </div>
</main>
<script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    document.getElementById('profile-image').src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Trigger the function when a new file is selected
        document.getElementById('fileToUpload').addEventListener('change', function () {
            readURL(this);
        });
    </script>
</body>
</html>
