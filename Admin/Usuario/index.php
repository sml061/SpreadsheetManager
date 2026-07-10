<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/../../scripts/auth.php");
require_once(__DIR__ . "/../../config/database.php");
require_once(__DIR__ . "/../../scripts/auth_admin.php");

$sql = "SELECT * FROM usuarios WHERE usuario = :nome";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':nome', $_GET["nome"], PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


if (!isset($_GET["nome"])) {
    header("Location: /LoginSystem/Admin/?error=user_not_found");
    exit();
}

if (empty($result)) {
    header("Location: /LoginSystem/Admin/?error=user_not_found");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Additional styles for the profile card */
        .profile-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-top: 2rem;
        }

        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2.5rem 2rem;
            text-align: center;
            position: relative;
        }

        .avatar {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2.5rem;
            font-weight: bold;
        }

        .profile-info h1 {
            margin: 0 0 0.5rem;
            font-size: 2rem;
        }

        .profile-info .user-id {
            opacity: 0.9;
            font-size: 1.1rem;
            margin: 0 0 1.5rem;
        }

        .profile-info .user-bio {
            opacity: 0.8;
            font-size: 1rem;
            max-width: 400px;
            margin: 0 auto;
            line-height: 1.5;
        }

        .profile-details {
            padding: 2rem;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .detail-item {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .detail-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .detail-item label {
            display: block;
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .detail-item p {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .status {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            border: none;
        }

        .status:hover {
            cursor: pointer;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .status-inactive {
            background: #f8d7da;
            color: #721c24;
        }

        .profile-actions {
            padding: 2rem;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .btn-excluir {
            background-color: #dc3545;
        }

        .btn-excluir:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .btn-excluir:hover {
            background-color: #c82333;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .profile-header {
                padding: 2rem 1.5rem;
            }

            .avatar {
                width: 80px;
                height: 80px;
                font-size: 2rem;
            }

            .profile-info h1 {
                font-size: 1.5rem;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="header-title">Meu Dashboard</div>
        <div class="header-buttons">
            <a href="https://cyberit.com.br/apps/proxy-usage/" class="btn" target="_blank">Proxy Usage</a>
            <a href="../" class="btn">Admin Painel</a>
            <a href="../../scripts/logout.php" class="btn btn-secondary">Log out</a>
        </div>
    </div>
    <div class="content">
        <?php
        foreach ($result as $user) {
            // Get initials from username (first two letters or first letter of first and last name if applicable)
            $username = $user["usuario"];
            $initials = strtoupper(substr($username, 0, 2));
            if (strlen($username) == 1) {
                $initials = strtoupper(substr($username, 0, 1));
            }
            ?>
            <div class="profile-card">
                <div class="profile-header">
                    <div class="avatar"><?php echo htmlspecialchars($initials); ?></div>
                    <div class="profile-info">
                        <h1 class="username"><?php echo htmlspecialchars($user["usuario"]); ?></h1>
                        <div class="user-id">ID: <?php echo htmlspecialchars($user["id"]); ?></div>
                        <?php if ($user["is_admin"] == 1): ?>
                            <div class="user-bio">Administrador</div>
                        <?php else: ?>
                            <div class="user-bio">Usuário do sistema</div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="profile-details">
                    <div class="details-grid">
                        <div class="detail-item">
                            <label>Email</label>
                            <p><?php echo htmlspecialchars($user["email"]); ?></p>
                        </div>
                        <div class="detail-item">
                            <label>Status da Conta</label>                            
                            <p>
                            <?php if ($user["is_admin"] == 1) {
                                if ($user["ativo"] == 1) {
                                    echo "<span class=\"status status-active\">Ativo</span>";
                                } else {
                                    echo "<span class=\"status status-inactive\">Inativo</span>";
                                }
                            } else {
                                $action = $user["ativo"] == 1 ? "Ativo" : "Inativo";
                                echo "<form method=\"POST\" action=\"../../scripts/autorizar_user.php\">
                                        <input type=\"hidden\" name=\"search\" value=\"" . htmlspecialchars($user["usuario"]) . "\">
                                        <button type=\"submit\" " . ($user["ativo"] == 1 ? "class=\"status status-active\"" : "class=\"status status-inactive\"") . ">$action</button>
                                    </form>";
                            } ?>
                            </p>

                        </div>
                        <!-- Add more details if available in the database -->
                    </div>
                </div>
                <div class="profile-actions">
                    <a href="../" class="btn btn-secondary">Voltar</a>
                    
                    <br>
                    <br>

                    <?php if ($user["id"] == 1): ?>
                        <button class="btn btn-excluir" disabled>Excluir Usuário</button>
                    <?php else: ?> 
                        <form action="../../scripts/excluir_user.php" method="POST">
                            <input type="hidden" name="search" value="<?php echo htmlspecialchars($_GET["nome"]); ?>">
                            <button id="excluir-user" type="submit" class="btn btn-excluir">Excluir Usuário</button>
                        </form>
                    <?php endif; ?>

                </div>
            </div>
            <?php
        }
        ?>
    </div>
    
    <script>
        document.getElementById('excluir-user').addEventListener('click', function(event) {
            event.preventDefault();
            if (confirm('Tem certeza de que deseja excluir este usuário? Esta ação não pode ser desfeita.')) {
                this.closest('form').submit();
            }
        });
    </script>
</body>

</html>