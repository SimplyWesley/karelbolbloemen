<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require_once("../require/config.php");
require_once("../require/smtp.php");

if (isset($_POST['submit']) || filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    if (isset($_POST['g-recaptcha-response'])) {
        $captcha = $_POST['g-recaptcha-response'];
    }

    if (!$captcha) {
        echo "<script>window.location.href = 'contact?submit=captcha';</script>";
        exit();
    }

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = $smtp_host;
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_username;
    $mail->Password = $smtp_password;
    $mail->SMTPSecure = $smtp_secure;
    $mail->Port = $smtp_port;

    $mail->setFrom($smtp_username);
    $mail->addAddress($smtp_username);
    $mail->Subject = "Contactformulier: " . $subject;
    $mail->Body = $message;

    try {
        $mail->send();
        $query = "INSERT INTO `formlog` (`name`, `email`, `subject`, `message`) VALUES 
                (:name, :email, :subject, :message)";
        $statement = $conn->prepare($query);

        $data = [
            ':name' => $name,
            ':email' => $email,
            ':subject' => $subject,
            ':message' => $message
        ];
        $query_execute = $statement->execute($data);
        header("Location: ../webpages/contact.php?submit=true");
    } catch (Exception $e) {
        header("Location: ../webpages/contact.php?submit=false");
        exit();
    }
}
