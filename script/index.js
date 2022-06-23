// Arquivo para fazer o modal window + login ou adicionar efeitos na aba home do site
// bootstrap e font-awesome
// use strict
// Quando clicar no login, abrir uma modal window

const modalLogin = document.getElementById("login");
const btnSubmit = document.getElementById("btnSubmit");
const modalContainer = document.querySelector(".modal-container");
const opacity = document.querySelector(".opacity");
const loginSubmit = document.getElementById("loginSubmit");
const loginMsg = document.getElementById("loginMsg");
const loginDiv = document.getElementById("loginDiv");
const btnClose = document.getElementById("close");
const menuIcon = document.querySelector(".icon-menu");
const navbar = document.getElementById("nav-item");
const faqAnimation = document.getElementById("faqEvent");

// Header animations
if(modalLogin){
    modalLogin.addEventListener("click", function(){

        modalContainer.classList.toggle("hidden");
        opacity.classList.toggle("hidden");
    
    })

    opacity.addEventListener("click", function(){
    
        modalContainer.classList.toggle("hidden");
        opacity.classList.toggle("hidden");
    
    });

    btnClose.addEventListener("click", function(){
        
        modalContainer.classList.toggle("hidden");
        opacity.classList.toggle("hidden");

    });

}

// Navbar Animation
menuIcon.addEventListener("click", function(){

    console.log("Cu sujo");
    navbar.classList.toggle("active");

});

// Login Form
loginSubmit.addEventListener("click", async function(e){
    e.preventDefault();

    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    if(email == ''){
        loginMsg.textContent = 'Campo email nao preenchido!';
        loginDiv.classList.remove("hidden");
    }else if(password == ''){
        loginMsg.textContent = 'Campo senha nao preenchido!';
        loginDiv.classList.remove("hidden");
    }else{
        const formulario = document.getElementById("form-login");
        const dado = new FormData(formulario);

        const requisicao = await fetch("config/verifica_login.php", {
            method: 'POST',
            body: dado
        });
        const resposta = await requisicao.json();
        
        if(resposta.error){
            loginMsg.textContent =  resposta.msg;
            loginDiv.classList.remove("hidden");
        }else{
            window.location.assign(resposta.url);
        }

    }

});

// FAQ Animation

if (faqAnimation){

    faqAnimation.addEventListener("click", function(e){
        let element = e.target.closest("div");
    
        if(element.classList.contains("hero-faq-icon")){
            const identifier = element.dataset.icon;
            const icon = document.querySelector(`.icon--${identifier}`);
            const answer = document.querySelector(`.faq-content-${identifier}`);
            answer.classList.toggle("hidden");
            icon.classList.toggle("animacao");
        }
    
    });
    
}

