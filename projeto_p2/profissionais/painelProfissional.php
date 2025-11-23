<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}

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
    <title>Painel de Profissionais</title>
    <link rel="stylesheet" href="painelProfissional.css">
</head>
<body>

<div class="painel-container">
    <h2>Profissionais — <strong><?= $nomeUsuario ?></strong></h2>
    <p>Escolha uma opção abaixo:</p>

    <a href="listarProfissional.php" class="painel-btn">Listar Profissionais</a>
    <a href="cadastrarProfissional.php" class="painel-btn">Cadastrar Profissional</a>
    <a href="editarProfissional.php" class="painel-btn">Editar Profissional</a>
    <a href="excluirProfissional.php" class="painel-btn">Excluir Profissional</a>

    <a href="../painel.php" class="voltar">Voltar ao Painel</a>
</div>

</body>
</html>
