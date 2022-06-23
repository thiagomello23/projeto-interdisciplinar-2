<?php
    include_once("templates/header.php");
?>

    <section id="item-section">
        <div class="container">
            <div class="collection-add">
                <div class="collection-img">
                    <img src="" id="itemImage" alt="Item Image">
                    <form enctype="image/form-data">
                        <div class="img-file"> <!-- Faz Parte Do Form -->
                            <label for="itemFile">Imagem do item<i class="fa-solid fa-image"></i></label>
                            <input type="file" name="itemFile" id="itemFile">
                        </div>
                    </form>
                </div>
                <form class="collection-form" id="itemForm">
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
                    <button type="submit" class="collection-btn" id="itemBtn">Editar Item</button>
                </form>
                <!-- Um btn que quando clicado libera uma modal window com um form para cadastrar itens -->
            </div>
            <div class="item-alert-container">
                <div class="alert item-alert hidden" role="alert" id="itemAlert">

                </div>
            </div>
        </div>
    </section>
    
    <script src="script/item.js"></script>

<?php
    include_once("templates/footer.php");
?>