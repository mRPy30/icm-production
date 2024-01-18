<?php
include '../backend/dbcon.php';
session_start();
$clientID = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstName"];
    $lastname = $_POST["lastName"];
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
        $updateQuery = "UPDATE client SET firstName = ?, lastName = ?, email = ?, confirmPass = ?, password = ?, profile = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ssssssi", $firstname, $lastname,  $email, $confirmPassword, $password, $profilePicture, $clientID);
    } else {
        // Update name, email, password, and confirm_password in the database
        $updateQuery = "UPDATE client SET firstName = ?, lastName = ?, email = ?, confirmPass = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("sssssi", $firstname, $lastname, $email, $confirmPassword, $password,  $clientID);
    }

    if ($stmt->execute()) {
        echo '<script>alert("User Profile Account updated successfully."); 
        window.location.href = "../client/profile.php";</script>';
        exit(); // Terminate further execution
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
