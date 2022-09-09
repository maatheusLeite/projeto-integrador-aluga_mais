<?php session_start() ?>
<?php $data = filter_input_array(INPUT_POST, FILTER_DEFAULT) ?> 

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
        <link rel="stylesheet" href="../view/entrar.css">

        <!-- Icone da pagina -->
        <link rel="shortcut icon" href="../../assets/icons/favicon.ico">

        <title> ALUGA+ - Entrar </title>
    </head>

    <body>
        <div class="area0">
            <header>
                <div class="container">
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="nav">
                                <a href="index.php"> <img class="logo" src="../../assets/images/logo.png" alt="ALUGA+ Home"> </a>
                            </div>
                        </div>

                    </div>
                </div>
            </header>

        
            <div class="area1">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 input-panel">

                            <h2 class="input-title-2"> Seja bem vindo! </h2>    
                            <h2 class="input-title-3"> Encontre diversos espaços na sua região! </h2>    

                            <form action="../model/login.php" method="POST">  
                                <div class="input-panel">

                                    <input type="email" name="email" id="email"  placeholder="Email" class="input" value="<?php if(isset($_SESSION['input_email'])) { echo $_SESSION['input_email']; } ?>">

                                    <input type="password" name="senha" id="senha" placeholder="Senha" class="input">

                                    <div class="messages">
                                        <!-- Mensagens de erro e inputs -->
                                        <?php
                                            if(isset($_SESSION['msg'])) {
                                                echo $_SESSION['msg'];
                                                
                                                unset($_SESSION['msg']);
                                                unset($_SESSION['input_nome']);
                                                unset($_SESSION['input_ddd']);
                                                unset($_SESSION['input_telefone']);
                                                unset($_SESSION['input_email']);
                                                unset($_SESSION['input_senha']);
                                            }
                                        ?>
                                    </div>

                                    <button type="submit" value="access" name="sendLogin" class="button-entrar"> ENTRAR </button>
                                </div>
                            </form>

                            <div class="cadastrar">  Ainda não é cadastrado? <a href="cadastrar.php" class="text-button">Cadastre-se </a> </div>
                            
                        </div>
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