<?php
include '../backend/dbcon.php';
session_start();
$adminID = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $confirmPassword = $_POST["confirm_password"];
    $password = $_POST["password"];

    // Check if any file is uploaded
    if ($_FILES['picture']['size'] > 0) {
        $profilePicture = file_get_contents($_FILES['picture']['tmp_name']);


        // Check the file size
        $maxFileSize = 40 * 1024 * 1024; // 40 MiB in bytes
        if ($_FILES["picture"]["size"] > $maxFileSize) {
            echo "Sorry, your file is too large. Max: 40 MiB.";
            exit(); // Terminate further execution
        }

        // Check if the file is an image
        $imageFileType = strtolower(pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION));
        $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedExtensions)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            exit(); // Terminate further execution
        }
    }

    // Update name, email, and profile picture in the database
    if (isset($profilePicture)) {
        $updateQuery = "UPDATE administrator SET name = ?, email = ?, confirmPass = ?, password = ?, profile = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("sssssi", $name, $email, $confirmPassword, $password, $profilePicture, $adminID);
    } else {
        // Update name, email, password, and confirm_password in the database
        $updateQuery = "UPDATE administrator SET name = ?, email = ?, confirmPass = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ssssi", $name, $email, $confirmPassword, $password, $adminID);
    }

    if ($stmt->execute()) {
        echo '<script>alert("Admin Account updated successfully."); 
        window.location.href = "../admin/account.php";</script>';
        exit(); // Terminate further execution
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
