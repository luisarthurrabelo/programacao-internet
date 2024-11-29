const button = document.querySelector(".back-button");

button.onclick = function () {
    window.location = "index.php";
}

window.onload = function() {
    // Captura o parâmetro 'idAnuncio' da URL
    const urlParams = new URLSearchParams(window.location.search);
    const idAnuncio = urlParams.get('idAnuncio');
    console.log(idAnuncio);

    // Verifica se o id foi passado e cria um campo oculto para enviá-lo no formulário
    if (idAnuncio) {
        const form = document.getElementById('meuForm');
        const idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'idAnuncio';
        idInput.value = idAnuncio;
        form.appendChild(idInput);
    }
};