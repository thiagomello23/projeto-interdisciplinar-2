<?php
    include_once("templates/header.php");
?>

    <section id="home">
        <div class="hero">
            <div class="hero-intro">
                <div class="intro-col-left">
                    <h1>ColecionaDOR</h1>
                    <p>O site perfeito para quem quer ter o controle total sobre os seus produtos.
                        Chega de utilizar bloco de notas para salvar suas coleções!.
                    </p>
                    <div class="btn-container">
                        <a href="registro.php">
                            <button class="intro-btn">Comece Agora!</button>
                        </a>
                    </div>
                </div>
                <div class="intro-col-right">
                    <img src="templates/templateImage/heroImage.png" alt="Home Image">
                </div>
            </div>
            <div class="hero-info">
                <div class="hero-info-title">
                    <h1>Oque é o ColecionaDOR?</h1>
                </div>
                <div class="hero-info-content">
                    <p>O ColecionaDOR é uma plataforma 100% gratuita e de facil acesso para permitir que os colecionadores de todo o mundo possam gerenciar suas coleções de uma maneira mais eficiente do que blocos de anotações comuns, permitindo salvar imagens do produto, adicionar descrições ao item e também é possivel adicionar imagens e status do produto em questão (ex: pendente ou adquirido).</p>
                </div>
            </div>
            <div class="hero-about">
                <div class="hero-about-title" id="sobre">
                    <h1>Vantagens do ColecionaDOR</h1>
                </div>
                <div class="hero-about-container">
                    <div class="hero-about-item">
                        <div class="hero-about-icon">
                            <i class="fa-solid fa-cube"></i>
                        </div>
                        <p>Armazene uma quantidade enorme de itens de uma maneira facil e rapida! Facilitando sua vida e agilizando o seu precioso tempo.</p>
                    </div>
                    <div class="hero-about-item">
                        <div class="hero-about-icon">
                            <i class="fa-solid fa-eraser"></i>
                        </div>
                        <p>Escreveu algo errado? Você pode editar os seus itens da forma que quiser, de maneira extremamente simples sem precisar apagar e começar tudo de novo!</p>
                    </div>
                    <div class="hero-about-item">
                        <div class="hero-about-icon">
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <p>Visualize seus itens de maneira rápida e dinâmica sem enrolação, permitindo o uso de imagens para facilitar a localização do produto cadastrado.</p>
                    </div>
                </div>
            </div>
            <div class="hero-faq" id="faqEvent">
                <div class="hero-faq-container-title">
                    <h1>Perguntas Frequentes</h1>
                </div>
                <div class="hero-faq-answer">
                    <div class="hero-faq-title">
                        <h3>Como faço para cadastrar um item?</h3>
                        <div class="hero-faq-icon icon--1" data-icon="1">
                            <i class="fa-solid fa-arrow-down"></i>
                        </div>
                    </div>
                    <div class="hero-faq-content faq-content-1 hidden">Simples, basta ir na aba "Minha Coleção" e logo em seguida terá um formulario para cadastrar um novo item.</div>
                </div>
                <div class="hero-faq-answer">
                    <div class="hero-faq-title">
                        <h3>Como acesso um item já cadastrado?</h3>
                        <div class="hero-faq-icon icon--2" data-icon="2">
                            <i class="fa-solid fa-arrow-down"></i>
                        </div>
                    </div>
                    <div class="hero-faq-content faq-content-2 hidden">Na aba "Minha coleção" role a pagina um pouco para baixo e então os itens aparecerão, após achar o item que queira visualizar basta clicar nele com o botão esquerdo e você será redirecionado para uma nova aba contendo a visualização do item.</div>
                </div>
                <div class="hero-faq-answer">
                    <div class="hero-faq-title">
                        <h3>Quanto custa?</h3>
                        <div class="hero-faq-icon icon--3" data-icon="3">
                            <i class="fa-solid fa-arrow-down"></i>
                        </div>
                    </div>
                    <div class="hero-faq-content faq-content-3 hidden">Absolutamente nada, o serviço é gratuito para qualquer utilizador da plataforma, basta criar uma conta e terá acesso a todos os beneficios!</div>
                </div>
            </div>
        </div>
    </section>

<?php 
    include_once("templates/footer.php");
?>