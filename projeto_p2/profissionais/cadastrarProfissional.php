<?php
session_start();
require("../conexao.php");

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = $_POST["nomeProfissional"];
    $especialidade = $_POST["especialidade"];
    $telefone = $_POST["telefoneProfissional"];
    $email = $_POST["emailProfissional"];

    try {
        $sql = $pdo->prepare("INSERT INTO profissionais (nomeProfissional, especialidade, telefoneProfissional, emailProfissional) VALUES (?, ?, ?, ?)");
        $sql->execute([$nome, $especialidade, $telefone, $email]);

        header("Location: listarProfissional.php?sucesso=1");
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
    <title>Cadastrar Profissional</title>

    <link rel="stylesheet" href="styleProfissional.css?v=<?= time() ?>">

</head>
<body>

<div class="conteiner">
    <h2>Cadastrar Profissional</h2>

    <?php if ($mensagem): ?>
        <div class="erro"><?= $mensagem ?></div>
    <?php endif; ?>

    <form method="POST">

        <label>Nome:</label>
        <input type="text" name="nomeProfissional" required>

        <label>Especialidade:</label>
        <input type="text" name="especialidade">

        <label>Telefone:</label>
        <input type="text" name="telefoneProfissional">

        <label>Email:</label>
        <input type="email" name="emailProfissional">

        <button type="submit" class="btn">Salvar</button>
    </form>

    <a href="painelProfissional.php" class="voltar">Voltar</a>
</div>

</body>
</html>
