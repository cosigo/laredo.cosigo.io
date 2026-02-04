<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../../_config/mail.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(403);
    exit("Forbidden");
}

$name    = trim($_POST["name"] ?? "");
$email   = trim($_POST["email"] ?? "");
$subject = trim($_POST["subject"] ?? "");
$message = trim($_POST["message"] ?? "");

if (!$name || !$email || !$subject || !$message) {
    exit("Missing required fields.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Invalid email address.");
}

try {
    $mail = cosigo_mailer();

    $mail->setFrom('sales@cosigo.io', 'Cosigo Laredo');
    $mail->addAddress('sales@cosigo.io');   // or laredo@cosigo.io
    $mail->addReplyTo($email, $name);

    $mail->Subject = "[Cosigo Laredo] " . $subject;
    $mail->Body =
        "Satellite: Laredo\n\n" .
        "Name: $name\n" .
        "Email: $email\n\n" .
        $message;

    $mail->send();

    echo "OK";

} catch (Exception $e) {
    error_log("Laredo mail error: " . $e->getMessage());
    http_response_code(500);
    echo "Mail delivery failed.";
}
