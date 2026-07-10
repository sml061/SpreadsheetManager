<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../scripts/auth.php");
require_once("../config/database.php");

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .header {
            background-color: #333;
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .header-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #545b62;
        }

        .content {
            padding: 2rem;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="header-title">Meu Dashboard</div>
        <div class="header-buttons">
            <?php 
            if ($_SESSION["is_admin"] == 1) {
                echo "<a href='../Admin/' class='btn'>Admin Painel</a>";
            }
            ?>
            <a href="../scripts/logout.php" class="btn btn-secondary">Log out</a>
        </div>
    </div>
    <div class="content">
        <h2>Bem-vindo ao Dashboard</h2>
        <p>Este é o conteúdo principal do dashboard. Você pode adicionar mais funcionalidades aqui.</p>
        <?php
        if (($_GET["error"] ?? '') === "admin_cannot_be_authorized") {
            echo "<label style='color:red;'>O usuário administrador não pode ser autorizado.</label>";
        }
        ?>       
    </div>
</body>

</html>