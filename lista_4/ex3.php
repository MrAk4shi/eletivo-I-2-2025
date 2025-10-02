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
            <h1 style="color:white">Exercício 3</h1>
            <div class="m-5 flex-column align-items-center">
                <form method="post">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <h5 class="text-center mb-3" style="color:white">Produto <?= $i ?></h5>
                        <div class="mb-3">
                            <label for="codigo<?= $i ?>" class="form-label" style="color:white">Código do Produto <?= $i ?>:</label>
                            <input type="text" id="codigo<?= $i ?>" name="codigos[]" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="nome<?= $i ?>" class="form-label" style="color:white">Nome do Produto <?= $i ?>:</label>
                            <input type="text" id="nome<?= $i ?>" name="nomes[]" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="preco<?= $i ?>" class="form-label" style="color:white">Preço do Produto <?= $i ?> (R$):</label>
                            <input type="number" step="0.01" min="0" id="preco<?= $i ?>" name="precos[]" class="form-control" required>
                        </div>
                        <hr style="border-color: white;">
                    <?php endfor; ?>
                    <div class="d-flex justify-content-center align-center">
                        <button type="submit" class="btn btn-dark">Cadastrar Produtos</button>
                    </div>
                </form>
                <div class="mt-5 d-flex flex-column align-items-center gap-2" style="color:white">

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        $codigos = $_POST['codigos'];
                        $nomes = $_POST['nomes'];
                        $precos = $_POST['precos'];

                        $produtos = [];

                        for ($i = 0; $i < 5; $i++) {
                            $codigo = trim($codigos[$i]);
                            $nome = trim($nomes[$i]);
                            $preco = floatval($precos[$i]);

                            $precoFinal = $preco;
                            $descontoAplicado = false;

                            if ($preco > 100.00) {
                                $precoFinal = $preco * 0.9;
                                $descontoAplicado = true;
                            }

                            $produtos[$codigo] = [
                                'nome' => $nome,
                                'preco_original' => $preco,
                                'preco_final' => round($precoFinal, 2),
                                'desconto' => $descontoAplicado
                            ];
                        }

                        uasort($produtos, function ($a, $b) {
                            return strcmp($a['nome'], $b['nome']);
                        });

                        if (!empty($produtos)) {
                            echo "<h4 class='text-center' style='color:white'>Produtos Ordenados por Nome:</h4>";
                            echo "<table class='table table-dark table-striped w-100' style='color:white'>";
                            echo "<thead><tr>
                                    <th style='color:white'>Código</th>
                                    <th style='color:white'>Nome</th>
                                    <th style='color:white'>Preço Original</th>
                                    <th style='color:white'>Preço com Desconto</th>
                                    <th style='color:white'>Situação</th>
                                  </tr></thead>";
                            echo "<tbody>";

                            foreach ($produtos as $codigo => $produto) {
                                $descontoText = $produto['desconto'] ? '10% de desconto' : 'Sem desconto';
                                $corSituacao = $produto['desconto'] ? 'text-success' : 'text-white';

                                echo "<tr>";
                                echo "<td style='color:white'>$codigo</td>";
                                echo "<td style='color:white'>{$produto['nome']}</td>";
                                echo "<td style='color:white'>R$ " . number_format($produto['preco_original'], 2, ',', '.') . "</td>";
                                echo "<td style='color:white'>R$ " . number_format($produto['preco_final'], 2, ',', '.') . "</td>";
                                echo "<td class='$corSituacao fw-bold'>$descontoText</td>";
                                echo "</tr>";
                            }

                            echo "</tbody></table>";

                            $totalDescontos = count(array_filter($produtos, function ($produto) {
                                return $produto['desconto'];
                            }));
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