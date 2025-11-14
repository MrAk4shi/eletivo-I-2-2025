<?php
session_start();

// Impedir acesso sem login
if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}

// Buscar nome do usuário logado
require("../conexao.php");

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
    <title>Painel de Clientes</title>

    <!-- CSS global -->
    <link rel="stylesheet" href="../style.css">

    <!-- CSS exclusivo do painel de clientes -->
    <link rel="stylesheet" href="painelCliente.css">
</head>

<body>

<div class="painel-container">

    <h2>Clientes — <strong><?php echo $nomeUsuario; ?></strong></h2>
    <p>Escolha uma opção abaixo:</p>

    <a href="listarCliente.php" class="painel-btn">Listar Clientes</a>
    <a href="cadastrarCliente.php" class="painel-btn">Cadastrar Cliente</a>
    <a href="editarCliente.php" class="painel-btn">Editar Cliente</a>
    <a href="excluirCliente.php" class="painel-btn">Excluir Cliente</a>

    <a href="../painel.php" class="logout">Voltar ao Painel</a>

</div>

</body>
</html>
