<?php

    session_start();
    require_once 'connection.php';  

    $query_localidade = "SELECT IDLOCALIDADE                                     
                            FROM LOCALIDADE
                            WHERE TIPO = 'Buffet'";

    $result_localidade = $connection -> prepare($query_localidade);
    $result_localidade -> execute();
    $row_localidade = $result_localidade -> fetchAll(PDO::FETCH_ASSOC);

    foreach($row_localidade as $localidade) {

        $_SESSION['id_localidade'] = $localidade['IDLOCALIDADE'];
        include "carregar-previa-localidade.php";
    }
    