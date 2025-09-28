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
            <h1 style="color:white">Exercício 3</h1>
            <div class="m-5 flex-column align-items-center">
                <form method="post">
                    <div class="mb-3">
                        <label for="valor1" class="form-label" style="color:white">Digite a primeira palavra: </label>
                        <input type="text" id="valor1" name="valor1" class="form-control" required="">
                    </div>
                    <div class="mb-3">
                        <label for="valor2" class="form-label" style="color:white">Digite a segunda palavra: </label>
                        <input type="text" id="valor2" name="valor2" class="form-control" required="">
                    </div>
                    <div class="d-flex justify-content-center align-center">
                        <button type="submit" class="btn btn-dark">Enviar</button>
                    </div>
                </form>
                <div class="mt-5 d-flex flex-column align-items-center gap-2" style="color:white">

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        $valor1 = $_POST['valor1'];
                        $valor2 = $_POST['valor2'];
                        if(str_contains($valor1, $valor2)){
                            echo "<p>A palavra $valor2 está contida na palavra $valor1.</p>";
                        } else{
                            echo "<p>A palavra $valor2 não está contida na palavra $valor1.</p>";
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