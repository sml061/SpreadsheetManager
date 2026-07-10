<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . "/../config/database.php";

if (!isset($_SESSION["id"])) {
    header("Location: ../login/");
    exit();
}

if (!isset($_SESSION["usuario"])) {
    header("../login/");
    exit();
}

$sql = "SELECT * FROM usuarios WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":id", $_SESSION["id"]);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt->closeCursor();

$UserID = $user["id"];
$UserName = $user["usuario"];
$UserEmail = $user["email"];
$UserActive = $user["ativo"];
$UltimoLogin = $user["ultimo_login"];

if ($UserActive != 1) {
    header("Location: /SpreadsheetManager/login/?error=account_inactive");
    exit();
}