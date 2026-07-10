<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/auth.php";

$sql = "SELECT * FROM usuarios WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":id", $_SESSION["id"]);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt->closeCursor();

$IsAdmin = $user["is_admin"];

if ($IsAdmin != 1) {
    header("Location: /SpreadsheetManager/DashBoard/");
    exit();
}