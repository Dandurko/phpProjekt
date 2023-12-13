<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../mail/phpmailer/src/Exception.php';
require '../mail/phpmailer/src/PHPMailer.php';
require '../mail/phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'example0771@gmail.com'; // Your gmail
$mail->Password = 'zkof cylo kcyw dpyq'; // Your gmail app password
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->setFrom('example0771@gmail.com'); // Your gmail
$mail->addAddress("example0771@gmail.com");

$mail->isHTML (true);
$mail->Subject = "bengoro";
 $mail->Body = "bengoro";
$mail->send();
?>