<?php
session_start();
require("../conexao.php");

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recebe valores somente se existirem
    $idServico = $_POST["idServico"] ?? null;
    $nomeServico = $_POST["nomeServico"] ?? null;
    $descricaoServico = $_POST["descricaoServico"] ?? null;
    $precoServico = $_POST["precoServico"] ?? null;

    if ($idServico && $nomeServico && $descricaoServico && $precoServico) {

        try {
            $sql = $pdo->prepare("
                INSERT INTO servicos (idServico, nomeServico, descricaoServico, precoServico)
                VALUES (?, ?, ?, ?)
            ");

            $sql->execute([$idServico, $nomeServico, $descricaoServico, $precoServico]);

            header("Location: listarServico.php?sucesso=1");
            exit;

        } catch (Exception $e) {
            $mensagem = "Erro ao cadastrar: " . $e->getMessage();
        }

    } else {
        $mensagem = "Preencha todos os campos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Serviço</title>

    <!-- CSS do painel (global do CRUD) -->
    <link rel="stylesheet" href="painelServico.css">

    <!-- CSS exclusivo do formulário -->
    <link rel="stylesheet" href="styleServico.css">
</head>
<body>

<div class="conteiner">

    <h2>Cadastrar Serviço</h2>

    <?php if ($mensagem): ?>
        <div class="erro"><?= $mensagem ?></div>
    <?php endif; ?>

    <form method="POST">

        <label>ID do Serviço:</label>
        <input type="number" name="idServico" required>

        <label>Nome do Serviço:</label>
        <input type="text" name="nomeServico" required>

        <label>Descrição:</label>
        <textarea name="descricaoServico" required></textarea>

        <label>Preço do Serviço:</label>
        <input type="number" step="0.01" name="precoServico" required>

        <button type="submit" class="btn">Salvar</button>
    </form>

    <a href="painelServico.php" class="voltar">Voltar</a>

</div>

</body>
</html>
