<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../config/database.php");



if (!isset($_POST["nome"])) {
    header("Location: ../login/");
    exit();
}

$usuario = $_POST["nome"];

$senha = $_POST["senha"];

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

if (strlen($senha) < 6) {
    header("Location: ../remember/a/?nome=$usuario&&error=password-very-short");
    exit();
}

try {
    $sql = "UPDATE usuarios SET senha = :nova_senha WHERE usuario = :usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":nova_senha", $senha_hash);
    $stmt->bindValue(":usuario", $usuario);
    $stmt->execute();
} catch (PDOException $e) {
    echo "". $e->getMessage() ."";
}

header("Location: ../login/");
exit();
?>