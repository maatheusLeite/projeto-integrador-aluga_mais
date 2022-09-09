<?php session_start() ?>
<?php 
    if(!isset($_SESSION['login'])) { 
        header("Location: entrar.php");
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
        <link rel="stylesheet" href="../view/adicionar-imagem.css">

        <!-- Icone da pagina -->
        <link rel="shortcut icon" href="../../assets/icons/favicon.ico">

        <title> ALUGA+ - Localidades </title>
    </head>

    <body class="bg">
        <header>
            <div class="container zin">
                <div class="row">
                    <div class="col-sm-12 nav">

                        <a href="index.php"> <img class="logo" src="../../assets/images/logo.png" alt="ALUGA+ Home"> </a>

                        <div>
                            <a href="perfil.php" class="button-perfil-sm" id="btPerfil"> <?php echo $_SESSION['nome_usuario'] ?> </a>

                            <a href="../model/logout.php"><button class="button-sair-sm" id="btSair"> sair </button></a>
                        </div>
                   
                    </div>
                </div>
            </div>
        </header>    

        <div class="area1">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                        
                            <?php 
                                $id_localidade = $_GET['id_localidade'];
                                $_SESSION['id_localidade'] = $id_localidade;
                            ?>                            

                            <h2 class="input-title-2"> Imagens atuais: </h2>    

                            <div class="images">
                                <?php include('../model/carregar-imagens.php') ?>
                            </div>

                            <form action="../model/nova-imagem.php" enctype="multipart/form-data" method="POST">  
                                <div class="input-panel">

                                    <div class="file"> 
                                        <p class="type">Selecione uma imagem: </p>

                                        <input type="file" name="imagem" id="imagem">
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
                                    
                                    <div class="input-row">
                                        <a href="perfil.php"class="button-editar gray"> VOLTAR </a>
                                
                                        <button type="submit" value="access" name="sendNovaImagem" class="button-salvar"> ENVIAR IMAGEM </button>
                                    </div> 
                                    
                                </div>
                            </form>
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


