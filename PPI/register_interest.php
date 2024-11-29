<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>VendaRápida - Cadastro</title>
        <link rel="stylesheet" href="css/register_interest.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <header>
            <h1>VendaRápida</h1>
        </header>
        <main>
            <div class="container">
                <h1>Deixe sua Mensagem</h1>
                <form id="meuForm" action="db/controller.php?action=register_interest" method="post">
                    <label for="nome">Seu Nome:</label>
                    <input type="text" id="nome" name="nome" required>
            
                    <label for="telefone">Telefone:</label>
                    <input type="tel" id="telefone" name="telefone" required>
            
                    <label for="mensagem">Mensagem de Interesse:</label>
                    <textarea id="mensagem" name="mensagem" rows="4" required></textarea>
            
                    <button type="submit">Enviar Mensagem</button>
                </form>
            </div>
            <button class="back-button">Voltar</button>
        </main>
        <script src="js/register_interest.js"></script>
    </body>
</html>