<?php
session_start();
require("../conexao.php");

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET["id"])) {
    header("Location: listarServico.php");
    exit;
}

$id = $_GET["id"];

// Buscar serviço existente
$sql = $pdo->prepare("SELECT * FROM servicos WHERE idServico = ?");
$sql->execute([$id]);
$servico = $sql->fetch(PDO::FETCH_ASSOC);

if (!$servico) {
    die("Serviço não encontrado.");
}

// Atualizar no banco
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nomeServico"];
    $descricao = $_POST["descricaoServico"];
    $valor = $_POST["precoServico"];

    $update = $pdo->prepare("
        UPDATE servicos 
        SET nomeServico=?, descricaoServico=?, precoServico=? 
        WHERE idServico=?
    ");

    $update->execute([$nome, $descricao, $valor, $id]);

    header("Location: listarServico.php?editado=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Serviço</title>
    <link rel="stylesheet" href="styleServico.css">
</head>
<body>

<div class="conteiner">
    <h2>Editar Serviço</h2>

    <form method="POST">
        <label>Nome:</label>
        <input type="text" name="nomeServico" value="<?= $servico['nomeServico'] ?>" required>

        <label>Descrição:</label>
        <input type="text" name="descricaoServico" value="<?= $servico['descricaoServico'] ?>">

        <label>Valor:</label>
        <input type="number" step="0.01" name="precoServico" value="<?= $servico['precoServico'] ?>" required>

        <button type="submit" class="btn">Salvar alterações</button>
    </form>

    <a href="listarServico.php" class="voltar">Voltar</a>
</div>

</body>
</html>
