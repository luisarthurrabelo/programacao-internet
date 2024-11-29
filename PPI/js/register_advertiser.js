const button = document.querySelector(".back-button");

button.onclick = function () {
    window.location = "index.php";
}

async function sendForm(form) {
    try {
        const response = await fetch("../db/controller.php?action=register_advertiser", { 
            method: 'post', 
            body: new FormData(form) 
        });

        if (!response.ok) {
            console.log("Error");
            throw new Error(response.statusText);
        }

        const registerResult = await response.json();

        if (!registerResult.success) {
            const parFailMsg = document.querySelector("#registerFailMsg");
            parFailMsg.textContent = registerResult.message;
            parFailMsg.classList.remove('hide');
            form.senha.focus();
        }
    }
    catch (e) {
        const parFailMsg = document.querySelector("#registerFailMsg");
        parFailMsg.textContent = e.message;
        parFailMsg.classList.remove('hide');
    }
}

const meuForm = document.forms.formRegister;
meuForm.onsubmit = function (e) {
    e.preventDefault();
    sendForm(meuForm);
}