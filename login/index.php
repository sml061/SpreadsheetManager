<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Login</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="container">
            <h1>Login</h1>
            <?php if(isset($_GET['error'])): ?>
                <?php if($_GET['error'] == 'invalid_credentials'): ?>
                    <div class="error">Usuário ou senha inválidos!</div>
                <?php endif; ?>
                <?php if($_GET['error'] == 'account_inactive'): ?>
                    <div class="error">Sua conta está inativa. Por favor, entre em contato com o suporte.</div>
                <?php endif; ?>
            <?php endif; ?>
            <form method="POST" action="../scripts/login.php">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <div class="input-group">
                        <span class="input-group-icon">👤</span>
                        <input type="text" id="nome" name="nome" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <div class="input-group">
                        <span class="input-group-icon">🔒</span>
                        <input type="password" name="senha" id="senha" required>
                    </div>
                </div>
                <button type="submit">Entrar</button>
                <div class="links">
                    <label for="register">Não tem conta? <a id="register" href="../register/">Cadastre-se</a></label>
                    <label for="remember">Não lembra a senha? <a id="remember" href="../remember/">Recuperar</a></label>
                </div>
            </form>
        </div>
    </body>
</html>