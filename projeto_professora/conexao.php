<?php

    $dominio = "mysql:host=localhost;dbname=projetophp_professora";
    $usuario = "root";
    $senha = "";

    try {
        $pdo = new PDO($dominio, $usuario, $senha);
    } catch(Exception $e) {
         die("Erro ao conectar ao Banco de Dados!".$e->getMessage()); //se não fez conexão com o BD, mata o programa (para de processar)
    }