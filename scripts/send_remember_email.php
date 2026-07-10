<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/email.php";
require_once __DIR__ . "/../config/database.php";



if (!isset($_POST["email"])) {
    header("Location: ../login/");
    exit();
    }
    
$email = $_POST["email"];

$sql = "SELECT * FROM usuarios WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":email", $email);
$stmt->execute();
$check_result = $stmt->fetch(PDO::FETCH_ASSOC);

if (!isset($check_result) || $check_result["email"] != $email) {
    header("Location: ../remember/?error=user_not_found");
    exit();
}

$usuario = $check_result["usuario"];


$emailAlteracaoSenha = '
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Alteração de Senha</title>
</head>

<body style="margin:0; padding:0; background:#f4f4f4; font-family:Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4; padding:40px 0;">
    <tr>
        <td align="center">

            <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:8px; overflow:hidden;">

                <tr>
                    <td style="background:#0d6efd; padding:25px; text-align:center;">
                        <h1 style="margin:0; color:#ffffff;">
                            Alteração de Senha
                        </h1>
                    </td>
                </tr>

                <tr>
                    <td style="padding:40px; color:#333333; font-size:16px; line-height:1.6;">

                        <p>Olá, <strong>' . htmlspecialchars($usuario) . '</strong>.</p>

                        <p>
                            Recebemos uma solicitação para alterar a senha da sua conta.
                        </p>

                        <p>
                            Para criar uma nova senha, clique no botão abaixo:
                        </p>

                        <p style="text-align:center; margin:35px 0;">
                            <a href="localhost/SpreadsheetManager/remember/verify.php?nome=' . $usuario . '"
                               style="
                               background:#0d6efd;
                               color:#ffffff;
                               text-decoration:none;
                               padding:14px 28px;
                               border-radius:5px;
                               display:inline-block;
                               font-weight:bold;">
                                Alterar Senha
                            </a>
                        </p>

                        <p>
                            Caso você não tenha solicitado essa alteração, ignore este e-mail.
                            Sua senha continuará a mesma.
                        </p>

                    </td>
                </tr>

                <tr>
                    <td style="background:#f8f9fa; padding:20px; text-align:center; color:#777; font-size:12px;">
                        Este é um e-mail automático. Não responda esta mensagem.
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>
';

sendEmail($email, $usuario, "No Reply", $emailAlteracaoSenha);

header("Location: ../login/");