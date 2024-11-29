<?php
session_start();
if (!isset($_SESSION['loggedIn'])) {
    header("Location: index.php");
    exit ();
}

$idAnuncio = $_GET['idAnuncio'] ?? "";
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>VendaRápido - Detalhes</title>
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/detail_ad.css">
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
            <div class="container mt-4 p-4 detail-container justify-content-center">
                <h2>Detalhes do Anúncio</h2>
        
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" id="carouselImages">
                      <!-- <div class="carousel-item active">
                        <img src="images/anuncio1.jpg" class="d-block w-100" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="images/anuncio2.jpg" class="d-block w-100" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="images/anuncio3.jpg" class="d-block w-100" alt="...">
                      </div> -->
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
        
                <div class="card-details w-100">
                    <div class="card-details-body">
                        <h5 class="card-details-title">Informações do Carro</h5>
                        <ul class="list-group list-group-flush" id="adDetails">
                            <!-- <li class="list-group-item"><strong>Marca:</strong> Toyota</li>
                            <li class="list-group-item"><strong>Modelo:</strong> Corolla</li>
                            <li class="list-group-item"><strong>Ano de Fabricação:</strong> 2020</li>
                            <li class="list-group-item"><strong>Cor:</strong> Prata</li>
                            <li class="list-group-item"><strong>Quilometragem:</strong> 30,000 km</li>
                            <li class="list-group-item"><strong>Valor:</strong> R$ 85.000</li>
                            <li class="list-group-item"><strong>Descrição:</strong> Carro em excelente estado, sempre revisado e com documentação em dia.</li>
                            <li class="list-group-item"><strong>Estado:</strong> São Paulo</li>
                            <li class="list-group-item"><strong>Cidade:</strong> São Paulo</li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="js/detail_ad.js"></script>
    </body>
</html>