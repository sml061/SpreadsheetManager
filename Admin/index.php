<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../scripts/auth.php");
require_once("../config/database.php");
require_once("../scripts/auth_admin.php");

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="header">
        <div class="header-title">Meu Dashboard</div>
        <div class="header-buttons">
            <a href="../DashBoard/" class="btn">Dash Board</a>
            <a href="../scripts/logout.php" class="btn btn-secondary">Log out</a>
        </div>
    </div>
    <div class="content">
        <h2>Admin Painel</h2>

        <div class="adicionar-user" style="position: relative; left: 94%;">
            <a href="adicionar-user/" class="btn btn-adicionar">Adicionar</a>
        </div>

        <form action="Usuario/" method="GET" class="search-form">
            <div class="form-group">
                <label for="search">Pesquisar usuário:</label>
                <input type="text" id="nome" name="nome" placeholder="Digite o nome do usuário" autocomplete="off">
            </div>
        </form>
        
        <?php
        if (($_GET["error"] ?? '') === "admin_cannot_be_authorized") {
            echo "<div class='error'>O usuário administrador não pode ser alterado.</div>";
        }
        if (($_GET["error"] ?? '') === "user_not_found") {
            echo "<div class='error'>Usuário não encontrado.</div>";
        }
        ?>
        <div class="user-list">
            <ul>
                <?php
                $sql = "SELECT * FROM usuarios";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "
                    <li onclick=\"window.location.href='Usuario/?nome=" . urlencode($user['usuario']) . "'\" style=\"cursor: pointer;\">
                        <div class='user-info'>
                            <strong>ID:</strong> " . htmlspecialchars($user["id"]) . " |
                            <strong>Usuário:</strong> " . htmlspecialchars($user["usuario"]) . " |
                            <strong>Status:</strong> " . ($user["ativo"] == 1 ? "<span style='color:green;'>Ativo</span>" : "<span style='color:red;'>Inativo</span>") . "
                        </div>
                        <div class='user-actions'>
                            <a href='Usuario/?nome=" . $user["usuario"] . "' class='btn btn-secondary' style='padding: 0.3rem 0.6rem; font-size: 0.85rem;'>...</a>
                        </div>
                    </li>";
                }
                $stmt->closeCursor();

                ?>
            </ul>
        </div>
        
    </div>
</body>

</html>