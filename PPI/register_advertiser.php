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
        <title>VendaRápida - Mensagem de Interesse</title>
        <link rel="stylesheet" href="css/auth_forms.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <header>
            <h1>VendaRápida</h1>
        </header>
        <main>
            <div class="register-container">
                <form name="formRegister" method="post" class="cadastro-form">
                    <h2>Preencha seus dados</h2>
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input type="text" id="cpf" name="cpf" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" id="senha" name="senha" required>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="tel" id="telefone" name="telefone" required>
                    </div>
                    <button type="submit" id="submit">Cadastrar</button>
                    <div>
                        <p id="registerFailMsg" class="hide"></p>
                    </div>
                </form>
            </div>
            <button class="back-button">Voltar</button>
        </main>
        <script src="js/register_advertiser.js"></script>
    </body>
</html>