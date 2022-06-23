// Informacoes = ID, name, email, perfilimage, description
// Colocar os dados e deixar a descricao e a imagem mudaveis via o usuario
// colocar icones do font-awesome

// Pegar o query parameter e mandar para o back-end
// Apos o retorno dos valores via back-end entao adicionar os valores no html
// Deixando o Site de maneira dinamica

// Preciso de uma funcao para atualizar a tela 

// Puxa os parametros da URL
const url = new URLSearchParams(window.location.search);
const id = url.get("id");

// Seguranca

async function seguranca(){

    const requisicao = await fetch("config/seguranca.php?id="+ id, {
        method: 'GET'
    });

    const resposta = await requisicao.json();
    
    if(resposta.error){
        
        if(resposta.acesso){
            window.location.assign("http://localhost/curso_php/Z_PROJETO_1/index.php");
        }else{
            window.location.assign("perfil.php?id=" + resposta.id);
        }

    }   

}

// Puxar os dados do usuario
async function dadosPerfil(){

    const item = new FormData();
    item.append("id", id);
    item.append("type", "id");

    const requisicao = await fetch("config/dados_perfil.php", {
        method:'POST',
        body: item
    });
    const resposta = await requisicao.json();
    // name, email, image, desc
    
    adicionaDadosPerfil(resposta);

}

function adicionaDadosPerfil(dados){

    const profileImage = document.getElementById("profileImage");
    const profileName = document.getElementById("profileName");
    const profileMail = document.getElementById("profileMail");
    const descItem = document.getElementById("descItem");    

    profileImage.src = dados.image;
    profileName.textContent = dados.name;
    profileMail.textContent = dados.email;
    descItem.textContent = dados.desc;

}

// Funcoes sendo executadas
seguranca();
dadosPerfil();

// Descricao

const changeDesc = document.getElementById("changeDesc");

changeDesc.addEventListener("click", async function(e){
    e.preventDefault();
    
    const textarea = document.getElementById("textarea").value;

    if(textarea != ''){

        const descData = new FormData();
        descData.append("type", "desc");
        descData.append("description", textarea);
        descData.append("id", id);

        const requisicao = await fetch("config/dados_perfil.php", {
            method: 'POST',
            body: descData
        });

        const resposta = await requisicao.json();
        
        if(resposta.error){
            //console.log('Deu erro');
        }else{
            dadosPerfil();
        }

    }
    
});

// Imagem de perfil

const btnFile = document.getElementById("btnFile");

btnFile.addEventListener("click", async function(e){
    e.preventDefault();

    const alertMsg = document.getElementById("alert");
    const alertDiv = document.getElementById("alertDiv");

    const file = document.getElementById("arquivo").files[0];

    if(file == undefined) return

    const imageFile = new FormData();
    imageFile.append("arquivo", file);
    imageFile.append("type", "file");
    imageFile.append("id", id);

    const requisicao = await fetch("config/dados_perfil.php", {
        method: 'POST',
        body: imageFile
    });

    const resposta = await requisicao.json();

    if(resposta.error){
        alertMsg.textContent = resposta.msg;
        alertDiv.classList.remove("hidden");
    }else{
        dadosPerfil();
    }

});
