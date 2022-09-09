<?php

    session_start();
    include_once 'connection.php';

    if(!isset($_SESSION['login'])) { 
        header("Location: ../controller/entrar.php");
        $_SESSION['msg'] = '<p style="color: #F00"> Por favor, efetue o login para acessar esta pagina! </p>';
    } 

    $query_localidade = "SELECT L.IDLOCALIDADE, L.NOME, L.VALOR, L.PAGAMENTO, U.EMAIL, U.NOME AS LOCADOR, 
                                        T.DDD, T.NUMERO AS TELEFONE,
                                        E.RUA, E.BAIRRO, E.CIDADE, E.ESTADO, E.NUMERO                                
                                FROM LOCALIDADE L
                                INNER JOIN ENDERECO E
                                ON E.ID_LOCALIDADE = L.IDLOCALIDADE
                                INNER JOIN USUARIO U
                                ON U.IDUSUARIO = L.ID_USUARIO
                                INNER JOIN TELEFONE T
                                ON U.IDUSUARIO = T.ID_USUARIO
                                WHERE L.IDLOCALIDADE = :id_localidade
                                LIMIT 1";

    $result_localidade = $connection -> prepare($query_localidade);
    $result_localidade -> bindParam(':id_localidade', $_SESSION['id_localidade'], PDO::PARAM_INT);
    $result_localidade -> execute();
    
    if(($result_localidade) && ($result_localidade -> rowCount() == 1)) {
        $row_localidade = $result_localidade -> fetch(PDO::FETCH_ASSOC);
?>
        <h2 class="title black"> <?php echo $row_localidade['NOME'] ?> </h2>

        <div class=images>
            <?php include('carregar-imagens.php') ?>
        </div>

        <p class="post-text"> <b>Endereço:</b> <?php echo $row_localidade['RUA'] . ' - ' . $row_localidade['NUMERO'] . ' - ' . $row_localidade['BAIRRO'] ?> </p>
        <p class="post-text"> <b>Locador:</b> <?php echo $row_localidade['LOCADOR'] ?> </p>
        <p class="post-text"> <b>Email:</b> <?php echo $row_localidade['EMAIL'] ?> </p>
        <p class="post-text"> <b>Telefone:</b> <?php echo $row_localidade['DDD'] . ' ' . $row_localidade['TELEFONE'] ?> </p>
        
        <h5 class="post-price"> Valor <?php echo $row_localidade['PAGAMENTO'] ?>: <p class="post-value"> R$ <?php echo $row_localidade['VALOR'] ?> </p></h5>
        <a href="mailto:<?php echo $row_localidade['EMAIL'] ?>"> <button class="button-editar" id="btContato"> Entrar em contato </button> </a>
<?php 
    }
