
// Puxar o ID da URL do Usuario
// itemName = max 50 caracters
// itemStatus = max 25 caracters
// itemDesc = max 300 caracters
// 

const collectionBtn = document.getElementById("collectionBtn");

// Parametros da URL
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
            window.location.assign("colecao.php?id=" + resposta.id);
        }

    }   

}

// Adicionar um novo item
collectionBtn.addEventListener("click", async function(e){
    e.preventDefault();

    const itemName = document.getElementById("itemName");
    const itemStatus = document.getElementById("itemStatus");
    const itemDesc = document.getElementById("itemDesc");
    const itemFile = document.getElementById("itemFile").files[0];

    const alertMsg = document.getElementById("alert");
    const alertDiv = document.getElementById("alertDiv");

    if(itemName.value == ''){
        alertMsg.textContent = 'Campo nome não preenchido!';
        alertDiv.classList.remove("hidden");
        // Aparecer um alert na tela
    }else if(itemStatus.value == ''){
        alertMsg.textContent = 'Campo status não preenchido!';
        alertDiv.classList.remove("hidden");
    }else if(itemDesc.value == ''){
        alertMsg.textContent = 'Campo descricão não preenchido!';
        alertDiv.classList.remove("hidden");
    }else if(itemFile == undefined){
        alertMsg.textContent = 'Imagem do item não selecionada!';
        alertDiv.classList.remove("hidden");
    }else{

        const collectionForm = document.getElementById("collectionForm");
        const collectionData = new FormData(collectionForm);
        collectionData.append("file", itemFile);
        collectionData.append("type", "insertItem");
        collectionData.append("id", id);

        const requisicao = await fetch("config/dados_colecao.php", {
            method: 'POST',
            body: collectionData
        });
        const resposta = await requisicao.json();
        
        if(resposta.error){
            alertMsg.textContent = resposta.msg;
            alertDiv.classList.remove("hidden");
        }else{
            itemName.value = '';
            itemStatus.value = '';
            itemDesc.value = '';
            atualizaDados(1);
        }


    }

});

// Puxar os dados do usuario

async function atualizaDados(pagina){

    const collectionItem = document.getElementById("collectionItem");

    const idData = new FormData();
    idData.append("id", id);
    idData.append("type", "collectionData");


    // Trocar o metodo para GET
    const requisicao = await fetch("config/dados_colecao.php?pagina=" + pagina, {
        method: 'POST',
        body: idData
    });

    const resposta = await requisicao.json();

    if(resposta.error){
        collectionItem.textContent = resposta.msg;
    }else{
        //console.log(resposta); // So vai dessa forma por conta de um erro no PHP
        collectionItem.innerHTML = resposta['dados'];
    }

}

seguranca();
atualizaDados(1);
