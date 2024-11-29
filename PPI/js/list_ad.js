async function loadCards() {
    try {
        const response = await fetch("../db/controller.php?action=list_ad", { 
            method: 'get'
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

async function deleteCard(idAnuncio) {
    try {
        const response = await fetch(`../db/controller.php?action=delete_ad&idAnuncio=${idAnuncio}`, {
            method: "GET"
        });

        if (!response.ok) {
            throw new Error(`Erro na requisicao: ${response.statusText}`);
        }

        const data = await response.json();

        if (data.success) {
            console.log("Anuncio excluido");

            const button = document.querySelector(`.close-button[data-ad-id="${idAnuncio}"]`);
            if (button) {
                const adDiv = button.closest(".card"); // Seleciona a div pai com a classe "card"
                if (adDiv) {
                    adDiv.remove();
                }
            }
        } 
        else {
            console.error("Falha ao excluir o anuncio:", data.message);
        }
    } 
    catch (error) {
        console.error("Erro ao tentar excluir o anuncio:", error);
    }
}

function seeDetails(idAnuncio){
    window.location.href = `../detail_ad.php?idAnuncio=${idAnuncio}`;
}

document.addEventListener("DOMContentLoaded", async function () {

    const list_ad = await loadCards();

    if (list_ad == null) return;

    const container = document.querySelector(".container");

    for (let ad of list_ad) {  
        img = await loadImage(ad.id);
        // Criação do botão de exclusão
        const button = document.createElement("button"); button.className = "close-button"; button.setAttribute("data-ad-id", ad.id); button.type = "button"; button.setAttribute("data-bs-toggle", "modal"); button.setAttribute("data-bs-target", "#DeleteModal");
        // Criação da imagem dentro do botão
        const img1 = document.createElement("img"); img1.src = "images/trash-svgrepo-com.svg"; img1.className = "icon"; img1.alt = "Imagem Carro";
        // Criação da div de botões "Interesses" e "Detalhes"
        const cardButtons = document.createElement("div"); cardButtons.className = "card_buttons";
        // Criação do botão de "Interesses"
        const btnInterest = document.createElement("button"); btnInterest.className = "interest"; btnInterest.textContent = "Interesses"; 

        btnInterest.onclick = function() {
            window.location = "list_interests.php?idAnuncio=" + ad.id;
        };

        const btnDetails = document.createElement("button"); btnDetails.className = "details mb-0"; btnDetails.textContent = "Detalhes"; btnDetails.setAttribute("data-ad-id", ad.id)

        const img2 = document.createElement("img"); img2.src = img.nomeArqFoto;
        const p1 = document.createElement("p"); p1.textContent = ad.modelo; p1.className="model mb-1";
        const p2 = document.createElement("p"); p2.textContent = ad.marca; p2.className="brand";
        const p3 = document.createElement("p"); p3.textContent =  "R$ " + ad.valor; p3.className="price";
        const p4 = document.createElement("p"); p4.textContent = ad.ano; p4.className="year mb-1";
        const p5 = document.createElement("p"); p5.textContent = ad.cidade; p5.className="city mb-2";

        const div = document.createElement("div");
        div.className = "card p-3";
        
        button.appendChild(img1);
        cardButtons.appendChild(btnInterest);
        cardButtons.appendChild(btnDetails);
        div.appendChild(button); 
        div.appendChild(img2);
        div.appendChild(p1);
        div.appendChild(p2);
        div.appendChild(p3);
        div.appendChild(p4);
        div.appendChild(p5);
        div.appendChild(cardButtons);

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
    
    var cardId;

    const deleteCardButton = document.querySelectorAll('.close-button');
    deleteCardButton.forEach (button => {
        button.addEventListener('click', function(){
            cardId = button.getAttribute("data-ad-id");
        })
    })

    document.querySelector("#deleteButtonAd").addEventListener("click", function() {
        deleteCard(cardId);
    });

    const detailCardButton = document.querySelectorAll('.details');
    detailCardButton.forEach (button => {
        button.addEventListener('click', function(){
            cardId = button.getAttribute("data-ad-id");
            seeDetails(cardId);
        })
    })
});

