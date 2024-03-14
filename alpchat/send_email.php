<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST["authentication_token1"]) && isset($_POST["email"])) {
    $mail = new PHPMailer(true);
    $mail->Host = 'smtp.gmail.com';

    $link = "http://127.0.0.1/alpchat/verify.php?token=" . urlencode($_POST["authentication_token1"]) . "&email=" . urlencode($_POST["email"]); 
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Username = 'alpchatverify@gmail.com';
    $mail->Password = 'gpshzxbyqswxsxjt';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('no-reply@alpchat.com', 'AlpChat');
    $mail->addAddress($_POST["email"]);
    $mail->isHTML(true);
    $mail->Subject = "Verify Your Email Address for AlpChat";
    $mail->Body = "
        <div style='font-family: Arial, sans-serif; background-color: #fafafa; padding: 20px;'>
            <div style='background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);'>
                <h1 style='color: #405de6; font-size: 24px; margin-bottom: 20px;'>Welcome to AlpChat!</h1>
                <p style='font-size: 16px; color: #000000;'>Thank you for signing up. To complete your registration, please click the button below to verify your email address.</p>
                <a href='$link' style='background-color: #405de6; color: #ffffff; text-decoration: none; padding: 10px 20px; border-radius: 5px; display: inline-block; margin-top: 20px;'>Verify Email Address</a>
                <p style='font-size: 14px; color: #888888; margin-top: 20px;'>If you didn't create an account with AlpChat, you can safely ignore this email.</p>
                <p style='font-size: 14px; color: #888888;'>Best regards,<br/>The AlpChat Team</p>
            </div>
        </div>
    ";

    if ($mail->send()) {
        echo "<script>alert('Sent Successfully'); window.location.href = 'index.html';</script>";
    } else {
        echo "<script>alert('Error: ".$mail->ErrorInfo."');</script>";
    }
}
?>
