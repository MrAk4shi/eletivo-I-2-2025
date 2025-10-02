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
            <h1 style="color:white">Exercício 2</h1>
            <div class="m-5 flex-column align-items-center">
                <form method="post">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <h5 class="text-center mb-3" style="color:white">Aluno <?= $i ?></h5>
                        <div class="mb-3">
                            <label for="nome<?= $i ?>" class="form-label" style="color:white">Nome do Aluno <?= $i ?>:</label>
                            <input type="text" id="nome<?= $i ?>" name="nomes[]" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="nota1_<?= $i ?>" class="form-label" style="color:white">Nota 1:</label>
                            <input type="number" step="0.1" min="0" max="10" id="nota1_<?= $i ?>" name="notas1[]" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="nota2_<?= $i ?>" class="form-label" style="color:white">Nota 2:</label>
                            <input type="number" step="0.1" min="0" max="10" id="nota2_<?= $i ?>" name="notas2[]" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="nota3_<?= $i ?>" class="form-label" style="color:white">Nota 3:</label>
                            <input type="number" step="0.1" min="0" max="10" id="nota3_<?= $i ?>" name="notas3[]" class="form-control" required>
                        </div>
                        <hr style="border-color: white;">
                    <?php endfor; ?>
                    <div class="d-flex justify-content-center align-center">
                        <button type="submit" class="btn btn-dark">Calcular Médias</button>
                    </div>
                </form>
                <div class="mt-5 d-flex flex-column align-items-center gap-2" style="color:white">

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        $nomes = $_POST['nomes'];
                        $notas1 = $_POST['notas1'];
                        $notas2 = $_POST['notas2'];
                        $notas3 = $_POST['notas3'];

                        $alunos = [];

                        for ($i = 0; $i < 5; $i++) {
                            $nome = trim($nomes[$i]);
                            $nota1 = floatval($notas1[$i]);
                            $nota2 = floatval($notas2[$i]);
                            $nota3 = floatval($notas3[$i]);

                            $media = ($nota1 + $nota2 + $nota3) / 3;

                            $alunos[$nome] = round($media, 2);
                        }

                        arsort($alunos);

                        if (!empty($alunos)) {
                            echo "<h4 class='text-center' style='color:white'>Alunos Ordenados por Média (Maior para Menor):</h4>";
                            echo "<table class='table table-dark table-striped w-100' style='color:white'>";
                            echo "<thead><tr><th style='color:white'>Posição</th><th style='color:white'>Nome</th><th style='color:white'>Média</th><th style='color:white'>Situação</th></tr></thead>";
                            echo "<tbody>";

                            $posicao = 1;
                            foreach ($alunos as $nome => $media) {
                                $situacao = $media >= 6 ? 'Aprovado' : 'Reprovado';
                                $corSituacao = $media >= 6 ? 'text-success' : 'text-danger';

                                echo "<tr>";
                                echo "<td style='color:white'>$posicao °</td>";
                                echo "<td style='color:white'>$nome</td>";
                                echo "<td style='color:white'>$media</td>";
                                echo "<td class='$corSituacao fw-bold'>$situacao</td>";
                                echo "</tr>";

                                $posicao++;
                            }

                            echo "</tbody></table>";
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