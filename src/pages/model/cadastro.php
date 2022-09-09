<?php 

    session_start();
    ob_start();
    require_once 'connection.php';
      
    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(!empty($data['sendCadastro'])) {
        $query_usuario = "SELECT EMAIL
                            FROM USUARIO
                            WHERE EMAIL = :email 
                            LIMIT 1";

        $result_usuario = $connection -> prepare($query_usuario);
        $result_usuario -> bindParam(':email', $data['email'], PDO::PARAM_STR);
        $result_usuario -> execute();

        if(($result_usuario) && ($result_usuario -> rowCount() == 0) && !empty($data['email'])) {
            if (empty($data['nome']) || empty($data['senha']) || empty($data['ddd']) || empty($data['telefone'])) {

                header ('Location: ../controller/cadastrar.php');
                $_SESSION['msg'] = '<p style="color: #F00"> Preencha todos os dados </p>';
                $_SESSION['input_nome'] = $data['nome'];
                $_SESSION['input_ddd'] = $data['ddd'];
                $_SESSION['input_telefone'] = $data['telefone'];
                $_SESSION['input_email'] = $data['email'];
                $_SESSION['input_senha'] = $data['senha'];
            }
            else {

                $senha = password_hash($data['senha'], PASSWORD_DEFAULT); // Criptografia de senha

                $query_cadastro = "INSERT INTO USUARIO(NOME, EMAIL, SENHA)
                                    VALUES(:nome, :email, :senha)";

                $result_cadastro = $connection -> prepare($query_cadastro);
                $result_cadastro -> bindParam(':nome', $data['nome'], PDO::PARAM_STR);
                $result_cadastro -> bindParam(':email', $data['email'], PDO::PARAM_STR);
                $result_cadastro -> bindParam(':senha', $senha, PDO::PARAM_STR);
                $result_cadastro -> execute();

                if($result_cadastro) {

                    $query_novo_usuario = "SELECT IDUSUARIO
                                            FROM USUARIO
                                            WHERE EMAIL = :email 
                                            LIMIT 1";

                    $result_novo_usuario = $connection -> prepare($query_novo_usuario);
                    $result_novo_usuario -> bindParam(':email', $data['email'], PDO::PARAM_STR);
                    $result_novo_usuario -> execute();

                    if(($result_novo_usuario) && ($result_novo_usuario -> rowCount() == 1)) {
                        $row_novo_usuario = $result_novo_usuario -> fetch(PDO::FETCH_ASSOC);

                        $query_telefone = "INSERT INTO TELEFONE(DDD, NUMERO, ID_USUARIO) 
                                            VALUES(:ddd, :numero, :id_usuario)";
                       
                        $result_telefone = $connection -> prepare($query_telefone);
                        $result_telefone -> bindParam(':ddd', $data['ddd'], PDO::PARAM_STR);
                        $result_telefone -> bindParam(':numero', $data['telefone'], PDO::PARAM_STR);
                        $result_telefone -> bindParam(':id_usuario', $row_novo_usuario['IDUSUARIO'], PDO::PARAM_STR);
                        $result_telefone -> execute();  

                        if($result_telefone) {
                            header ('Location: ../controller/index.php');
                            $_SESSION['id_usuario'] = $row_novo_usuario['IDUSUARIO'];
                            $_SESSION['nome_usuario'] = $data['nome'];
                            $_SESSION['email'] = $data['email'];
                            $_SESSION['login'] = true;
                        }
                        else {
                            header ('Location: ../controller/cadastrar.php');
                            $_SESSION['msg'] = '<p style="color: #F00"> Erro - Tente novamente </p>';
                        } 
                    }
                    else {
                        header ('Location: ../controller/cadastrar.php');
                        $_SESSION['msg'] = '<p style="color: #F00"> Erro - Tente novamente </p>';
                    } 
                }
                else {
                    header ('Location: ../controller/cadastrar.php');
                    $_SESSION['msg'] = '<p style="color: #F00"> Erro - Tente novamente </p>';
                } 
            }
        }
        else {
            header ('Location: ../controller/cadastrar.php');
            $_SESSION['msg'] = '<p style="color: #F00"> Email inválido </p>';
            $_SESSION['input_nome'] = $data['nome'];
            $_SESSION['input_email'] = $data['email'];
            $_SESSION['input_senha'] = $data['senha'];
        }
    }

