<?php
    if (isset($_POST['submit'])) {

    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!---WEB TITLE--->
    <link rel="short icon" href="logo.jpg" type="x-icon">
    <title><?php echo "Icm Production | Homepage"; ?></title>

    <!---CSS--->
    <link rel="stylesheet" href="style.css">

    <!--CSS FRAMEWORK-->
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>

    <!--ICON LINKS-->
    <script src="https://kit.fontawesome.com/11a4f2cc62.js" crossorigin="anonymous"></script>

    <!--FONT LINKS-->
    <link href="https://fonts.googleapis.com/css2?family=Abel&family=Inter:wght@400;800&family=Poppins:wght@400;500&display=swap" rel="stylesheet">



</head>
<body>


<section class="form-log">
    <div class="container" id="container">
        <div class="box">
            <div class="form-group">
        <div class="form-container sign-up-container">
            <form action="" method="post">
                <!--<h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input type="text" placeholder="Name" />
                <input type="email" placeholder="Email" />
                <input type="password" placeholder="Password" />
                <button>Sign Up</button>-->
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="" method="post">
                    <h1>Sign in</h1>
                    <!--<div class="social-container">
                        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    </div>
                    --<span>or use your account</span>-->
                <div class="row g-3 align-items-center">

                    <div class="col-auto">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="col-auto">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <div class="col-auto">
                            <input type="password" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
                        </div>
                    </div>
                        <a href="#">Forgot your password?</a>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Good Day Costumer!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Create your account now!</h1>
                    <p>Enter your personal details and start to book a event with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>
</section>
<!--
<script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
</script>
    -->
</body>
</html>