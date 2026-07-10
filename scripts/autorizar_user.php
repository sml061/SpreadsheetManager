<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once("../config/database.php");
require_once( __DIR__ . "/auth_admin.php");



if (isset($_POST["search"])) {

    $campo = "usuario";
    $valor = $_POST["search"];

} elseif (isset($_GET["id"])) {

    $campo = "id";
    $valor = $_GET["id"];

} else {

    header("Location: ../Admin/?error=GET-nao-enviado");
    exit();
}

$sql = "SELECT usuario, is_admin, ativo FROM usuarios WHERE $campo = :valor";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":valor", $valor);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: ../Admin/?error=user_not_found");
    exit();
}

$novoStatus = $user["ativo"] ? 0 : 1;

$sql = "UPDATE usuarios SET ativo = :ativo WHERE $campo = :valor";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ":ativo" => $novoStatus,
    ":valor" => $valor
]);

header("Location: ../Admin/Usuario/?nome=" . urlencode($user["usuario"]) . "&success=1");
exit();