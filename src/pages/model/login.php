<?php 

    session_start();
    require_once 'connection.php';                

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(!empty($data['sendLogin'])) {
        $query_usuario = "SELECT IDUSUARIO, NOME, EMAIL, SENHA 
                            FROM USUARIO 
                            WHERE EMAIL = :email 
                            LIMIT 1";

        $result_usuario = $connection -> prepare($query_usuario);
        $result_usuario -> bindParam(':email', $data['email'], PDO::PARAM_STR);
        $result_usuario -> execute();
        
        if(($result_usuario) && ($result_usuario -> rowCount() != 0)) {
            $row_usuario = $result_usuario -> fetch(PDO::FETCH_ASSOC);

            if(password_verify($data['senha'], $row_usuario['SENHA'])) {
                $_SESSION['id_usuario'] = $row_usuario['IDUSUARIO'];
                $_SESSION['nome_usuario'] = $row_usuario['NOME'];
                $_SESSION['login'] = true;

                header("Location: ../controller/index.php");
            }
            else {
                header("Location: ../controller/entrar.php");
                $_SESSION['msg'] = '<p style="color: #F00"> Email ou senha inválidos </p>';
                $_SESSION['input_email'] = $data['email'];
                $_SESSION['input_senha'] = $data['senha'];
            }
        }
        else {
            header("Location: ../controller/entrar.php");
            $_SESSION['msg'] = '<p style="color: #F00"> Email ou senha inválidos </p>';
            $_SESSION['input_email'] = $data['email'];
            $_SESSION['input_senha'] = $data['senha'];
        }
    }                           
