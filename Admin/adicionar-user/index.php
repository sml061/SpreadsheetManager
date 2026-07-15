<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../../scripts/auth.php");
require_once("../../scripts/auth_admin.php");

?>

<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Adicionar</title>
        <link rel="stylesheet" href="../../css/style.css">
    </head>
    <body>
        <div class="container">
            <h1>Adicionar</h1>
            <?php if(isset($_GET['error'])): ?>
                <?php if($_GET['error'] == 'username_exists'): ?>
                    <div class="error">Nome de usuário já existe!</div>
                <?php elseif($_GET['error'] == 'db_error'): ?>
                    <div class="error">ID em uso por outro usuario</div>
                <?php endif; ?>
            <?php endif; ?>
            <?php if(isset($_GET['success'])): ?>
                <?php if($_GET['success'] == 'registered'): ?>
                    <div class="success">Cadastro realizado com sucesso! Faça login.</div>
                <?php endif; ?>
            <?php endif; ?>
            <form method="POST" action="../../scripts/adicionar_admin.php">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <div class="input-group">
                        <span class="input-group-icon">👤</span>
                        <input type="text" id="nome" name="nome" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <div class="input-group">
                        <span class="input-group-icon">📧</span>
                        <input type="email" id="email" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <div class="input-group">
                        <span class="input-group-icon">🔒</span>
                        <input type="password" name="senha" id="senha" required>
                    </div>
                    <p id='senha-message'></p>
                </div>
                <div class="opcoes">
                    
                    <label for="admin-check">
                        <input type="hidden" id="admin-check" name="admin-check" value=0>
                        <input type="checkbox" id="admin-check" name="admin-check" value=1>
                        Admin
                    </label>
                        
                
                
                    <label for="ativo-check">
                        <input type="hidden" id="ativo-check" name="ativo-check" value=0>
                        <input type="checkbox" id="ativo-check" name="ativo-check" value=1>
                        Ativo
                    </label>
                    
                </div>

                <input type="number" min="0" placeholder="ID" id="id" name="id">
                <p id="id-error"></p>

                <br>
                <br>

                <button type="submit">Adicionar</button>
                <div class="links">
                    <a id="login" href="../">Voltar</a>
                </div>
            </form>
        </div>

        <script type="module" src="script/script.js"></script>
    </body>
</html>