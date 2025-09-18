<?php

    $valor = array(1, 2, 3, 4, 5);
    echo "<p>Primeiro valor do vetor: ".$valor[0]."</p>";
    //$v = $_POST['nome']; //post é um vetor gerenciado pela própria linguagem

    $vetor = [1, 2, 3, 4, 5];
    var_dump($vetor); //exibe os valores do vetor. Mais detalhado
    echo "<br/>";
    print_r($vetor); //mais específico

    $vetor[4] = 6;
    echo "<p>Novo valor na posição 4: ".$vetor[4]."</p>";

    $vetor['nome'] = "Danilo";
    print_r($vetor);

    $valores = [
        'nome' => "Danilo",
        'sobrenome' => "Ferreira",
        'idade' => 19
    ];

    foreach($valores as $c => $v){
        echo "<p>Posição: $c = Valor $v</p>";
    }
