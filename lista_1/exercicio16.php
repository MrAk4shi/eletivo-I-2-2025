<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Ex 16 - Lista 1</h1>
<form method="post">
<div class="mb-3">
              <label for="preco" class="form-label">Insira o preço</label>
              <input type="float" id="preco" name="preco" class="form-control" required="">
            </div><div class="mb-3">
              <label for="desconto" class="form-label">Insira o desconto em %</label>
              <input type="float" id="desconto" name="desconto" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $preco = $_POST["preco"];
    $desconto = $_POST["desconto"] / 100;
    $valorDescontado = $preco * $desconto;
    $novoPreco = $preco - $valorDescontado; 
    echo "Novo preço: $novoPreco";
    
    }
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>