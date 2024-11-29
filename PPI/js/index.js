// Função para carregar os cartões usando o formulário
async function loadCardsWithForm(meuForm) {
    try {
        const response = await fetch("../db/controller.php?action=index", { 
            method: 'post',
            body: new FormData(meuForm) 
        });
        if (!response.ok) 
            throw new Error(response.statusText);

        const list_adResult = await response.json();
        
        return list_adResult;
    }
    catch (e) {
        const parLoginFailMsg = document.querySelector("#list_adFailMsg");
        parLoginFailMsg.textContent = "Erro Load Card:" + e.message;
        parLoginFailMsg.classList.remove('hide');
    }
}

// Função para carregar os cartões sem o formulário
async function loadCardsWithoutForm() {
    try {
        const response = await fetch("../db/controller.php?action=index", { 
            method: 'post',
        });
        if (!response.ok) 
            throw new Error(response.statusText);

        const list_adResult = await response.json();
        
        return list_adResult;
    }
    catch (e) {
        const parLoginFailMsg = document.querySelector("#list_adFailMsg");
        parLoginFailMsg.textContent = "Erro Load Card:" + e.message;
        parLoginFailMsg.classList.remove('hide');
    }
}

async function loadImage(idAnuncio) {
    try {
        const response = await fetch(`../db/controller.php?action=get_firstImage&idAnuncio=${idAnuncio}`, { 
            method: 'get'
        });

        if (!response.ok) 
            throw new Error(response.statusText);

        const list_adResult = await response.json();
        
        return list_adResult;
    }
    catch (e) {
        const parLoginFailMsg = document.querySelector("#list_adFailMsg");
        parLoginFailMsg.textContent = "Erro Load Image:" + e.message;
        parLoginFailMsg.classList.remove('hide');
    }
}

async function loadPage(list_ad) {
    if (list_ad == null) return;

    const container = document.querySelector(".container");

    if (container) {
        container.innerHTML = "";
    }

    for (let ad of list_ad) {  
        const img = await loadImage(ad.id);
        // Criação do botão de "Interesses"
        const btnInterest = document.createElement("button"); 
        btnInterest.className = "interest mb-0"; 
        btnInterest.textContent = "Tenho Interesse";
        btnInterest.onclick = function() {
            window.location = "register_interest.php?idAnuncio=" + ad.id;
        };

        const img2 = document.createElement("img"); img2.src = img.nomeArqFoto;
        const p1 = document.createElement("p"); p1.textContent = ad.modelo; p1.className="model mb-1";
        const p2 = document.createElement("p"); p2.textContent = ad.marca; p2.className="brand";
        const p3 = document.createElement("p"); p3.textContent = "R$ " + ad.valor; p3.className="price";
        const p4 = document.createElement("p"); p4.textContent = ad.ano; p4.className="year mb-1";
        const p5 = document.createElement("p"); p5.textContent = ad.cidade; p5.className="city mb-2";

        const div = document.createElement("div");
        div.className = "card p-3";
        
        div.appendChild(img2);
        div.appendChild(p1);
        div.appendChild(p2);
        div.appendChild(p3);
        div.appendChild(p4);
        div.appendChild(p5);
        div.appendChild(btnInterest);

        container.appendChild(div);
    }
    if (list_ad.length === 0) {
        const img = document.createElement("img");
        img.src = "../images/notFound.png"
        img.alt = 'Imagem Not Found';
        
        img.style.width = '100%';
        img.style.maxWidth = '600px'; 
        img.style.height = 'auto'; 
        container.appendChild(img);
    }
}

// Funcao para carregar a lista com o formulario
async function loadListWithForm(meuForm) {
    const list_ad = await loadCardsWithForm(meuForm);
    loadPage(list_ad);
}

// Funcao para carregar a lista sem o formulario
async function loadListWithoutForm() {
    const list_ad = await loadCardsWithoutForm();
    loadPage(list_ad);
}

const meuForm = document.forms.formIndex;

meuForm.onsubmit = function (e) {
    e.preventDefault();
    loadListWithForm(meuForm); // Chama a funcao com o formulario
}

document.addEventListener("DOMContentLoaded", function () {
    loadListWithoutForm(); // Chama a funcao sem o formulario
});
