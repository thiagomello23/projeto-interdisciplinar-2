<?php

    include_once("conexao.php");

    if(!empty($_GET)){

        $userId = $_GET['id'];
        $itemId = $_GET['item'];

        // Query para retornar o Item que o usuario acessou 
        $query = "SELECT itens.item_name, itens.item_status, itens.item_path, itens.item_desc FROM itens INNER JOIN registros ON itens.id_registro = registros.id WHERE itens.id = :item AND itens.id_registro = :user";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":user", $userId);
        $stmt->bindParam(":item", $itemId);
        $stmt->execute();

        if( ($stmt) && $stmt->rowCount() != 0){

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            extract($resultado);

            echo json_encode(['nome'=>"$item_name", 'status'=>"$item_status", 'imagem'=>"$item_path", 'desc'=>"$item_desc"]);

        }else{
            echo json_encode(['error'=>true]);
        }

    }else if(!empty($_POST)){

        // Parte Final, Dar Update no item do usuario

        $name = $_POST['itemName'];
        $status = $_POST['itemStatus'];
        $desc = $_POST['itemDesc'];
        $itemId = $_POST['itemId'];

        // Se o $_FILES Existir, entao eu passo uma query de update dessa forma
        // Se o $_FILES Nao existir, entao eu atribuo outra query
        // Tambem preciso do ID do usuario e o id do item, se nao nao consigo dar update

        if(!empty($_FILES['file'])){ // Irei Precisar verificar o arquivo, Mover o Arquivo e ainda por cima dar update no arquivo
            $file = $_FILES['file'];

            $extensao = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            if($file['error']){
                $msg = ['error'=>false, 'msg'=>'Houve um erro ao enviar o arquivo'];
                die();
            }else if($file['size'] > 8388608){
                $msg = ['error'=>true, 'msg'=>'Arquivo muito grande, MAX 8MB'];
                die();
            }else if($extensao != 'jpg' && $extensao != 'png'){
                $msg = ['error'=>true, 'msg'=>'Tipo de arquivo não permitido'];
                die();
            }else{

                // Inserir Arquivo Na Pasta
                $novoNome = uniqid();
                $pasta = 'images/';
                $path = $pasta . $novoNome . "." . $extensao;

                move_uploaded_file($file['tmp_name'], '../' . $path);

                $query = "UPDATE itens 
                SET item_name = :name, item_status = :status, item_desc = :desc, item_path = :path 
                WHERE id = :id;
                ";

                // Variavel usada para verificar se existe update na imagem ou nao
                // Para ter um bindParam a mais ou nao
                $existePath = 'existe';

            }

        }else{
            $query = "UPDATE itens 
            SET itens.item_name = :name, itens.item_status = :status, itens.item_desc = :desc 
            WHERE itens.id = :id";

            // Variavel usada para verificar se existe update na imagem ou nao
            // Para ter um bindParam a mais ou nao
            $existePath = 'Nao Existe';
        }

        // Update no banco 
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":desc", $desc);
        $stmt->bindParam(":id", $itemId);

        if($existePath == 'existe'){
            $stmt->bindParam(":path", $path);
        }

        $stmt->execute();

        if($stmt->rowCount() != 0){ // Deu certo
            $msg = ['error'=>false, 'msg'=>'Item atualizado com sucesso'];
        }else{ // Deu erro
            // Pequeno "Probleminha" aqui, caso o usuario nao modifique nada ele da a msg de Falha
            $msg = ['error'=>true, 'msg'=>'Falha ao editar o arquivo'];
        }

    }
    
    if(!empty($msg)){

        echo json_encode($msg);

    }