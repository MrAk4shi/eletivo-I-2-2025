<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ex 17 - Lista 1</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Ex 17 - Lista 1</h1>
<form method="post">
<div class="mb-3">
              <label for="capital" class="form-label">Insira o capital</label>
              <input type="float" id="capital" name="capital" class="form-control" required="">
            </div><div class="mb-3">
              <label for="taxa" class="form-label">Insira a taxa de juros em decimal</label>
              <input type="float" id="taxa" name="taxa" class="form-control" required="">
            </div><div class="mb-3">
              <label for="periodo" class="form-label">Insira o período em meses</label>
              <input type="number" id="periodo" name="periodo" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $capital = $_POST["capital"];
    $taxa = $_POST["taxa"];
    $periodo = $_POST["periodo"];
    $jurosSimples = $capital * $taxa * $periodo;
    echo "Os jures simples são: $jurosSimples";
    
    }
?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>