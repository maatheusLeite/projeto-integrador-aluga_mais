<?php

    session_start();
    require_once 'connection.php';  

    if(!isset($_SESSION['login'])) { 
        header("Location: ../controller/entrar.php");
        $_SESSION['msg'] = '<p style="color: #F00"> Por favor, efetue o login para acessar esta pagina! </p>';
    } 
    
    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);  

    if(!empty($data['sendNovaLocalidade'])) {

        // Verifica se todos os dados foram enviados
        if (empty($data['nome']) || empty($data['rua']) || empty($data['bairro']) || empty($data['tipo'])
            || empty($data['numero']) || empty($data['valor']) || empty($data['pagamento'])) {

            header('Location: ../controller/adicionar-localidade.php');
            $_SESSION['msg'] = '<p style="color: #F00"> Preencha todos os dados </p>';
            $_SESSION['input_nome'] = $data['nome'];
            $_SESSION['input_rua'] = $data['rua'];
            $_SESSION['input_bairro'] = $data['bairro'];
            $_SESSION['input_numero'] = $data['numero'];
            $_SESSION['input_cidade'] = $data['cidade'];
            $_SESSION['input_estado'] = $data['estado'];
            $_SESSION['input_valor'] = $data['valor'];
        }
        else {

            // Insere a nova localidade no banco 
            $query_cadastro_localidade = "INSERT INTO LOCALIDADE(NOME, TIPO, PAGAMENTO, VALOR, ID_USUARIO)
                                VALUES(:nome, :tipo, :pagamento, :valor, :id_usuario)";

            $result_cadastro_localidade = $connection -> prepare($query_cadastro_localidade);
            $result_cadastro_localidade -> bindParam(':nome', $data['nome'], PDO::PARAM_STR);
            $result_cadastro_localidade -> bindParam(':tipo', $data['tipo'], PDO::PARAM_STR);
            $result_cadastro_localidade -> bindParam(':pagamento', $data['pagamento'], PDO::PARAM_STR);
            $result_cadastro_localidade -> bindParam(':valor', $data['valor'], PDO::PARAM_STR);
            $result_cadastro_localidade -> bindParam(':id_usuario', $_SESSION['id_usuario'], PDO::PARAM_INT);
            $result_cadastro_localidade -> execute();

            if($result_cadastro_localidade) {

                $query_localidade = "SELECT IDLOCALIDADE
                                            FROM LOCALIDADE
                                            WHERE NOME = :nome
                                            AND ID_USUARIO = :id_usuario";

                $result_localidade = $connection -> prepare($query_localidade);
                $result_localidade -> bindParam(':nome', $data['nome'], PDO::PARAM_STR);
                $result_localidade -> bindParam(':id_usuario', $_SESSION['id_usuario'], PDO::PARAM_INT);
                $result_localidade -> execute(); 

                if(($result_localidade) && ($result_localidade -> rowCount() != 0)) {
                    $row_localidade = $result_localidade -> fetch(PDO::FETCH_ASSOC);

                    // Verifica se foi enviado um arquivo
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
                     
                            // Tenta mover a imagem para o destino
                            if (@move_uploaded_file($imagem_tmp, $destino)) {
                                $_SESSION['msg'] = 'Arquivo salvo com sucesso';
                            }
                            else {
                                header("Location: ../controller/adicionar-localidade.php");
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
                            header("Location: ../controller/adicionar-localidade.php");
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
                        header("Location: ../controller/adicionar-localidade.php");
                        $_SESSION['msg'] = '<p style="color: #F00"> Você não enviou nenhuma imagem! </p>';
                        $_SESSION['input_nome'] = $data['nome'];
                        $_SESSION['input_rua'] = $data['rua'];
                        $_SESSION['input_bairro'] = $data['bairro'];
                        $_SESSION['input_numero'] = $data['numero'];
                        $_SESSION['input_cidade'] = $data['cidade'];
                        $_SESSION['input_estado'] = $data['estado'];
                        $_SESSION['input_valor'] = $data['valor'];
                    } 
                    
                    // Insere a imagem vinculada à localidade no banco 
                    $query_imagem = "INSERT INTO IMAGEM(URL, ID_LOCALIDADE) 
                                        VALUES(:url, :id_localidade)";
                    
                    $url = "../posts/$novo_nome";  
                    
                    $result_imagem = $connection -> prepare($query_imagem);
                    $result_imagem -> bindParam(':url', $url, PDO::PARAM_STR);
                    $result_imagem -> bindParam(':id_localidade', $row_localidade['IDLOCALIDADE'], PDO::PARAM_INT);
                    $result_imagem -> execute();  

                    // Insere o endereço vinculado à localidade no banco 
                    if($result_imagem) {
                        $query_endereco = "INSERT INTO ENDERECO(RUA, BAIRRO, CIDADE, ESTADO, NUMERO, ID_LOCALIDADE) 
                                            VALUES(:rua, :bairro, :cidade, :estado, :numero, :id_localidade)";
                        
                        $result_endereco = $connection -> prepare($query_endereco);
                        $result_endereco -> bindParam(':rua', $data['rua'], PDO::PARAM_STR);
                        $result_endereco -> bindParam(':bairro', $data['bairro'], PDO::PARAM_STR);
                        $result_endereco -> bindParam(':cidade', $data['cidade'], PDO::PARAM_STR);
                        $result_endereco -> bindParam(':estado', $data['estado'], PDO::PARAM_STR);
                        $result_endereco -> bindParam(':numero', $data['numero'], PDO::PARAM_STR);
                        $result_endereco -> bindParam(':id_localidade', $row_localidade['IDLOCALIDADE'], PDO::PARAM_INT);
                        $result_endereco -> execute();  

                        if($result_endereco) {
                            header("Location: ../controller/perfil.php");

                            unset($_SESSION['msg']);
                            unset($_SESSION['input_nome']);
                            unset($_SESSION['input_rua']);
                            unset($_SESSION['input_bairro']);
                            unset($_SESSION['input_numero']);
                            unset($_SESSION['input_cidade']);
                            unset($_SESSION['input_estado']);
                            unset($_SESSION['input_valor']);
                        }
                        else {
                            header("Location: ../controller/adicionar-localidade.php");
                            $_SESSION['msg'] = '<p style="color: #F00"> Erro ao inserir endereço - Tente novamente </p>';
                        } 
                    }
                    else {
                        header("Location: ../controller/adicionar-localidade.php");
                        $_SESSION['msg'] = '<p style="color: #F00"> Erro ao inserir imagem - Tente novamente </p>';
                    } 
                }
                else {
                    header("Location: ../controller/adicionar-localidade.php");
                    $_SESSION['msg'] = '<p style="color: #F00"> Erro buscando informações - Tente novamente </p>';
                } 
            }
            else {
                header("Location: ../controller/adicionar-localidade.php");
                $_SESSION['msg'] = '<p style="color: #F00"> Erro ao inserir localidade - Tente novamente </p>';
            } 
        }
    }