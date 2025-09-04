    <?php
    //funções de string
    $nome = "Danilo";
    echo "<p> Todas em maiúsculo: ".strtoupper($nome)."</p>";
    echo "<p> Todas em minúsculo: ".strtolower($nome)."</p>";
    echo "<p>Quantidade de caracteres: ".strlen($nome)."</p>";
    $posicao = strpos($nome, "i");
    echo "<p>Caractere I na posição $posicao</p>";

    //funções de data/tempo
    date_default_timezone_set('America/Sao_Paulo');
    $data1 = date("d/m/Y");
    $dia = date("d");
    $hora = date("H:i:s");
    echo "<p>Data: $data1</p>";
    echo "<p>Dia: $dia</p>";
    echo "<p>Hora: $hora</p>";
    if(checkdate(2, 30, 2025)){
        echo "<p>A data informada existe (30/02/2025 )</p>";
    }
    else{
        echo "<p>A data informada não existe (30/02/2025 )</p>";
    }
    
    //funções matemáticas
    $valor = -10;
    echo "<p> Valor absoluto: ".abs($valor)."</p>";
    $valor = 5.9;
    echo "<p> Valor arredondo: ".round($valor)."</p>";
    $valor = rand(1, 100); //retorna um valor aleatório dentro desse intervalor
    echo "<p> Valor Aleatório: $valor </p>";
    echo "<p> Raiz quadrada de 16: ".sqrt(16). "</p>";
    $valor = 13.5;
    echo "<p> Valor formatado: R$ ".number_format($valor, 2, ",", ".")."</p>"; //formatação de número (numero, qtde de casas após vírgula, vírgula, ponto pra milhar)

    //criando função
    function exibirSaudacao(){
        echo "<p>Olá, mundo</p>";
    }
    exibirSaudacao();

    function exibirSaudacaoComNome($nome){
        echo "<p>Seja bem-vindo, $nome</p>";
    }
    exibirSaudacaoComNome("Danilo");

    function menorValor($n1,$n2){
        return min($n1, $n2); //a função min volta o menor valor entre n1 e n2
    }
    echo "Menor valor entre 4 e 8: ".menorValor(8,4);

    //... faz com que eu passe vários números por parâmetro
    function somarValores(...$numeros){
        return array_sum($numeros);
    }
    $soma = somarValores(1,2,3,4,5,6,7,8,9,10);
    echo "<p>A soma dos valores é: $soma</p>"

    

    ?>