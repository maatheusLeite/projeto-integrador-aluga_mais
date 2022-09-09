<?php
    session_start();
    unset($_SESSION['id_usuario'], $_SESSION['nome_usuario'], $_SESSION['login'], $_SESSION['id_localidade']);

    $_SESSION['msg'] = '<p style="color: #FFF"> Deslogado com sucesso! </p>';
    header("Location: ../controller/entrar.php");