<?php
    include_once("config/url.php");
    include_once("config/verifica_login.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="style/style.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <title>ColecionaDOR</title>
</head>
<body>
    
    <header id="header">
        <nav id="navbar">
            <a href="index.php">
                <img src="<?=$BASE_URL?>templates/templateImage/logo.svg" alt="" class="logo">
            </a>
            <ul id="nav-item">
                <li><a href="index.php">Home</a></li>
                <li><a href="#sobre">Sobre</a></li>

                <?php if(isset($_SESSION['user'])){ ?>
                    <li><a href="colecao.php?id=<?=$_SESSION['id']?>">Minha Coleção</a></li>
                    <a href="perfil.php?id=<?=$_SESSION['id']?>">
                        <img class="profileImage" src="<?=$_SESSION['image']?>" alt="Profile Image">
                    </a>
                <?php }else {?>
                    <li id="login"><a href="#">Login/Registro</a></li>
                <? } ?>

            </ul>
            <div class="icon-menu">
                <i class="fa fa-bars"></i>
            </div>
        </nav>

        <div class="modal-container hidden">
            <form class="modal-form" id="form-login">
                <div class="alert alert-danger hidden" role="alert" id="loginDiv">
                    <span id="loginMsg"></span>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <button type="submit" class="btn btn-dark btn--registro" id="loginSubmit">Login</button>
                <a href="registro.php">Ainda não possui conta?</a>
            </form>
            <div id="close" class="close">
                <i class="fa-solid fa-x"></i>
            </div>
        </div>

    </header>
    <div class="opacity hidden"></div>
    <main>

