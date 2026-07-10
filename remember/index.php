<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Recuperar</h1>
        <form method="POST" action="../scripts/send_remember_email.php">
            <div class="form-group">
                <label for="email">Email:</label>
                <div class="input-group">
                    <span class="input-group-icon">📧</span>
                    <input type="text" id="email" name="email" required>
                </div>
            </div>
            <button type="submit">Enviar</button>
            <div class="links">
                <label for="register">Voltar para <a id="register" href="../../login/">Login</a></label>
            </div>
        </form>
    </div>
</body>
</html>