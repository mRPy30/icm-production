<?php
// Connection
session_start();

if (isset($_SESSION['status'])) {
    echo $_SESSION['status'];
    unset($_SESSION['status']);

}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!---WEB TITLE--->
    <link rel="short icon" href="picture/shortcut-logo.png" type="x-icon">
    <title>
        <?php echo "Icsm Production | Login Account"; ?>
    </title>

    <!---CSS--->
    <link rel="stylesheet" href="css/style.css">
    

    <!--CSS FRAMEWORK-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--ICON LINKS-->
    <link rel="stylesheet" href="font-awesome-6/css/all.css">

    <!--FONT LINKS-->
    <link rel="stylesheet" href="css/fonts.css">


</head>

<body>

<div>
    <div class="card-header">
        <h5>Reset Password</h5>
    </div>
    <div class="card-body p-4">
    <form action="password-reset-code.php" method="POST">
        <div form-group mb-3>
            <label>Email Address</label>
            <input type="text" name="email" class="form-control" placeholder="Enter Email Address">
        </div>
        <div class="form-group mb 3">
            <button type="submit" name="password_reset_link" class="btn btn-primary">Send Link to Reset Password</button>
        </div>
        </form>
    </div>

    

</div>

</body>
</html>
