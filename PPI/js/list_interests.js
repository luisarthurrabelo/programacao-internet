
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const idAnuncio = urlParams.get('idAnuncio');
    fetchInterestedUsers(idAnuncio);
};

async function fetchInterestedUsers(idAnuncio) {
    try {
        const response = await fetch(`../db/controller.php?action=getInterestsAd&idAnuncio=${idAnuncio}`);
        if (!response.ok) throw new Error('Erro ao buscar interessados.');

        const interestedUsers = await response.json();
        updateInterestedUsersHTML(interestedUsers);
    } catch (e) {
        console.log(interestedUsers);

    }
}

function updateInterestedUsersHTML(users) {
    const contentDiv = document.querySelector('.content');
    contentDiv.innerHTML = '';

    users.forEach(user => {
        const userCard = `
            <div class="message-cards">
                <label class="fw-bold">Nome:</label>
                <p class="m-0">${user.nome}</p>
                <label class="fw-bold">Telefone:</label>
                <p class="m-0">${user.telefone}</p>
                <div class="message-box">
                    <label>Mensagem:</label>
                    <p>${user.mensagem}</p>
                </div>
            </div>
        `;
        contentDiv.insertAdjacentHTML('beforeend', userCard);
    });
}

