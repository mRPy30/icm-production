<?php
// Connection
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <!---CSS--->
    <link rel="stylesheet" href="css/style.css">
    

    <!--CSS FRAMEWORK-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--ICON LINKS-->
    <link rel="stylesheet" href="font-awesome-6/css/all.css">

    <!--FONT LINKS-->
    <link rel="stylesheet" href="css/style.css">

    <title>Reset Password</title>

</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form>
            
            
            <label for="newPassword">New Password</label>
            <input type="password" id="newPassword" name="newPassword" placeholder="Enter a new password" required>
            
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your new password" required>
            
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>