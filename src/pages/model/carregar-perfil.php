<?php

    session_start();
    require_once 'connection.php'; 
    
    if(!isset($_SESSION['login'])) { 
        header("Location: ../controller/entrar.php");
        $_SESSION['msg'] = '<p style="color: #F00"> Por favor, efetue o login para acessar esta pagina! </p>';
    } 

    $query_localidade = "SELECT IDLOCALIDADE                                     
                            FROM LOCALIDADE
                            WHERE ID_USUARIO = :id_usuario";

    $result_localidade = $connection -> prepare($query_localidade);
    $result_localidade -> bindParam(':id_usuario', $_SESSION['id_usuario'], PDO::PARAM_INT);
    $result_localidade -> execute();

    $row_localidade = $result_localidade -> fetchAll(PDO::FETCH_ASSOC);

    foreach($row_localidade as $localidade) {

        $_SESSION['id_localidade'] = $localidade['IDLOCALIDADE'];
        include "carregar-previa-perfil.php";
    }
    