<?php
session_start();
require("../conexao.php"); 

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];
    $email = $_POST["email"];

    try {
        $sql = $pdo->prepare("INSERT INTO cliente (nome, cpf, telefone, endereco, email) VALUES (?, ?, ?, ?, ?)");
        $sql->execute([$nome, $cpf, $telefone, $endereco, $email]);
        header("Location: listarCliente.php?sucesso=1");
        exit;
    } catch (Exception $e) {
        $mensagem = "Erro ao cadastrar: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Cliente</title>
    <link rel="stylesheet" href="painelCliente.css">
    <link rel="stylesheet" href="styleCliente.css">

</head>
<body>

<div class="conteiner">
    <h2>Cadastrar Cliente</h2>

    <?php if ($mensagem): ?>
        <div class="erro"><?= $mensagem ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" required>

        <label>CPF:</label>
        <input type="text" name="cpf">

        <label>Telefone:</label>
        <input type="text" name="telefone">

        <label>Endereço:</label>
        <input type="text" name="endereco">

        <label>Email:</label>
        <input type="email" name="email">

        <button type="submit" class="btn">Salvar</button>
    </form>

    <a href="painelCliente.php" class="voltar">Voltar</a>
</div>

</body>
</html>
