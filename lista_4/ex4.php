<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .caixa {
            background: rgba(0, 0, 0, 0.7);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.95);
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
    </style>
</head>

<body>
    <?php include "navbar.php"; ?>
    <div class="p-5">
        <div class="caixa">
            <h1 style="color:white">Exercício 4</h1>
            <div class="m-5 flex-column align-items-center">
                <form method="post">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <h5 class="text-center mb-3" style="color:white">Item <?= $i ?></h5>
                        <div class="mb-3">
                            <label for="nome<?= $i ?>" class="form-label" style="color:white">Nome do Item <?= $i ?>:</label>
                            <input type="text" id="nome<?= $i ?>" name="nomes[]" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="preco<?= $i ?>" class="form-label" style="color:white">Preço do Item <?= $i ?> (R$):</label>
                            <input type="number" step="0.01" min="0" id="preco<?= $i ?>" name="precos[]" class="form-control" required>
                        </div>
                        <hr style="border-color: white;">
                    <?php endfor; ?>
                    <div class="d-flex justify-content-center align-center">
                        <button type="submit" class="btn btn-dark">Calcular com Imposto</button>
                    </div>
                </form>
                <div class="mt-5 d-flex flex-column align-items-center gap-2" style="color:white">

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        $nomes = $_POST['nomes'];
                        $precos = $_POST['precos'];

                        $itens = [];

                        for ($i = 0; $i < 5; $i++) {
                            $nome = trim($nomes[$i]);
                            $preco = floatval($precos[$i]);

                            $precoComImposto = $preco * 1.15;

                            $itens[$nome] = round($precoComImposto, 2);
                        }

                        asort($itens);

                        if (!empty($itens)) {
                            echo "<h4 class='text-center' style='color:white'>Itens Ordenados por Preço com Imposto (Menor para Maior):</h4>";
                            echo "<table class='table table-dark table-striped w-100' style='color:white'>";
                            echo "<thead><tr>
                                    <th style='color:white'>Nome do Item</th>
                                    <th style='color:white'>Preço Original</th>
                                    <th style='color:white'>Preço com Imposto (15%)</th>
                                    <th style='color:white'>Valor do Imposto</th>
                                  </tr></thead>";
                            echo "<tbody>";

                            foreach ($itens as $nome => $precoComImposto) {
                                $precoOriginal = $precos[array_search($nome, $nomes)];
                                $valorImposto = $precoComImposto - $precoOriginal;

                                echo "<tr>";
                                echo "<td style='color:white'>$nome</td>";
                                echo "<td style='color:white'>R$ " . number_format($precoOriginal, 2, ',', '.') . "</td>";
                                echo "<td style='color:white' class='fw-bold'>R$ " . number_format($precoComImposto, 2, ',', '.') . "</td>";
                                echo "<td style='color:white'>R$ " . number_format($valorImposto, 2, ',', '.') . "</td>";
                                echo "</tr>";
                            }

                            echo "</tbody></table>";

                            $totalImposto = array_sum($itens) - array_sum($precos);
                            $mediaImposto = $totalImposto / count($itens);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>