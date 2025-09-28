
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include "navbar.php"; ?>
    </div>
    <div class="p-5">
    <div class="caixa" style="background: rgba(0,0,0,0.7); border-radius: 16px; padding: 32px;">
            <h1 style="color:white">Exercício 2</h1>
            <div class="m-5 flex-column align-items-center">
                <form method="post">
                    <div class="mb-3">
                        <label for="valor" class="form-label" style="color:white">Digite uma palavra: </label>
                        <input type="text" id="valor" name="valor" class="form-control" required="">
                    </div>
                    <div class="d-flex justify-content-center align-center">
                        <button type="submit" class="btn btn-dark">Enviar</button>
                    </div>
                </form>
                <div class="mt-5 d-flex flex-column align-items-center gap-2" style="color:white">

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        $valor = $_POST['valor'];
                        $minusculo = strtolower($valor);
                        $maiusculo = strtoupper($valor);
                        echo "<p>$maiusculo</p>";
                        echo "<p>$minusculo</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
