<?php
    include_once("templates/header.php");
?>

    <section id="collection">
        <div class="container">
            <div class="container-title">
                <h1>Adicione Um Novo Item</h1>
            </div>
            <div class="collection-add">
                <div class="collection-img">
                    <img src="templates/templateImage/defaultItem.png" alt="Item Image">
                    <form enctype="image/form-data">
                        <div class="img-file"> <!-- Faz Parte Do Form -->
                            <label for="itemFile">Imagem do item<i class="fa-solid fa-image"></i></label>
                            <input type="file" name="itemFile" id="itemFile">
                        </div>
                    </form>
                </div>
                <form class="collection-form" id="collectionForm">
                    <div class="collection-input">
                        <label for="itemName">Nome do Produto:</label>
                        <input type="text" name="itemName" id="itemName">
                    </div>
                    <div class="collection-input">
                        <label for="itemStatus" class="margin">Status:</label>
                        <small>ex: pendente,adquirido</small>
                        <input type="text" name="itemStatus" id="itemStatus">
                    </div>
                    <div class="collection-input">
                        <label for="itemDesc">Descrição:</label>
                        <textarea class="form-control" placeholder="Descrição Do Produto" name="itemDesc" id="itemDesc" style="height: 170px"></textarea>
                    </div>
                    <button type="submit" class="collection-btn" id="collectionBtn">Adicionar Novo Item</button>
                </form>
                <!-- Um btn que quando clicado libera uma modal window com um form para cadastrar itens -->
            </div>
            <div class="alert-collection">
                <div id="alertDiv" class="alert alert-danger hidden">
                    <span id="alert"></span>
                </div>
            </div>
            <div class="collection-container">
                <div class="container-title">
                    <h1>Meus itens</h1>
                </div>
                <div class="collection-item" id="collectionItem">
                    <!-- Cada item novo cadastrado sera exibido aqui em formato de imagem (quando clica na imagem ele envia para uma outra pagina, sendo possivel editar o item selecionado)-->
                </div>
            </div>
        </div>
    </section>

    <script src="script/colecao.js"></script>

<?php
    include_once("templates/footer.php");
?>