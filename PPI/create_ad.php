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
        <title>VendaRápida - Publicar Anúncio</title>
        <link rel="stylesheet" href="css/create_ad.css">
        <link rel="stylesheet" href="css/index.css">
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
            <div class="container mt-4 p-4 anuncio-container">
                <h2>Criar Anúncio de Veículo</h2>
                <form name="formAd" method="POST" enctype="multipart/form-data">
                    <div class="row form-group">
                        <div class="col-md">
                            <label for="marca">Marca do Veículo</label>
                            <input type="text" class="form-control" id="marca" name="marca" required>
                        </div>
                        <div class="col-md">
                            <label for="modelo">Modelo</label>
                            <input type="text" class="form-control" id="modelo" name="modelo" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm">
                            <label for="ano">Ano de Fabricação</label>
                            <input type="number" class="form-control" id="ano" name="ano" min="1900" max="2024" required>
                        </div>
                        <div class="col-sm">
                            <label for="cor">Cor</label>
                            <input type="text" class="form-control" id="cor" name="cor" required>
                        </div>
                        <div class="col-sm">
                            <label for="quilometragem">Quilometragem (km)</label>
                            <input type="number" class="form-control" id="quilometragem" name="quilometragem" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="valor">Valor (R$)</label>
                        <input type="number" class="form-control" id="valor" name="valor" required>
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3" required ></textarea>
                    </div>

                    <div class="row form-group">
                        <div class="col-md">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado" name="estado" required>
                            <option value="">Escolha um estado...</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                        </div>
                        <div class="col-md">
                            <label for="cidade">Cidade</label>
                            <input type="text" class="form-control" id="cidade" name="cidade" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="formFileMultiple" class="form-label">Fotos do Veículo</label>
                        <input class="form-control" type="file" id="formFileMultiple" name="fotos[]" accept="image/*" multiple required>
                        <small class="form-text text-muted">Por favor, envie pelo menos três fotos.</small>
                    </div>
                    <div class="text-center">
                        <p id="AdFailMsg" class="hide"></p>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary">Criar Anúncio</button>
                    </div>
                </form>
            </div>

        </main>
        <script src="js/create_ad.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>