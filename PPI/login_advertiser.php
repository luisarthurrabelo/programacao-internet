<?php
session_start();
if (isset($_SESSION['loggedIn'])) {
    header("Location: index_intern.php");
    exit ();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>VendaRápida - Login</title>
        <link rel="stylesheet" href="css/auth_forms.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <header>
            <h1>VendaRápida</h1>
        </header>
        <main>
            <div class="login-container">
                <form name="formLogin" class="login-form">
                    <h2>Login</h2>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" id="senha" name="senha" required>
                    </div>

                    <button type="submit">Entrar</button>

                    <div>
                        <p id="loginFailMsg" class="hide"></p>
                    </div>
                </form>
            </div>
            <button class="back-button">Voltar</button>
        </main>
        <script src="js/login_advertiser.js"></script>
    </body>
</html>