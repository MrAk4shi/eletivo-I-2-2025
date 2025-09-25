<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cadastro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4">Cadastro</h2>
    <form>
      <div class="mb-3">
        <label for="nomeCadastro" class="form-label">Nome Completo</label>
        <input type="text" class="form-control" id="nomeCadastro" placeholder="Digite seu nome completo" required />
      </div>
      <div class="mb-3">
        <label for="emailCadastro" class="form-label">Email</label>
        <input type="email" class="form-control" id="emailCadastro" placeholder="Digite seu email" required />
      </div>
      <div class="mb-3">
        <label for="senhaCadastro" class="form-label">Senha</label>
        <input type="password" class="form-control" id="senhaCadastro" placeholder="Crie uma senha" required />
      </div>
      <div class="mb-3">
        <label for="confirmaSenhaCadastro" class="form-label">Confirme a Senha</label>
        <input type="password" class="form-control" id="confirmaSenhaCadastro" placeholder="Confirme sua senha" required />
      </div>
      <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
    <p class="mt-3">
      Já tem uma conta?
      <a href="index.php">Faça login aqui</a>
    </p>
  </div>
</body>
</html>
