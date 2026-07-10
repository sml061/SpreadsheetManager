<?php

    session_start();

    require_once("../config/database.php");

    $usuario = $_POST["nome"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":usuario", $usuario);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($senha, $user['senha'])) {

        $_SESSION["id"] = $user["id"];
        $_SESSION["usuario"] = $user["usuario"];
        $_SESSION["is_admin"] = $user["is_admin"];

        header("Location: ../DashBoard/");
        exit();
    }

    header("Location: ../login/?error=invalid_credentials");
    exit();