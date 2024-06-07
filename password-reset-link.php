<?php
// Connection
session_start();

include 'backend/dbcon.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function send_password_reset($get_firstName,$get_email,$token)
{
    $mail = new PHPMailer(true);
    //$mail ->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->Username = "icsmcreatives@gmail.com";
    $mail->Password = "eyha aotm sofj bbje";

    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    $mail->setFrom("icsmcreatives@gmail.com","Reset your Password");
    $mail->addAddress($get_email);

    $mail->isHTML(true);
    $mail->Subject = "Reset Password Notification";

    $email_template = "
    <h2>Hello</h2>
    <h3>Here's the reset password link </h3>
    <br/><br/>
    <a href='http://localhost/icm-production/resetpassword.php?token=$token&email=$get_email' style='display: inline-block; padding: 10px 20px; border-radius: 25px; background-color: #1C1C1D; color: white; text-decoration: none; font: normal 500 13px/normal 'Poppins'; border-radius: 5px;'>Click me, To reset your password</a>";
    
    $mail->Body = $email_template;
    $mail->send();

  
}

if (isset($_POST['password_reset_link'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT firstName, email FROM client WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query($conn, $check_email);

    if ($check_email_run) {
        if (mysqli_num_rows($check_email_run) > 0) {
            $row = mysqli_fetch_array($check_email_run);
            $get_name = $row['firstName']; // Change 'name' to 'firstName' if that's the correct column name
            $get_email = $row['email'];

            $update_token = "UPDATE client SET verify_token='$token' WHERE email='$get_email' LIMIT 1";
            $update_token_run = mysqli_query($conn, $update_token);

            if ($update_token_run) {
                send_password_reset($get_name, $get_email, $token);
                $_SESSION['status'] = '<script>alert("We have emailed you a password reset link.");</script>';
                header("Location: forgotpassword.php");
                exit(0);
            } else {
                $_SESSION['status'] = '<script>alert("Something went wrong. #1");</script>';
                header("Location: forgotpassword.php");
                exit(0);
            }
            
        } else {
            $_SESSION['status'] = '<script>alert("Something went wrong. #1");</script>';'<script>alert("Something went wrong. #1");</script>';
            header("Location: forgotpassword.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "Error querying the database.";
        header("Location: forgotpassword.php");
        exit(0);
    }
}


?>