<?php 
    session_start();
    require_once 'connection.php';
    
    if(!isset($_SESSION['login'])) { 
        header("Location: ../controller/entrar.php");
        $_SESSION['msg'] = '<p style="color: #F00"> Por favor, efetue o login para acessar esta pagina! </p>';
    } 

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(!empty($data['sendExcluir'])) {
        $query_localidade = "SELECT IDLOCALIDADE, ID_USUARIO 
                                FROM LOCALIDADE
                                WHERE IDLOCALIDADE = :id_localidade
                                LIMIT 1";

        $result_localidade = $connection -> prepare($query_localidade);
        $result_localidade -> bindParam(':id_localidade', $data['id_localidade'], PDO::PARAM_INT);
        $result_localidade -> execute();
        
        if(($result_localidade) && ($result_localidade -> rowCount() != 0)) {
            $row_localidade = $result_localidade -> fetch(PDO::FETCH_ASSOC);

            // Verifica se a localidade a ser excluida pertence ao usuário que realizou a chamada 
            if($row_localidade['ID_USUARIO'] == $data['id_usuario']) {
                
                $query_excluir_endereco = "DELETE FROM ENDERECO
                                            WHERE ID_LOCALIDADE = :id_localidade";

                $result_excluir_endereco = $connection -> prepare($query_excluir_endereco);
                $result_excluir_endereco -> bindParam(':id_localidade', $row_localidade['IDLOCALIDADE'], PDO::PARAM_INT);
                $result_excluir_endereco -> execute(); 
                
                // Exclui os arquivos de imagens salvos 
                $query_imagem = "SELECT URL
                                    FROM IMAGEM     
                                    WHERE ID_LOCALIDADE = :id_localidade";

                $result_imagem = $connection -> prepare($query_imagem);
                $result_imagem -> bindParam(':id_localidade', $row_localidade['IDLOCALIDADE'], PDO::PARAM_INT);
                $result_imagem -> execute(); 

                $row_imagem = $result_imagem -> fetchAll(PDO::FETCH_ASSOC);

                foreach($row_imagem as $imagem) {
                    unlink('../' . $imagem['URL']);
                }


                // Exclui a referencia da imagem no banco de dados 
                $query_excluir_imagem = "DELETE FROM IMAGEM
                                            WHERE ID_LOCALIDADE = :id_localidade";

                $result_excluir_imagem = $connection -> prepare($query_excluir_imagem);
                $result_excluir_imagem -> bindParam(':id_localidade', $row_localidade['IDLOCALIDADE'], PDO::PARAM_INT);
                $result_excluir_imagem -> execute(); 

                $query_excluir_localidade = "DELETE FROM LOCALIDADE
                                                WHERE IDLOCALIDADE = :id_localidade";

                $result_excluir_localidade = $connection -> prepare($query_excluir_localidade);
                $result_excluir_localidade -> bindParam(':id_localidade', $row_localidade['IDLOCALIDADE'], PDO::PARAM_INT);
                $result_excluir_localidade -> execute(); 

                header("Location: ../controller/perfil.php");
                $_SESSION['msg'] = '<p style="color: #FFF"> Localidade excluida com sucesso! </p>';
            }
            else {
                header("Location: ../controller/perfil.php");
                $_SESSION['msg'] = '<p style="color: #F00"> Usuário Invalido!!! </p>';
            }
        }
        else {
            header("Location: ../controller/perfil.php");
            $_SESSION['msg'] = '<p style="color: #F00"> Erro ao buscar informações - Tente novamente </p>';
        }
    }         