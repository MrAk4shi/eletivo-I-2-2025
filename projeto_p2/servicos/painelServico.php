<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}

require("../conexao.php");

// Buscar o nome
$stmt = $pdo->prepare("SELECT nomeUsuario FROM usuario WHERE idUsuario = ?");
$stmt->execute([$_SESSION["usuario"]]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
$nomeUsuario = $usuario ? $usuario["nomeUsuario"] : "Usuário";

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel de Serviços</title>

    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="painelServico.css">
</head>

<body>

<div class="painel-container">

    <h2>Serviços — <strong><?php echo $nomeUsuario; ?></strong></h2>

    <p>Escolha uma opção abaixo:</p>

    <div class="botoes">
        <a href="listarServico.php" class="painel-btn">Listar Serviços</a>
        <a href="cadastrarServico.php" class="painel-btn">Cadastrar Serviço</a>
        <a href="editarServico.php" class="painel-btn">Editar Serviço</a>
        <a href="excluirServico.php" class="painel-btn">Excluir Serviço</a>
    </div>

    <a href="../painel.php" class="voltar">Voltar ao Painel</a>

</div>

</body>
</html>
