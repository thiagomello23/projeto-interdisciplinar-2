<?php

    include_once("conexao.php");

    if(!empty($_POST)){

        if($_POST['type'] == 'insertItem' && !empty($_FILES['file'])){

            $itemName = $_POST['itemName'];
            $itemStatus = $_POST['itemStatus'];
            $itemDesc = $_POST['itemDesc'];
            $itemImg = $_FILES['file'];
            $extensao = strtolower(pathinfo($itemImg['name'], PATHINFO_EXTENSION)); 
            $registerID = $_POST['id']; // Talvez validacao

            if($itemName == ''){
                $msg = ['error'=>true, 'msg'=>'Campo nome não preenchido!'];
            }else if($itemDesc == ''){
                $msg = ['error'=>true, 'msg'=>'Campo status não preenchido!'];
            }else if($itemStatus == ''){
                $msg = ['error'=>true, 'msg'=>'Campo descricão não preenchido!'];
            }else if($itemImg['error']){
                $msg = ['error'=>true, 'msg'=>'Houve um erro ao enviar o arquivo, tente novamente!'];
            }else if($itemImg['size'] > 8388608){
                $msg = ['error'=>true, 'msg'=>'Arquivo muito grande, maximo 8 mb!'];
            }else if($extensao != 'jpg' && $extensao !='png' && $extensao!= 'jpeg'){
                $msg = ['error'=>true, 'msg'=>'Tipo de extensão não permitido!'];
            }else{

                $pasta = 'images/';
                $fileName = uniqid();
                $itemPath = $pasta . $fileName . "." . $extensao;

                move_uploaded_file($itemImg['tmp_name'], '../' . $itemPath);

                $query  = "INSERT INTO itens (item_name, item_status, item_desc, item_path, id_registro) VALUES (:item_name, :item_status,:item_desc, :item_path, :id_registro);";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(":item_name", $itemName);
                $stmt->bindParam(":item_status", $itemStatus);
                $stmt->bindParam(":item_desc", $itemDesc);
                $stmt->bindParam(":item_path", $itemPath);
                $stmt->bindParam(":id_registro", $registerID);
                $stmt->execute(); // Validacao dessa execucao

                echo json_encode(['error'=>false]);

            }

        }else if($_POST['type'] == "collectionData"){

            // Elemento para a paginacao 
            $pagina = $_GET['pagina'];

            // Calcular a visualizacao 
            $qtd_result_pg = 21; 
            $inicio = ($pagina * $qtd_result_pg) - $qtd_result_pg;
            
            $id = $_POST['id'];
            
            // Query Para Pagination dos itens 
            $query = "SELECT itens.item_path, itens.item_name, itens.id AS item_id
            FROM registros  
            INNER JOIN itens ON itens.id_registro = registros.id 
            WHERE itens.id_registro = :id
            ORDER BY itens.id DESC
            LIMIT $inicio, $qtd_result_pg";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(":id", $id);

            // Aqui tem uma verificacao
            $stmt->execute();
            
            if(($stmt) && $stmt->rowCount() != 0){

                $dados = '';

                // Criar um array JSON aqui
                while($resposta = $stmt->fetch(PDO::FETCH_ASSOC)){

                    extract($resposta);
                    $dados .="<div>";
                    $dados .= "<a href='item.php?id=$id&item=$item_id'>";
                    $dados .= "<img class='collection-item-image' src='$item_path' alt='$item_name'></a>";
                    $dados .= "</div>"; 
                }

                // Query para saber o Numero de itens de um usuario
                $query_pg = "SELECT COUNT(itens.id) AS itens FROM itens INNER JOIN registros ON itens.id_registro = registros.id WHERE itens.id_registro = :id";
                $stmt = $conn->prepare($query_pg);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                $row_item = $stmt->fetch(PDO::FETCH_ASSOC);

                // Quantidade de paginas
                $qtd_paginas = ceil($row_item['itens'] / $qtd_result_pg);
                $max_link = 2;

                // Fim pagination 
                $dados .= "<nav class='collection-pagination' aria-label='Page navigation example'>";
                    $dados .= "<ul class='pagination'>";
                        $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='atualizaDados(1)'>Primeira</a></li>";

                        for($pag_ant = $pagina - $max_link; $pag_ant <= $pagina - 1; $pag_ant++){
                            if($pag_ant >= 1){
                                $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='atualizaDados($pag_ant)'>$pag_ant</a></li>";
                            }
                        }

                        $dados .= "<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";

                        for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_link; $pag_dep++){
                            if($pag_dep <= $qtd_paginas){
                                $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='atualizaDados($pag_dep)'>$pag_dep</a></li>";
                            }
                        }

                        $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='atualizaDados($qtd_paginas)'>Ultima</a></li></ul>
                        </nav>";
            
                echo json_encode(['dados'=>$dados, 'qtd'=>$qtd_paginas]);
            }else{
                $msg = ['error'=>true, 'msg'=>'Você ainda não possui nenhum item!'];
            }

        }

    }
    
    if(!empty($msg)){

        echo json_encode($msg);

    }
