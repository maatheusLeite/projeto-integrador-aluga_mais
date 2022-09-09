<?php

    session_start();
    require_once 'connection.php';  

    if(!isset($_SESSION['login'])) { 
        header("Location: ../controller/entrar.php");
        $_SESSION['msg'] = '<p style="color: #F00"> Por favor, efetue o login para acessar esta pagina! </p>';
    } 
    
    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);  

    if(!empty($data['sendNovaImagem'])) {

        // verifica se foi enviado um arquivo
        if (isset($_FILES['imagem']['name']) && $_FILES['imagem']['error'] == 0) {
            
            $imagem_tmp = $_FILES['imagem']['tmp_name'];
            $nome = $_FILES['imagem']['name'];
            
            // Pega a extensão
            $extensao = pathinfo($nome, PATHINFO_EXTENSION);
            
            // Converte a extensão para minúsculo
            $extensao = strtolower($extensao);
            
            // Somente imagens, .jpg;.jpeg;.png - Extensões permitidas separadas por ';'
            if (strstr('.jpg;.jpeg;.png', $extensao)) {
                // Cria um nome único para esta imagem
                $novo_nome = uniqid(time()) . '.' . $extensao;
            
                // Concatena a pasta com o nome
                $destino = '../../posts/' . $novo_nome;
            
                // tenta mover o arquivo para o destino
                if (@move_uploaded_file($imagem_tmp, $destino)) {
                    $_SESSION['msg'] = '<p style="color: #0F0;"> Imagem salva com sucesso! </p>';
                }
                else {
                    header("Location: ../controller/adicionar-imagem.php");
                    $_SESSION['msg'] = '<p style="color: #F00"> Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita. </p>';
                    $_SESSION['input_nome'] = $data['nome'];
                    $_SESSION['input_rua'] = $data['rua'];
                    $_SESSION['input_bairro'] = $data['bairro'];
                    $_SESSION['input_numero'] = $data['numero'];
                    $_SESSION['input_cidade'] = $data['cidade'];
                    $_SESSION['input_estado'] = $data['estado'];
                    $_SESSION['input_valor'] = $data['valor'];
                }
            }
            else {
                header("Location: ../controller/adicionar-imagem.php");
                $_SESSION['msg'] = '<p style="color: #F00"> Você poderá enviar apenas imagens *.jpg *.jpeg *.png! </p>';
                $_SESSION['input_nome'] = $data['nome'];
                $_SESSION['input_rua'] = $data['rua'];
                $_SESSION['input_bairro'] = $data['bairro'];
                $_SESSION['input_numero'] = $data['numero'];
                $_SESSION['input_cidade'] = $data['cidade'];
                $_SESSION['input_estado'] = $data['estado'];
                $_SESSION['input_valor'] = $data['valor'];
            }
        }
        else {
            header("Location: ../controller/adicionar-imagem.php");
            $_SESSION['msg'] = '<p style="color: #F00"> Você não enviou nenhuma imagem! </p>';
            $_SESSION['input_nome'] = $data['nome'];
            $_SESSION['input_rua'] = $data['rua'];
            $_SESSION['input_bairro'] = $data['bairro'];
            $_SESSION['input_numero'] = $data['numero'];
            $_SESSION['input_cidade'] = $data['cidade'];
            $_SESSION['input_estado'] = $data['estado'];
            $_SESSION['input_valor'] = $data['valor'];
        } 

        $query_imagem = "INSERT INTO IMAGEM(URL, ID_LOCALIDADE) 
                            VALUES(:url, :id_localidade)";
        
        $url = "../posts/$novo_nome";  
        
        $result_imagem = $connection -> prepare($query_imagem);
        $result_imagem -> bindParam(':url', $url, PDO::PARAM_STR);
        $result_imagem -> bindParam(':id_localidade', $_SESSION['id_localidade'], PDO::PARAM_INT);
        $result_imagem -> execute(); 
        
        header("Location: ../controller/adicionar-imagem.php?id_localidade=" . $_SESSION['id_localidade']);
    }
    