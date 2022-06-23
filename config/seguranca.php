<?php

    session_start();

    if(!empty($_GET) && !empty($_SESSION['id'])){

        $id = $_GET['id'];
        if($id != $_SESSION['id']){
            echo json_encode(['error'=>true, 'id'=>$_SESSION['id']]);
        }else{
            echo json_encode(['error'=>false]);
        }

    }else{
        echo json_encode(['error'=>true, 'acesso'=>true]);
    }