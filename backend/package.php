<?php
include 'dbcon.php';

if(isset($_POST['submitPackage'])) {
    $tableName = $_POST['tableName'];
    $packageDetails = $_POST['packageDetails'];
    $packageCategory = $_POST['packageCategory'];
    $packageName = $_POST['packageName'];
    $packagePrice = formatAmountForDatabase($_POST['packagePrice']);

    $sql= "INSERT INTO package (packageDetails, packageCategory, packageName, packagePrice) 
    VALUES ('$packageDetails', '$packageCategory', '$packageName', '$packagePrice')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin/finance.php"); 
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if(isset($_POST['delete'])) {
    $packageId = $_POST['packageId'];

    $deleteSql = "DELETE FROM package WHERE packageId = '$packageId'";

    if ($conn->query($deleteSql) === TRUE) {
        header("Location: ../admin/finance.php"); 
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

if (isset($_POST['edit'])) {
    $packageId = $_POST['packageId'];

    // Assuming you have a function to retrieve package details by ID
    $editSql = "SELECT * FROM package WHERE packageId = '$packageId'";
    $editResult = $conn->query($editSql);

    if ($editResult->num_rows > 0) {
        $editRow = $editResult->fetch_assoc();

        // Populate the fields in your form with the retrieved data
        echo json_encode($editRow);
        exit();
    } else {
        echo "Error retrieving record: " . $conn->error;
        exit();
    }
}

if (isset($_POST['updatePackage'])) {
    $packageId = $_POST['packageId'];
    $packageDetails = $_POST['packageDetails'];
    $packageCategory = $_POST['packageCategory'];
    $packageName = $_POST['packageName'];
    $packagePrice = formatAmountForDatabase($_POST['packagePrice']);

    $updateSql = "UPDATE package SET 
                  packageDetails = '$packageDetails',
                  packageCategory = '$packageCategory',
                  packageName = '$packageName',
                  packagePrice = '$packagePrice'
                  WHERE packageId = '$packageId'";

    if ($conn->query($updateSql) === TRUE) {
        header("Location: ../admin/finance.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
        exit();
    }
}

$conn->close();
function formatAmountForDatabase($amount) {
    // Remove currency symbol and comma
    return floatval(str_replace(['₱', ','], '', $amount));
}
?>
