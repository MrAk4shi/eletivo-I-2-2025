<?php

    require("conexao.php"); //cria a variável pdo, se estiver nula não há conexão
    if($pdo){
        echo "Conexão realizada com sucesso!";
    }