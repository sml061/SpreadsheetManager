<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . "/../config/config.php";

function sendEmail($email, $name, $subject, $message)
{
    $mail = new PHPMailer(true);

    try {
        // Configuração SMTP
        $mail->isSMTP();
        $mail->isHTML(true);
        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth = filter_var($_ENV['SMTP_AUTH'], FILTER_VALIDATE_BOOLEAN);
        $mail->Username = $_ENV['SMTP_USERNAME'];
        $mail->Password = $_ENV['SMTP_PASSWORD'];
        $mail->SMTPSecure = $_ENV['SMTP_SECURE'];
        $mail->Port = (int) $_ENV['SMTP_PORT'];

        // Remetente e destinatário
        $mail->setFrom($_ENV['SMTP_USERNAME'], $_ENV['SMTP_NAME']);
        $mail->addAddress($email, $name);

        // Conteúdo
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = strip_tags($message);

        $mail->send();

        return true;
    } catch (Exception $e) {
        error_log($mail->ErrorInfo);
        return false;
    }
}