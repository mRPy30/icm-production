<?php
include '../backend/dbcon.php';
session_start();
$clientID = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clientFirstname = isset($_POST["firstName"]) ? $_POST["firstName"] : "";
    $clientLastname = isset($_POST["lastName"]) ? $_POST["lastName"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $confirmPassword = isset($_POST["confirm_password"]) ? $_POST["confirm_password"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

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
    $updateQuery = "UPDATE client SET firstName = ?, lastName = ?, email = ?, confirmPass = ?, password = ?";

    // Only include profile column in the update query if profilePicture is set
    if (isset($profilePicture)) {
        $updateQuery .= ", profile = ?";
    }

    $updateQuery .= " WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);

    // Adjust bind_param based on whether profilePicture is set or not
    if (isset($profilePicture)) {
        $stmt->bind_param("ssssssi", $clientFirstname, $clientLastname, $email, $confirmPassword, $password, $profilePicture, $clientID);
    } else {
        $stmt->bind_param("sssssi", $clientFirstname, $clientLastname, $email, $confirmPassword, $password, $clientID);
    }

    if ($stmt->execute()) {
        echo '<script>alert("User Account updated successfully."); 
        window.location.href = "../client/profile.php";</script>';
        exit(); // Terminate further execution
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
