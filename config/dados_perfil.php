<?php

    // Validar a session
    // Lembrar de fechar o banco de dados
    // Se o ID for diferente do ID de $_SESSION entao redireciona o usuario

    include_once("conexao.php");

    if(!empty($_POST)){

        if($_POST['type'] == 'id'){
            $id = $_POST['id'];

            $query  = "SELECT * FROM registros WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $resultado = $stmt->fetch();

            // Preciso validar se a descricao e nula ou nao via PHP

            echo json_encode(['name'=>$resultado['name'], 'email'=>$resultado['email'], 'desc'=>$resultado['description'], 'image'=>$resultado['perfilImage']]);            
        }else if($_POST['type'] == 'file' && !empty($_FILES)){ // Atualizacao da imagem
            
            $image = $_FILES['arquivo'];
            $id = $_POST['id'];
            $extensao = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

            if(isset($image)){
                if($image['error'] == 0){

                    if($image['size'] > 8388608){
                        echo json_encode(['error'=>true, 'msg'=>'Arquivo muito grande! MAX: 8MB']);
                    }else if($extensao != 'jpg' && $extensao != 'png'){
                        echo json_encode(['error'=>true, 'msg'=>'Tipo de arquivo não permitido!']);
                    }else{

                        $pasta = 'images/';
                        $imageName = uniqid();
                        $path = $pasta . $imageName . '.' . $extensao;
                        move_uploaded_file($image['tmp_name'], '../'.$path);

                        $query = "UPDATE registros SET perfilimage = :path WHERE id = :id";
                        $stmt = $conn->prepare($query);
                        $stmt->bindParam(":id", $id);
                        $stmt->bindParam(":path", $path);
                        $stmt->execute();

                        echo json_encode(['error'=>false]);

                    }

                }else{

                    echo json_encode(['error'=>true, 'msg'=>'Houve um erro ao enviar o arquivo']);

                }                
            }else{
                echo json_encode(['error'=>true, 'msg'=>'Nenhum arquivo selecionado']);
            }
            
        }else if($_POST['type'] == 'desc'){

            $id = $_POST['id'];
            $desc = $_POST['description'];

            if($desc != ''){

                $query = 'UPDATE registros SET description = :desc WHERE id = :id';
                $stmt = $conn->prepare($query);
                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":desc", $desc);
                $stmt->execute();

                echo json_encode(['error'=>false]);

            }else{
                echo json_encode(['error'=>true]);
            }

        }

    }