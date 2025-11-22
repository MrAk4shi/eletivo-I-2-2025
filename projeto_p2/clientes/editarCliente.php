<?php
session_start();

// Impedir acesso sem login
if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}

require("../conexao.php");

// Se usuário clicou em "Buscar Cliente"
$cliente = null;
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $stmt = $pdo->prepare("SELECT * FROM cliente WHERE idCliente = ?");
    $stmt->execute([$id]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Se usuário enviou o formulário de atualização
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["idCliente"];
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];
    $email = $_POST["email"];

    $stmt = $pdo->prepare("
        UPDATE cliente 
        SET nome = ?, cpf = ?, telefone = ?, endereco = ?, email = ?
        WHERE idCliente = ?
    ");

    if ($stmt->execute([$nome, $cpf, $telefone, $endereco, $email, $id])) {
        header("Location: listarCliente.php?msg=editado");
        exit;
    } else {
        $erro = "Erro ao atualizar o cliente!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>

    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="styleCliente.css">
</head>

<body>

<div class="container">
    <h2>Editar Cliente</h2>

    <!-- Formulário de busca -->
    <form method="GET" class="form-box">
        <label>ID do Cliente:</label>
        <input type="number" name="id" required>
        <button type="submit">Buscar</button>
    </form>

    <?php if ($cliente): ?>
        <form method="POST" class="form-box">

            <input type="hidden" name="idCliente" value="<?= $cliente['idCliente'] ?>">

            <label>Nome:</label>
            <input type="text" name="nome" value="<?= $cliente['nome'] ?>" required>

            <label>CPF:</label>
            <input type="text" name="cpf" value="<?= $cliente['cpf'] ?>">

            <label>Telefone:</label>
            <input type="text" name="telefone" value="<?= $cliente['telefone'] ?>">

            <label>Endereço:</label>
            <input type="text" name="endereco" value="<?= $cliente['endereco'] ?>">

            <label>Email:</label>
            <input type="email" name="email" value="<?= $cliente['email'] ?>">

            <button type="submit">Salvar Alterações</button>
        </form>
    <?php endif; ?>

    <a href="painelCliente.php" class="voltar">Voltar</a>
</div>

</body>
</html>
