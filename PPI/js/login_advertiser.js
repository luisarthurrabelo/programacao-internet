async function sendForm(form) {
    try {
        const response = await fetch("../db/controller.php?action=login_advertiser", { 
            method: 'post', 
            body: new FormData(form) 
        });

        if (!response.ok) {
            console.log("Error");
            throw new Error(response.statusText);
        }

        const loginResult = await response.json();
        console.log("loginResult");

        if (loginResult.success) {
            console.log("sucesso no login")
            window.location = loginResult.newLocation;
        }
        else {
            console.log("falha no login por dado inesperado")
            const parLoginFailMsg = document.querySelector("#loginFailMsg");
            parLoginFailMsg.textContent = 'Dados incorretos. Por favor, tente novamente.';
            parLoginFailMsg.classList.remove('hide');
            form.senha.value = "";
            form.senha.focus();
        }
    }
    catch (e) {
        const parLoginFailMsg = document.querySelector("#loginFailMsg");
        parLoginFailMsg.textContent = e.message;
        parLoginFailMsg.classList.remove('hide');
    }
}

const meuForm = document.forms.formLogin;
const button = document.querySelector(".back-button");

button.onclick = function () {
    window.location = "index.php";
}

meuForm.onsubmit = function (e) {
    e.preventDefault();
    sendForm(meuForm);
}