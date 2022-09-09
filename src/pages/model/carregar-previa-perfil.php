<?php

    session_start();
    include_once 'connection.php';  

    if(!isset($_SESSION['login'])) { 
        header("Location: ../controller/entrar.php");
        $_SESSION['msg'] = '<p style="color: #F00"> Por favor, efetue o login para acessar esta pagina! </p>';
    }         

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
        <div class="post-panel">
            <img src="../../posts/<?php echo $row_localidade['URL'] ?>" class="post-image">
            <h4 class="post-title"> <?php echo $row_localidade['NOME'] ?> </h4>

            <p class="post-text"> Endereço: <?php echo $row_localidade['RUA'] . ' - ' . $row_localidade['NUMERO'] . ' - ' . $row_localidade['BAIRRO'] . ' - ' . $row_localidade['CIDADE'] . ' - ' . $row_localidade['ESTADO'] ?> </p>
            
            <h5 class="post-price"> Valor: <?php echo $row_localidade['PAGAMENTO'] ?> <p class="post-value"> R$ <?php echo $row_localidade['VALOR'] ?> </p></h5>
            
            <div class="post-buttons">
                <a href="../controller/adicionar-imagem.php?id_localidade=<?php echo $row_localidade['IDLOCALIDADE'] ?>"><button class="button-editar" id="btEditar"> Adicionar Imagem </button></a>

                <a href="../controller/excluir-localidade.php?id_localidade=<?php echo $row_localidade['IDLOCALIDADE'] ?>"><button class="button-excluir" id="btExcluir"> Excluir </button></a>
            </div>
        </div>
<?php 
    }

       