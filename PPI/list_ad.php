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
        <link rel="stylesheet" href="css/list_ad.css">
        <link rel="stylesheet" href="css/index.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Você tem certeza que deseja deletar este anúncio?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="deleteButtonAd" data-bs-dismiss="modal">Excluir Anúncio</button>
                </div>
                </div>
            </div>
        </div>

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
            <div class="container">
                    
            </div>
            <div>
                <p id="list_adFailMsg" class="hide"></p>
            </div>
        </main>
        <script src="js/list_ad.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>