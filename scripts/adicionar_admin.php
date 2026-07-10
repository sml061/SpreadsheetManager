<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../config/database.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit("Metodo invalido.");
}

$usuario = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$admin_check = $_POST["admin-check"];
$ativo_check = $_POST["ativo-check"];

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$check_sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
$check_stmt = $pdo->prepare($check_sql);
$check_stmt->bindValue(":usuario", $usuario);
$check_stmt->execute();

if ($check_stmt->fetch(PDO::FETCH_ASSOC)) {
    header("Location: ../Admin/adicionar-user/?error=username_exists");
    exit();
}

try {
    $sql = "INSERT INTO usuarios (usuario, senha, email, ativo, is_admin) VALUES (:usuario, :senha, :email, :ativo, :is_admin)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":usuario", $usuario);
    $stmt->bindValue(":email", $email);
    $stmt->bindValue("senha", $senha_hash);
    $stmt->bindValue(":is_admin", $admin_check);
    $stmt->bindValue(":ativo", $ativo_check);
    $stmt->execute();
} catch (PDOException $e) {
    header("Location: ../Admin/adicionar-user/?error=db_error");
    exit();
}

header("Location: ../Admin/?sucess=1");

?>