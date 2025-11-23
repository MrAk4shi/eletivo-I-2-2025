<?php
session_start();
require("../conexao.php");

// Impedir acesso sem login
if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}

// Verifica se foi passado um ID
if (!isset($_GET["id"])) {
    header("Location: listarServico.php");
    exit;
}

$id = $_GET["id"];

// Buscar o serviço antes de excluir
$sql = $pdo->prepare("SELECT * FROM servicos WHERE idServico = ?");
$sql->execute([$id]);
$servico = $sql->fetch(PDO::FETCH_ASSOC);

// Se não existir, voltar
if (!$servico) {
    die("Serviço não encontrado.");
}

// Se enviou o POST, excluir de fato
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $delete = $pdo->prepare("DELETE FROM servicos WHERE idServico = ?");
    $delete->execute([$id]);

    header("Location: listarServico.php?excluido=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Excluir Serviço</title>
    <link rel="stylesheet" href="styleServico.css">
</head>
<body>

<div class="conteiner">
    <h2>Excluir Serviço</h2>

    <p>Tem certeza que deseja excluir o serviço abaixo?</p>

    <div class="confirm-box">
        <strong>ID:</strong> <?= $servico['idServico'] ?><br>
        <strong>Nome:</strong> <?= $servico['nomeServico'] ?><br>
        <strong>Descrição:</strong> <?= $servico['descricaoServico'] ?><br>
        <strong>Preço:</strong> R$ <?= number_format($servico['precoServico'], 2, ',', '.') ?><br>
    </div>

    <form method="POST">
        <button type="submit" class="btn btn-danger">Excluir</button>
        <a href="listarServico.php" class="btn btn-secondary">Cancelar</a>
    </form>

</div>

</body>
</html>
