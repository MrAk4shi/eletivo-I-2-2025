<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cadastro de Usuário</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- CSS externo -->
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="card">
    <h2>Cadastro de Usuário</h2>

    <form action="" method="POST">
      <div class="mb-3">
        <label for="nomeCadastro" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nomeCadastro" name="nome" placeholder="Digite seu nome completo" required />
      </div>

      <div class="mb-3">
        <label for="emailCadastro" class="form-label">Email</label>
        <input type="email" class="form-control" id="emailCadastro" name="email" placeholder="Digite seu email" required />
      </div>

      <div class="mb-3">
        <label for="senhaCadastro" class="form-label">Senha</label>
        <input type="password" class="form-control" id="senhaCadastro" name="senha" placeholder="Crie uma senha" required />
      </div>

      <button type="submit" class="btn btn-custom mt-2">Cadastrar</button>

      <p class="text-center text-muted mt-3">
        Já tem uma conta? <a href="login.php">Faça login</a>
      </p>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

      require("conexao.php");

      $nome = $_POST['nome'];
      $email = $_POST['email'];
      $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
      $dataCriacao = date('Y-m-d H:i:s');

      try {
        $stmt = $pdo->prepare("
            INSERT INTO usuario (nomeUsuario, emailUsuario, senhaHash, dataCriacao) 
            VALUES (?, ?, ?, ?)
        ");

        if ($stmt->execute([$nome, $email, $senha, $dataCriacao])) {

          // Pega o ID do usuário recém-criado
          $idUsuario = $pdo->lastInsertId();

          // Salva na sessão
          $_SESSION["usuario"] = $idUsuario;

          // Redireciona para o painel
          header("Location: painel.php");
          exit;
        } else {
          echo '<div class="alert alert-danger">Erro ao cadastrar. Tente novamente.</div>';
        }
      } catch (Exception $e) {
        echo '<div class="alert alert-danger">Erro: ' . $e->getMessage() . '</div>';
      }
    }
    ?>
  </div>
</body>
</html>
