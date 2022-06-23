
const itemBtn = document.getElementById("itemBtn");
const itemFile = document.getElementById("itemFile");
const itemImage = document.getElementById("itemImage")
const itemName = document.getElementById("itemName");
const itemStatus = document.getElementById("itemStatus");
const itemDesc = document.getElementById("itemDesc");
const itemAlert = document.getElementById("itemAlert");

// URL Params 
const url = new URLSearchParams(window.location.search);
const id = url.get("id");
const item = url.get("item");

// Seguranca

async function seguranca(){

    if(!item){
        window.location.assign("colecao.php?id=" + id);
    }

    const requisicao = await fetch(`config/seguranca.php?id=${id}`, {
        method: 'GET'
    });

    const resposta = await requisicao.json();
    
    if(resposta.error){
        
        if(resposta.acesso){
            window.location.assign("http://localhost/curso_php/Z_PROJETO_1/index.php");
        }else{
            window.location.assign(`item.php?id=${resposta.id}&item=${item}`);
        }

    }   

}

// Quando o usuario clicar para atualizar as informacoes do item
itemBtn.addEventListener("click", async function(e){
    e.preventDefault();

        const itemForm = document.getElementById("itemForm");
        const itemData = new FormData(itemForm);
        itemData.append("file", itemFile.files[0]);
        itemData.append("itemId", item);

        const requisicao = await fetch("config/dados_item.php", {
            method: 'POST',
            body: itemData
        });

        const resposta = await requisicao.json();
        
        if(resposta.error){
            // Alert 
            itemAlertStatus("alert-danger", resposta.msg);
        }else{
            itemAlertStatus("alert-success", resposta.msg);
            puxaItem();
        }

});

async function puxaItem(){

    const requisicao = await fetch(`config/dados_item.php?id=${id}&item=${item}`,{
        method: 'GET'
    });

    const resposta = await requisicao.json();
    montaItens(resposta);

}

function itemAlertStatus(classe, texto){

    // Evitar conflito de classes, Reset
    itemAlert.classList.remove("alert-danger");
    itemAlert.classList.remove("alert-success");

    itemAlert.classList.add(classe);
    itemAlert.classList.remove("hidden");
    itemAlert.textContent = texto;

    // Remove a msg apos 3 segundos na tela do usuario
    setTimeout(()=>{
        itemAlert.classList.add("hidden");
    },3000);

}

function montaItens(dados){

    // Monta os itens de forma dinamica

    itemImage.src = dados.imagem;
    itemName.value = dados.nome;
    itemStatus.value = dados.status;
    itemDesc.value = dados.desc;

}

seguranca();
puxaItem();
