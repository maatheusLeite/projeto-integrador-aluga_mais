<?php session_start() ?>

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
        <link rel="stylesheet" href="../view/index.css">

        <!-- Icone da pagina -->
        <link rel="shortcut icon" href="../../assets/icons/favicon.ico">

        <title> ALUGA+ </title>
    </head>

    <body onload="updateHeader(<?php echo $_SESSION['login'] ?>);">
        <header>
            <div class="container">
                <div class="row">

                    <div class="col-sm-2">
                        <div class="nav">
                            <a href="index.php"> <img class="logo" src="../../assets/images/logo.png" alt="ALUGA+ Home"> </a>
                        </div>
                    </div>

                    <div class="col-sm-6 nav">
                        <nav class="menu">
                            <a href="#" class="menu-item"> Espaços ao ar Livre </a>
                            <a href="#area2" class="menu-item"> Espaços fechados </a>
                            <a href="#area3" class="menu-item"> Buffets </a>
                        </nav>
                    </div>

                    <div class="col-sm-4 nav">
                        <nav class="menu">
                            <div class="logged-out" id="loggedOut">
                                <a href="cadastrar.php" class="menu-item"><button class="button-cadastro-sm"> Cadastrar-se </button></a>
                                <a href="entrar.php" class="menu-item"><button class="button-entrar-sm"> Entrar </button></a>
                            </div>
                            <div class="logged-in" id="loggedIn">
                                <a href="perfil.php" class="button-perfil-sm" id="btPerfil"> <?php echo $_SESSION['nome_usuario'] ?> </a>
                                <a href="../model/logout.php"><button class="button-sair-sm" id="btSair"> sair </button></a>
                            </div>
                        </nav>
                    </div>

                </div>
            </div>
        </header>

        <div class="area1"> 
            <div class="container">
                <div class="row row1">
                    <h2 class="title"> Espaços ao ar livre </h2>

                    <div class="col-sm-12 column">
                        <?php include('../model/carregar-ar-livre.php'); ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="space">
            <div class="container">
                <div class="row">
                    <h2 class="title"> Espaços fechados </h2>
                </div>
            </div>
        </div>

        <div class="area2" id="area2"> 
            <div class="container">
                <div class="col-sm-12 column">
                    <?php include('../model/carregar-fechado.php'); ?>
                </div>
            </div>
        </div>

        <div class="space">
            <div class="container">
                <div class="row">
                    <h2 class="title"> Buffets </h2>
                </div>
            </div>
        </div>

        <div class="area3" id="area3"> 
            <div class="container">
                <div class="col-sm-12 column">
                    <?php include('../model/carregar-buffet.php'); ?>
                </div>
            </div>
        </div>

        <div class="space">
            <div class="container">
                <div class="row">
                </div>
            </div>
        </div>

        <script src="headerUpdater.js"></script>

        <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>