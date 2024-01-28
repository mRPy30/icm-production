<?php
// Connection
include '../backend/dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form is submitted

    // Handle content insertion
    if (isset($_POST['tableName']) && $_POST['tableName'] == 'content') {
        // Get values from the form
        $pictureName = mysqli_real_escape_string($conn, $_POST['pictureName']);
        $postedPage = mysqli_real_escape_string($conn, $_POST['postedPage']);
        $image = $_FILES['image']['name']; // Assuming you have an input field with name 'image'

        // Get the current date and time
        $datePosted = date("Y-m-d H:i:s");

        // Insert data into the content table
        $insertQuery = "INSERT INTO content (pictureName, postedPage, datePosted, picture) VALUES ('$pictureName', '$postedPage', '$datePosted', '$image')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if (!$insertResult) {
            die("Insert query failed: " . mysqli_error($conn));
        }

        // Upload the image file to a directory (you need to handle this part based on your server configuration)
        $targetDirectory = "path/to/your/upload/directory/";
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);

        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

        // Redirect back to "../admin/content.php" after successful insert
        header("Location: ../admin/content.php");
        exit();
    }

    // Handle content deletion
    if (isset($_POST['deleteContent'])) {
        // Get the pictureID from POST data
        $pictureID = mysqli_real_escape_string($conn, $_POST['pictureID']);

        // Perform the deletion query
        $deleteQuery = "DELETE FROM content WHERE pictureID = '$pictureID'";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if ($deleteResult) {
            // Deletion successful
            echo json_encode(['status' => 'success']);
            exit();
        } else {
            // Deletion failed
            echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
            exit();
        }
    }
}
?>
