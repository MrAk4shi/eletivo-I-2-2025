<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include "navbar.php"; ?>
    <div class="p-5">
        <div class="caixa">
            <h1 style="color:white">Exercício 5</h1>
            <div class="m-5 flex-column align-items-center">
                <form method="post">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <h5 class="text-center mb-3" style="color:white">Livro <?= $i ?></h5>
                        <div class="mb-3">
                            <label for="titulo<?= $i ?>" class="form-label" style="color:white">Título do Livro <?= $i ?>:</label>
                            <input type="text" id="titulo<?= $i ?>" name="titulos[]" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="estoque<?= $i ?>" class="form-label" style="color:white">Quantidade em Estoque:</label>
                            <input type="number" min="0" id="estoque<?= $i ?>" name="estoques[]" class="form-control" required>
                        </div>
                        <hr style="border-color: white;">
                    <?php endfor; ?>
                    <div class="d-flex justify-content-center align-center">
                        <button type="submit" class="btn btn-dark">Verificar Estoque</button>
                    </div>
                </form>
                <div class="mt-5 d-flex flex-column align-items-center gap-2" style="color:white">

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        $titulos = $_POST['titulos'];
                        $estoques = $_POST['estoques'];

                        $livros = [];
                        $alertas = [];

                        for ($i = 0; $i < 5; $i++) {
                            $titulo = trim($titulos[$i]);
                            $estoque = intval($estoques[$i]);

                            $livros[$titulo] = $estoque;

                            if ($estoque < 5) {
                                $alertas[] = [
                                    'titulo' => $titulo,
                                    'estoque' => $estoque,
                                    'gravidade' => $estoque == 0 ? 'critico' : ($estoque < 3 ? 'alto' : 'medio')
                                ];
                            }
                        }

                        ksort($livros);

                        if (!empty($alertas)) {
                            echo "<div class='alert alert-danger w-100'>";
                            echo "<h5 class='text-center'>Alertas de Estoque Baixo</h5>";

                            foreach ($alertas as $alerta) {
                                $classe = $alerta['gravidade'] == 'critico' ? 'fw-bold' : '';

                                echo "<p class='mb-1 $classe'><b>{$alerta['titulo']}</b> - Estoque: {$alerta['estoque']} unidades</p>";
                            }

                            echo "</div>";
                        }

                        if (!empty($livros)) {
                            echo "<h4 class='text-center' style='color:white'>Livros Ordenados por Título:</h4>";
                            echo "<table class='table table-dark table-striped w-100' style='color:white'>";
                            echo "<thead><tr>
                                    <th style='color:white'>Título do Livro</th>
                                    <th style='color:white'>Quantidade em Estoque</th>
                                    <th style='color:white'>Status</th>
                                  </tr></thead>";
                            echo "<tbody>";

                            foreach ($livros as $titulo => $estoque) {
                                $status = $estoque >= 5 ? 'Normal' : 'Estoque Baixo';
                                $corStatus = $estoque >= 5 ? 'text-success' : ($estoque == 0 ? 'text-danger fw-bold' : ($estoque < 3 ? 'text-warning' : 'text-warning'));

                                echo "<tr>";
                                echo "<td style='color:white'>$titulo</td>";
                                echo "<td style='color:white'>$estoque unidades</td>";
                                echo "<td class='$corStatus'> $status</td>";
                                echo "</tr>";
                            }

                            echo "</tbody></table>";

                            $totalLivros = array_sum($estoques);
                            $livrosComAlerta = count($alertas);
                            $livrosNormais = count($livros) - $livrosComAlerta;
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