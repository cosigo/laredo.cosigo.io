<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../lib/PHPMailer-master/src/Exception.php';
require __DIR__ . '/../lib/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/../lib/PHPMailer-master/src/SMTP.php';

function cosigo_mailer(): PHPMailer {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host       = 'cosigo.io';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'sales@cosigo.io';
    $mail->Password   = 'gr5an5lCSG';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    $mail->CharSet = 'UTF-8';

    return $mail;
}
