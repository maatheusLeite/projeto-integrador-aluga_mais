<?php

    session_start();
    require_once 'connection.php';    
     
    if(!isset($_SESSION['login'])) { 
        header("Location: ../controller/entrar.php");
        $_SESSION['msg'] = '<p style="color: #F00"> Por favor, efetue o login para acessar esta pagina! </p>';
    } 


    // verifica se foi enviado um arquivo
    if (isset( $_FILES['imagem' ][ 'name' ]) && $_FILES['imagem']['error'] == 0) {
    
        $imagem_tmp = $_FILES['imagem' ]['tmp_name'];
        $nome = $_FILES['imagem' ]['name'];
    
        // Pega a extensão
        $extensao = pathinfo($nome, PATHINFO_EXTENSION);
    
        // Converte a extensão para minúsculo
        $extensao = strtolower($extensao);
    
        // Somente imagens, .jpg;.jpeg;.png - Extensões permitidas separadas por ';'
        if(strstr('.jpg;.jpeg;.png', $extensao)) {
            // Cria um nome único para esta imagem
            $novoNome = uniqid(time()) . '.' . $extensao;
    
            // Concatena a pasta com o nome
            $destino = '../../posts/' . $novoNome;
    
            // tenta mover o arquivo para o destino
            if (@move_uploaded_file ($imagem_tmp, $destino)) {
                echo 'Arquivo salvo com sucesso';
            }
            else {
                header("Location: ../controller/adicionar-localidade.php");
                $_SESSION['msg'] = '<p style="color: #F00"> Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita. </p>';
                $_SESSION['input_nome'] = $data['nome'];
                $_SESSION['input_rua'] = $data['rua'];
                $_SESSION['input_bairro'] = $data['bairro'];
                $_SESSION['input_numero'] = $data['numero'];
                $_SESSION['input_valor'] = $data['valor'];
            }
        }
        else {
            header("Location: ../controller/adicionar-localidade.php");
            $_SESSION['msg'] = '<p style="color: #F00"> Você poderá enviar apenas imagens *.jpg *.jpeg *.png! </p>';
            $_SESSION['input_nome'] = $data['nome'];
            $_SESSION['input_rua'] = $data['rua'];
            $_SESSION['input_bairro'] = $data['bairro'];
            $_SESSION['input_numero'] = $data['numero'];
            $_SESSION['input_valor'] = $data['valor'];
        }
    }
    else {
        header("Location: ../controller/adicionar-localidade.php");
        $_SESSION['msg'] = '<p style="color: #F00"> Você não enviou nenhuma imagem! </p>';
        $_SESSION['input_nome'] = $data['nome'];
        $_SESSION['input_rua'] = $data['rua'];
        $_SESSION['input_bairro'] = $data['bairro'];
        $_SESSION['input_numero'] = $data['numero'];
        $_SESSION['input_valor'] = $data['valor'];
    }