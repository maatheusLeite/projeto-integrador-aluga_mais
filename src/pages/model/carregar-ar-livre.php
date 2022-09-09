<?php

    session_start();
    require_once 'connection.php';  

    if(!isset($_SESSION['login'])) { 
        header("Location: ../controller/entrar.php");
        $_SESSION['msg'] = '<p style="color: #F00"> Por favor, efetue o login para acessar esta pagina! </p>';
    } 

    $query_localidade = "SELECT IDLOCALIDADE                                     
                            FROM LOCALIDADE
                            WHERE TIPO = 'ArLivre'";

    $result_localidade = $connection -> prepare($query_localidade);
    $result_localidade -> execute();
    $row_localidade = $result_localidade -> fetchAll(PDO::FETCH_ASSOC);

    foreach($row_localidade as $localidade) {

        $_SESSION['id_localidade'] = $localidade['IDLOCALIDADE'];
        include "carregar-previa-localidade.php";
    }
    


        

    

       