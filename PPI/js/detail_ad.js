function getUrlParameter(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

const idAnuncio = getUrlParameter('idAnuncio');

async function fetchAdDetails() {
    try {
        const response = await fetch(`../db/controller.php?action=get_firstAd&idAnuncio=${idAnuncio}`);
        if (!response.ok) throw new Error('Erro ao buscar os dados do anúncio.');

        const data = await response.json();
        return data.length > 0 ? data[0] : null;
    } catch (error) {
        console.error("Erro ao buscar os detalhes do anúncio:", error);
        return null;
    }
}

async function fetchAdImages() {
    try {
        const response = await fetch(`../db/controller.php?action=get_images&idAnuncio=${idAnuncio}`);
        if (!response.ok) throw new Error('Erro ao buscar as imagens do anúncio.');

        const images = await response.json();
        return images;
    } catch (error) {
        console.error("Erro ao buscar as imagens do anúncio:", error);
        return [];
    }
}

function updateAdDetailsHTML(ad) {
    if (ad) {
        document.getElementById('adDetails').innerHTML = `
            <li class="list-group-item"><strong>Marca:</strong> ${ad.marca}</li>
            <li class="list-group-item"><strong>Modelo:</strong> ${ad.modelo}</li>
            <li class="list-group-item"><strong>Ano de Fabricação:</strong> ${ad.ano}</li>
            <li class="list-group-item"><strong>Cor:</strong> ${ad.cor}</li>
            <li class="list-group-item"><strong>Quilometragem:</strong> ${ad.quilometragem} km</li>
            <li class="list-group-item"><strong>Valor:</strong> R$ ${ad.valor}</li>
            <li class="list-group-item"><strong>Descrição:</strong> ${ad.descricao}</li>
            <li class="list-group-item"><strong>Estado:</strong> ${ad.estado}</li>
            <li class="list-group-item"><strong>Cidade:</strong> ${ad.cidade}</li>
        `;
    } else {
        console.error("Erro ao carregar os detalhes do anúncio.");
    }
}

function updateAdImagesHTML(images) {
    const carouselImages = document.getElementById('carouselImages');
    if (carouselImages) {
        carouselImages.innerHTML = '';

        images.forEach((img, index) => {
            const isActive = index === 0 ? 'active' : '';
            const carouselItem = `
                <div class="carousel-item ${isActive}">
                    <img src="${img.nomeArqFoto}" class="d-block w-100" alt="Imagem do anúncio">
                </div>
            `;
            carouselImages.innerHTML += carouselItem;
        });
    }
}

async function loadAdDetailsAndImages() {
    const ad = await fetchAdDetails();
    updateAdDetailsHTML(ad);

    const images = await fetchAdImages();
    console.log(images);
    updateAdImagesHTML(images);
}

loadAdDetailsAndImages();