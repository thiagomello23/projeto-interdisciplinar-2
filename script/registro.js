
const registerSubmit = document.getElementById("registerSubmit");
const alertMsg = document.getElementById("alertMsg");
const alertDiv = document.getElementById("alertDiv");

registerSubmit.addEventListener("click", async function(e){
    e.preventDefault();

    const nameRegister = document.getElementById("nameRegister").value;
    const emailRegister = document.getElementById("emailRegister").value;
    const passwordRegister = document.getElementById("passwordRegister").value;
    const confirmPasswordRegister = document.getElementById("confirmPasswordRegister").value;

    if(nameRegister == '' || nameRegister.lenght > 25){
        alertMsg.textContent = "Nome de usuario invalido! MAX: 25 caracters"; // Irei colocar em um alert
        alertDiv.classList.remove("hidden");
    }else if(emailRegister == ''){
        alertMsg.textContent = "Preencha o campo email para continuar";
        alertDiv.classList.remove("hidden");
    }else if(passwordRegister == '' || confirmPasswordRegister == ''){
        alertMsg.textContent = "Preencha os campos de senha!";
        alertDiv.classList.remove("hidden");
    }else if(passwordRegister != confirmPasswordRegister){
        alertMsg.textContent = "As senhas nao condizem!";
        alertDiv.classList.remove("hidden");
    }else{

        const formulario = document.getElementById("form--register");
        const dados = new FormData(formulario);
        const requisicao = await fetch("config/verifica_registro.php", {
            method: 'POST',
            body: dados
        });
        const resposta = await requisicao.json();
        
        if(resposta.error){
            alertMsg.textContent = resposta.msg;
            alertDiv.classList.remove("hidden");
        }else{
            alertMsg.textContent = resposta.msg;
            alertDiv.classList.remove("alert-danger");
            alertDiv.classList.add("alert-success");
            alertDiv.classList.remove("hidden");
        }

        // O PHP Retorna um error, um msg e uma URl se der certo

    }

});