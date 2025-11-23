<?php
session_start();

// Impedir acesso sem login
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

require("conexao.php");

// Buscar nome do usuário logado
$stmt = $pdo->prepare("SELECT nomeUsuario FROM usuario WHERE idUsuario = ?");
$stmt->execute([$_SESSION["usuario"]]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
$nomeUsuario = $usuario ? $usuario["nomeUsuario"] : "Usuário";

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel do Sistema</title>

  <!-- CSS global -->
  <link rel="stylesheet" href="style.css">

  <!-- CSS exclusivo do painel -->
  <link rel="stylesheet" href="painel.css">
</head>

<body>

<div class="painel-container">

  <h2>Bem-vindo, <strong><?php echo $nomeUsuario; ?></strong></h2>
  <p>Escolha uma opção abaixo:</p>

  <!--CRUDs-->
<a href="clientes/painelCliente.php" class="painel-btn">Gerenciar Clientes</a>
<a href="servicos/painelServico.php" class="painel-btn">Gerenciar Serviços</a>
<a href="profissionais/painelProfissional.php" class="painel-btn">Gerenciar Profissionais</a>
<!--NÃO CRUD-->
<a href="agendamento/painelAgendamento.php" class="painel-btn">Agendamentos</a>
<a href="financeiro/financeiro.php" class="painel-btn">Financeiro</a>


  <a href="logout.php" class="logout">Sair</a>

</div>

</body>
</html>
