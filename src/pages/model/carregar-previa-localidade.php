<?php

    session_start();
    include_once 'connection.php';  

    $query_localidade = "SELECT L.IDLOCALIDADE, L.NOME, L.VALOR, L.PAGAMENTO, I.URL, 
                                        E.RUA, E.BAIRRO, E.CIDADE, E.ESTADO, E.NUMERO                                       
                                FROM LOCALIDADE L
                                INNER JOIN ENDERECO E
                                ON E.ID_LOCALIDADE = L.IDLOCALIDADE
                                INNER JOIN IMAGEM I
                                ON I.ID_LOCALIDADE = L.IDLOCALIDADE
                                WHERE L.IDLOCALIDADE = :id_localidade
                                LIMIT 1";

    $result_localidade = $connection -> prepare($query_localidade);
    $result_localidade -> bindParam(':id_localidade', $_SESSION['id_localidade'], PDO::PARAM_INT);
    $result_localidade -> execute();
    
    if(($result_localidade) && ($result_localidade -> rowCount() == 1)) {
        $row_localidade = $result_localidade -> fetch(PDO::FETCH_ASSOC);
?>
        <a href="../controller/localidade.php?id_localidade=<?php echo $row_localidade['IDLOCALIDADE'] ?>" class="post-panel">
            <img src="../../posts/<?php echo $row_localidade['URL'] ?>" class="post-image">
            
            <h4 class="post-title"> <?php echo $row_localidade['NOME'] ?> </h4>
            
            <p class="post-text"> Endereço: <?php echo $row_localidade['RUA'] . ' - ' . $row_localidade['NUMERO'] . ' - ' . $row_localidade['BAIRRO'] . ' - ' . $row_localidade['CIDADE'] . ' - ' . $row_localidade['ESTADO'] ?> </p>
            
            <h5 class="post-price"> Valor <?php echo $row_localidade['PAGAMENTO'] . ': <p class="post-value"> R$ ' . $row_localidade['VALOR'] ?> </p></h5>
            
            <p class="post-footer"> Clique para entrar em contato com o locador! </p>
        </a>
<?php  
    }

       