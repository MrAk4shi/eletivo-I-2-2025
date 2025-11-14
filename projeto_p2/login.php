<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="form-container">
    <h2 class="form-title">Login</h2>

    <form action="login.php" method="POST">
      
      <div class="input-group">
        <label for="emailLogin">Email</label>
        <input 
          type="email" 
          id="emailLogin" 
          name="email"
          placeholder="Digite seu email"
          required
        >
      </div>

      <div class="input-group">
        <label for="senhaLogin">Senha</label>
        <input 
          type="password" 
          id="senhaLogin" 
          name="senha"
          placeholder="Digite sua senha"
          required
        >
      </div>

      <button type="submit" class="btn-primary">Entrar</button>
    </form>

    <p class="text-small">
      Ainda não tem conta?
      <a href="cadastro.php">Criar conta</a>
    </p>
  </div>
  <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        require("conexao.php");

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        try {
            $stmt = $pdo->prepare("SELECT * FROM usuario WHERE emailUsuario = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($senha, $user['senhaHash'])) {
                // login OK → criar sessão e redirecionar
                session_start();
                $_SESSION["usuario"] = $user["idUsuario"];
                header("Location: painel.php");
                exit;
            } else {
                echo "<p style='text-align:center;color:red;margin-top:10px;'>Email ou senha incorretos.</p>";
            }

        } catch (Exception $e) {
            echo "Erro ao executar SQL: " . $e->getMessage();
        }

    }
?>


  
</body>
</html>
