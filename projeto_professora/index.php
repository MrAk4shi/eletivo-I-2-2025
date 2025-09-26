<?php

    require("conexao.php"); //cria a variável pdo, se estiver nula não há conexão
    if($pdo){
        echo "Conexão realizada com sucesso!";
    }
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container mt-5">
    <?php
    if(isset($_GET['cadastro'])){
        $cadastro = $_GET['cadastro'];
        if($cadastro){
            echo "<p class='text-success'> Cadastro realizado com sucesso </p>";
        }
        else{
            echo "<p class='text-danger'> Erro ao realizar cadastro </p>";

        }
    }
    ?>
    <h2 class="mb-4">Acesso ao Sistema</h2>
    <form>
      <div class="mb-3">
        <label for="emailLogin" class="form-label">Email</label>
        <input type="email" class="form-control" id="emailLogin" placeholder="Digite seu email" required />
      </div>
      <div class="mb-3">
        <label for="senhaLogin" class="form-label">Senha</label>
        <input type="password" class="form-control" id="senhaLogin" placeholder="Digite sua senha" required />
      </div>
      <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
    <p class="mt-3">
      Não tem uma conta?
      <a href="cadastro.php">Cadastre-se aqui</a>
    </p>
  </div>
</body>
</html>
