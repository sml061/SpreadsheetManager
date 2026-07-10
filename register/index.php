<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Cadastre-se</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="container">
            <h1>Cadastre-se</h1>
            <?php if(isset($_GET['error'])): ?>
                <?php if($_GET['error'] == 'username_exists'): ?>
                    <div class="error">Nome de usuário já existe!</div>
                <?php elseif($_GET['error'] == 'password_mismatch'): ?>
                    <div class="error">As senhas não coincidem!</div>
                <?php elseif($_GET['error'] == 'db_error'): ?>
                    <div class="error">Erro ao cadastrar. Tente novamente!</div>
                <?php elseif($_GET['error'] == 'short_password'): ?>
                    <div class="error">Senha muito curta</div>
                <?php endif; ?>
            <?php endif; ?>
            <?php if(isset($_GET['success'])): ?>
                <?php if($_GET['success'] == 'registered'): ?>
                    <div class="success">Cadastro realizado com sucesso! Faça login.</div>
                <?php endif; ?>
            <?php endif; ?>
            <form method="POST" action="../scripts/register.php">
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
                </div>
                <div class="form-group">
                    <label for="confirmar_senha">Confirmar Senha:</label>
                    <div class="input-group">
                        <span class="input-group-icon">🔁</span>
                        <input type="password" name="confirmar_senha" id="confirmar_senha" required>
                    </div>
                </div>
                <button type="submit">Cadastrar</button>
                <div class="links">
                    <label for="login">Já tem conta? <a id="login" href="../login/">Faça login</a></label>
                </div>
            </form>
        </div>
    </body>
</html>