<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["feedbackIDs"])) {
    include '../backend/dbcon.php';

    $feedbackIDs = $_POST["feedbackIDs"];

    foreach ($feedbackIDs as $feedbackID) {
        // Fetch the user's name before deleting the feedback
        $getNameQuery = "SELECT client.firstname FROM feedback
                         INNER JOIN client ON feedback.clientID = client.id
                         WHERE feedbackID = $feedbackID";

        $nameResult = mysqli_query($conn, $getNameQuery);

        if ($nameResult) {
            $row = mysqli_fetch_assoc($nameResult);
            $userName = $row['firstname'];
        }

        // Delete the feedback
        $deleteQuery = "DELETE FROM feedback WHERE feedbackID = $feedbackID";
        mysqli_query($conn, $deleteQuery);
        
        // Display an alert directly in the HTML document
        echo "<script>alert('$userName was successfully deleted');</script>";
    }

    header("Location: ../admin/feedback.php");
    exit();
}
?>