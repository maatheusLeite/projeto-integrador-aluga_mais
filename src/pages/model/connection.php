<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "alugamais";
    $port = 3306;

    try {
        $connection = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $password);
    } 
    catch (PDOException $err) {
        echo 'Erro: Falha ao conectar com o banco de dados.';
    }