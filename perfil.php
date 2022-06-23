<?php
    include_once("templates/header.php");
?>

    <section id="profile">
        <div class="container-sm">
            <div class="welcome">
                <h1>Pagina de perfil</h1>
                <a href="config/deslogar.php">Deslogar</a>
            </div>
            <div class="profileContainer">
                <div class=" image-container">
                    <img src="images/defaultImage.jpg" alt="" id="profileImage">
                    <form class="imageEdit" enctype="multipart/form-data">
                        <div>
                            <label for="arquivo" class="inputFile">Editar Foto <i class="fa-solid fa-file-pen"></i></label>
                            <input type="file" name="arquivo" id="arquivo">     
                        </div>
                        <div class="btnDiv">
                            <button type="submit" class="btn-send" id="btnFile">Enviar</button>
                        </div>
                    </form>
                </div>
                <div class="profile-content col-8">
                    <div class="profile-name">
                        <h1>Nome:</h1>
                        <h3 id="profileName"></h3>
                    </div>
                    <div class="profile-email">
                        <h1>Email</h1>
                        <h3 id="profileMail"></h3>
                    </div>
                    <div class="desc">
                        <div class="desc-title">
                            <div>
                                <h1>Descrição</h1>
                            </div>
                            <div class="desc-edit" data-toggle="modal" data-target="#exampleModal">
                                <span>Editar</span>
                                <i class="fa-solid fa-pen"></i>
                            </div>
                        </div>
                        <div class="desc-item">
                            <p id="descItem" class="textarea"></p>
                            <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modo de Edição</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-floating">
                                                <textarea class="form-control textarea" placeholder="Digite sua descrição" id="textarea" style="height: 300px"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-primary" data-dismiss="modal" id="changeDesc">Salvar alterações</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert-profile">
                <div id="alertDiv" class="alert alert-danger hidden">
                    <span id="alert"></span>
                </div>
            </div>
        </div>
    </section>

    <script src="script/perfil.js"></script>
    
<?php
    include_once("templates/footer.php");
?>