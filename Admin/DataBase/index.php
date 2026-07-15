<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/../../config/config.php");
require_once(__DIR__ . "/../../scripts/auth.php");
require_once(__DIR__ . "/../../config/database.php");
require_once(__DIR__ . "/../../scripts/auth_admin.php");

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Base</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <div class="header">
        <div class="header-title">Data Base</div>
        <div class="header-buttons">
            <a href="../" class="btn">Admin</a>
            <a href="../../DashBoard/" class="btn">Dash Board</a>
            <a href="../../scripts/logout.php" class="btn btn-secondary">Log out</a>
        </div>
    </div>
    <div class="content">
        <h2>Data Base</h2>

        <div class="card">
            <div class="card-header">
                <span>Estatísticas do Banco de Dados</span>
            </div>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value" id="totalTables">-</div>
                    <div class="stat-label">Tabelas</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value" id="totalRecords">-</div>
                    <div class="stat-label">Registros</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value" id="dbSize">-</div>
                    <div class="stat-label">Tamanho DB</div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <span>Tabelas do Sistema</span>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome da Tabela</th>
                        <th>Registros</th>
                        <th>Tamanho</th>
                        <th>Última Atualização</th>
                    </tr>
                </thead>
                <tbody id="tablesBody">
                    <tr>
                        <td id='NomeTabela'>usuarios</td>
                        <td id=''>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card">
            <div class="card-header">
                <span>Ações do Banco de Dados</span>
            </div>
            <div class="actions-grid">
                <button id="backupButton" class="btn btn-primary" type="button">
                    Fazer BackUp
                </button>
                <button id="optimizeButton" class="btn btn-success" type="button">
                    Otimizar Banco
                </button>
                <button id="checkButton" class="btn btn-secondary" type="button">
                    Verificar Integridade
                </button>
            </div>
            <div id="actionResult" class="mt-2"></div>
        </div>
    </div>

    <script src="script/script.js"></script>
    
</body>
</html>