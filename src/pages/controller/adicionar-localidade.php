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
        <link rel="stylesheet" href="../view/adicionar-localidade.css">

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

                        <a href="../model/logout.php"><button class="button-sair-sm" id="btSair"> sair </button></a>
                            
                    </div>

                </div>
            </div>
        </header>    

        <div class="area1">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 input-panel">

                            <h2 class="input-title-2"> Por favor, <br>insira os dados da localidade: </h2>    

                            <form action="../model/nova-localidade.php" enctype="multipart/form-data" method="POST">  
                                <div class="input-panel">

                                    <input type="text" name="nome" id="nome"  placeholder="Nome da localidade" class="input" value="<?php if(isset($_SESSION['input_nome'])) { echo $_SESSION['input_nome']; } ?>"> 
                                    
                                    <input type="text" name="rua" id="rua"  placeholder="Rua" class="input" value="<?php if(isset($_SESSION['input_rua'])) { echo $_SESSION['input_rua']; } ?>"> 

                                    <div class="input-row">
                                        <input type="text" name="bairro" id="bairro" placeholder="Bairro" class="input" value="<?php if(isset($_SESSION['input_bairro'])) { echo $_SESSION['input_bairro']; } ?>">

                                        <input type="number" name="numero" id="numero" placeholder="N°" class="input" value="<?php if(isset($_SESSION['input_numero'])) { echo $_SESSION['input_numero']; } ?>">
                                    </div> 

                                    <div class="input-row">
                                        <input type="text" name="cidade" id="cidade" placeholder="Cidade" class="input" value="<?php if(isset($_SESSION['input_cidade'])) { echo $_SESSION['input_cidade']; } ?>">

                                        <input type="text" name="estado" id="estado" placeholder="UF Estado" class="input" value="<?php if(isset($_SESSION['input_estado'])) { echo $_SESSION['input_estado']; } ?>">
                                    </div>           

                                    <div class="input-row">
                                        <div>
                                            <div class="text"> <input type="radio" name="pagamento" value="Diária" class="input-radio"> Valor em diária </div>      
                                        
                                            <div class="text"> <input type="radio" name="pagamento" value="Hora" class="input-radio"> Valor em hora </div>
                                        </div>

                                        <input type="number" step="0.01" name="valor" id="valor" placeholder="Valor em R$" class="input" value="<?php if(isset($_SESSION['input_valor'])) { echo $_SESSION['input_valor']; } ?>">
                                    </div>


                                    <p class="type"> Tipo de espaço: </p> 
                                    <div class="input-row">
                                            <div class="text"> <input type="radio" name="tipo" value="ArLivre" class="input-radio"> Ar Livre </div>      
                                        
                                            <div class="text"> <input type="radio" name="tipo" value="Fechado" class="input-radio"> Fechado </div>

                                            <div class="text"> <input type="radio" name="tipo" value="Buffet" class="input-radio"> Buffet </div>
                                    </div>

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
                                                unset($_SESSION['input_nome']);
                                                unset($_SESSION['input_rua']);
                                                unset($_SESSION['input_bairro']);
                                                unset($_SESSION['input_numero']);
                                                unset($_SESSION['input_valor']);
                                            }
                                        ?>
                                    </div>
                                    
                                    <div class="input-row">
                                        <a href="perfil.php"class="button-editar gray"> VOLTAR </a>
                                
                                        <button type="submit" value="access" name="sendNovaLocalidade" class="button-salvar"> SALVAR </button>
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


