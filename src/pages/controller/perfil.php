<?php session_start() ?>
<?php 
    if(!isset($_SESSION['login'])) { 
        header("Location: ../controller/entrar.php");
        $_SESSION['msg'] = '<p style="color: #F00"> Por favor, efetue o login para acessar esta pagina! </p>';
    } 
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <!-- CSS comum -->
        <link rel="stylesheet" href="../view/common.css">

        <!-- CSS da pagina -->
        <link rel="stylesheet" href="../view/perfil.css">

        <!-- Icone da pagina -->
        <link rel="shortcut icon" href="../../assets/icons/favicon.ico">

        <title> ALUGA+ - Localidades </title>
    </head>

    <body class="bg">
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 nav">
                        
                        <a href="index.php"> <img class="logo" src="../../assets/images/logo.png" alt="ALUGA+ Home"> </a>

                        <a href="../model/logout.php"><button class="button-sair-sm" id="btSair"> sair </button></a>
                            
                    </div>
                </div>
            </div>
        </header>

        <div class="area1">
            <div class="container">

                <div class="row">
                    <div class="col-sm-12"> 
                        
                        <div class="user-info">
                            <img class="logo" src="../../assets/images/user.png" alt="Foto usuario">

                            <h2> <?php echo $_SESSION['nome_usuario'] ?> </h2> 
                        </div>

                        <div class="messages">
                            <!-- Mensagens de erro e inputs -->
                            <?php
                                if(isset($_SESSION['msg'])) {
                                    echo $_SESSION['msg'];
                                    
                                    unset($_SESSION['msg']);
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <h2 class="title-2"> Meus espaços </h2>
                    
                    <div class="col-sm-12 column"> 
                        
                        <?php include("../model/carregar-perfil.php") ?>

                        <a href="adicionar-localidade.php"><button class="button-adicionar" id="btAdicionar"> + </button></a>

                    </div>
                </div>
            </div>
        </div>
       
        <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>


