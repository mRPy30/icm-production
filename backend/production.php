<?php
include '../backend/dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['category'])) {
        $name = $_POST['username'];
        $email = $_POST['email'];
        $category = $_POST['category'];

        if ($category == "Admin") {
            $confirmPassword = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : "";
            $password = isset($_POST['password']) ? $_POST['password'] : "";

            $sqlInsert = "INSERT INTO administrator (name, email, confirmPass, password) VALUES ('$name', '$email', '$confirmPassword', '$password')";
        } else {
            $staffRole = isset($_POST['role']) ? $_POST['role'] : "";
            $sqlInsert = "INSERT INTO staff (name, email, role) VALUES ('$name', '$email', '$staffRole')";
        }

        if ($conn->query($sqlInsert) === TRUE) {
            header("Location: ../admin/production.php");
            exit();
        } else {
            echo "Error: " . $sqlInsert . "<br>" . $conn->error;
        }
    } else {
        echo "Invalid data submitted";
    }
} else {
    echo "Invalid request method";
}
?>
