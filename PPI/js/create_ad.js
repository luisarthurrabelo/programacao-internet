async function sendForm(form) {
    try {
        const response = await fetch("../db/controller.php?action=create_ad", { 
            method: 'post', 
            body: new FormData(form) 
        });

        if (!response.ok) {
            console.log("Error");
            throw new Error(response.statusText);
        }

        const AdResult = await response.json();

        if (!AdResult.success) {
            const parFailMsg = document.querySelector("#AdFailMsg");
            parFailMsg.textContent = AdResult.message;
            parFailMsg.classList.remove('hide');
        }else{
            window.location.reload();
        }
    }
    catch (e) {
        const parFailMsg = document.querySelector("#AdFailMsg");
        parFailMsg.textContent = e.message;
        parFailMsg.classList.remove('hide');
    }
}

const meuForm = document.forms.formAd;
meuForm.onsubmit = function (e) {
    e.preventDefault();
    sendForm(meuForm);
}