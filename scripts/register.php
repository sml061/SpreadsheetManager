<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once("../config/database.php");


if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit("Método inválido.");
}

$email = $_POST["email"];
$usuario = $_POST["nome"];
$senha = $_POST["senha"];
$confirmar_senha = $_POST["confirmar_senha"];

// Verify the password  extenssion
if (strlen($senha) < 6) {
    header("Location: ../register/?error=short_password");
    exit();
}

// Hash the password for security
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

// Check if user already exists
$check_sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
$check_stmt = $pdo->prepare($check_sql);
$check_stmt->bindValue(":usuario", $usuario);
$check_stmt->execute();

if ($check_stmt->fetch(PDO::FETCH_ASSOC)) {
    // User already exists
    header("Location: ../register/?error=username_exists");
    exit;
} elseif ($senha !== $confirmar_senha) {
    // Passwords do not match
    header("Location: ../register/?error=password_mismatch");
    exit;
}

// Insert new user
try {
    $sql = "INSERT INTO usuarios (usuario, senha, email) VALUES (:usuario, :senha, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":usuario", $usuario);
    $stmt->bindValue(":senha", $senha_hash);
    $stmt->bindValue(":email", $email);
    $stmt->execute();
} catch (PDOException $e) {
    header("Location: ../register/?error=db_error");
    exit();
}

$_SESSION["mensagem"] = "Cadastro realizado com sucesso! Faça login.";
header("Location: ../login/");
exit;
