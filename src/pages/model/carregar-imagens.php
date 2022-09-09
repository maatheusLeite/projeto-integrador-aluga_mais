<?php

    session_start();
    include_once 'connection.php';

    if(!isset($_SESSION['login'])) { 
        header("Location: ../controller/entrar.php");
        $_SESSION['msg'] = '<p style="color: #F00"> Por favor, efetue o login para acessar esta pagina! </p>';
    } 

    $query_imagem = "SELECT URL                             
                            FROM IMAGEM
                            WHERE ID_LOCALIDADE = :id_localidade";

    $result_imagem = $connection -> prepare($query_imagem);
    $result_imagem -> bindParam(':id_localidade', $_SESSION['id_localidade'], PDO::PARAM_INT);
    $result_imagem -> execute();
    
    if(($result_imagem) && ($result_imagem -> rowCount() > 0)) {
        $row_imagem = $result_imagem -> fetchAll(PDO::FETCH_ASSOC);
        
        foreach($row_imagem as $imagem) {
?>
            <div class="image-panel">
                <img src="../../posts/<?php echo $imagem['URL'] ?>" class="post-image">
            </div>
<?php
        }
    }
