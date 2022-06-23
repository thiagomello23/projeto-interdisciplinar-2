<?php

    include_once("conexao.php");
    // Falta uma validacao
    if(!empty($_POST)){
        // Recebendo os dados normalmente
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        $query = "SELECT * FROM registros WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $res = $stmt->fetch();

        if($name == '' || strlen($name) > 25){
            $msg = ['error'=>true, 'msg'=>'Nome de usuario invalido! MAX: 25 caracters.'];
        }else if($email == ''){
            $msg = ['error'=>true, 'msg'=>'Preencha o campo email para continuar!'];
        }else if($password == '' || $confirmPassword == ''){
            $msg = ['error'=>true, 'msg'=>'Preencha os campos de senha!'];
        }else if($password != $confirmPassword){
            $msg = ['error'=>true, 'msg'=>'As senhas nao condizem!'];
        }else if($res == ''){

            $senhaCriptografada = password_hash($password, PASSWORD_DEFAULT);
            $path = 'templates/templateImage/defaultProfile.jpg';
            $query = "INSERT INTO registros (name, email, password, perfilimage) VALUES (:name, :email, :password, :perfilImage)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $senhaCriptografada);
            $stmt->bindParam(":perfilImage", $path);
            $stmt->execute();
            // Validacao na hora de executar
            $msg = ['error'=>false, 'msg'=>'Cadastrado com sucesso!']; // Redireciona para a aba de login ou o home do site
            // E fala que o registro foi feito com sucesso
        }else{
            $msg = ['error'=>true, 'msg'=>'Email ja cadastrado!'];
        }

    }

    if(!empty($msg)){

        echo json_encode($msg);

    }