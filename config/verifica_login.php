<?php

    session_start();
    include_once("conexao.php");

    if(!empty($_POST)){
        // Os dados estao chegando

        $email = $_POST['email'];
        $password = $_POST['password'];

        if($email == ''){
            $msg = ['error'=>true, 'msg'=>'Campo email nao preenchido!'];
        }else if($password == ''){
            $msg = ['error'=>true, 'msg'=>'Campo senha nao preenchido!'];
        }else{

            $query = 'SELECT * FROM registros WHERE email = :email';
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $resposta = $stmt->fetch();

            if(!empty($resposta)){

                if($email != $resposta['email']){
                    $msg = ['error'=>true, 'msg'=>'Email Invalido!'];
                }else if(password_verify($password, $resposta['password'])){
                    $id = $resposta['id'];
                    $_SESSION['user'] = $resposta['email'];
                    $_SESSION['id'] = $id;
                    $_SESSION['image'] = $resposta['perfilImage'];
                    $msg = ['error'=>false, 'url'=>"perfil.php?id=$id"];

                }else{

                    $msg = ['error'=>true, 'msg'=>'Senha Invalida!'];

                }

            }else{
                $msg = ['error'=>true, 'msg'=>'Usuario ou senha invalido!'];
            }

        }
        

    }

    if(!empty($msg)){

        echo json_encode($msg);

    }