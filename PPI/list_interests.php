<?php
session_start();
if (!isset($_SESSION['loggedIn'])) {
    header("Location: index.php");
    exit ();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>VendaRápido - Anúncios</title>
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/list_interests.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom p-0">
			<div class="container-fluid">
                <div class="d-flex align-items-center">
                    <div class="nav_div me-2">
                        <img src="images/carVectorLogo.png" alt="Imagem da Logo" id="logo">
                    </div>
                    <a class="navbar-brand fs-4 navbar-light text-white" href="index_intern.php">VendaRápida</a>
                </div>
				<button class="navbar-toggler mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item">
                            <a class="nav-link text-white me-3 py-2 px-3 mb-2" href="index_intern.php">Anúncios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white me-3 py-2 px-3 mb-2" href="create_ad.php">Novo Anúncio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white me-3 py-2 px-3 mb-2" href="list_ad.php">Meus Anúncios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white bg-primary rounded-3 px-3 py-2 me-3 mb-2" href="db/logout.php">Desconectar</a>
                        </li>
                    </ul>
                </div>
			</div>
		</nav>

        <main>
            <div class="container p-4">
                <h2>Interesses Registrados</h2>
                <div class="content">
                    <!-- <div class="message-cards">
                        <label class="fw-bold">Nome:</label>
                        <p class="m-0">João Silva</p>
                        <label class="fw-bold">Telefone:</label>
                        <p class="m-0">(11) 91234-5678</p>
                        <div class="message-box">
                            <label>Mensagem:</label>
                            <p>Gostaria de mais informações.</p>
                        </div>
                    </div>
                    <div class="message-cards">
                        <label class="fw-bold">Nome:</label>
                        <p class="m-0">Maria Oliveira</p>
                        <label class="fw-bold">Telefone:</label>
                        <p class="m-0">(21) 99876-5432</p>
                        <div class="message-box">
                            <label>Mensagem:</label>
                            <p>Gostaria de mais informações.</p>
                        </div>
                    </div>
                    <div class="message-cards">
                        <label class="fw-bold">Nome:</label>
                        <p class="m-0">Pedro Santos</p>
                        <label class="fw-bold">Telefone:</label>
                        <p class="m-0">(31) 98765-4321</p>
                        <div class="message-box">
                            <label>Mensagem:</label>
                            <p>O preço está negociável?</p>
                        </div>
                    </div> -->
                </div>
            </div>
        </main>
        <script src="js/list_interests.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>