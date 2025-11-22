<?php
session_start();
require("../conexao.php");

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM cliente ORDER BY nome ASC");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sucesso = isset($_GET["sucesso"]);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Clientes</title>
    <link rel="stylesheet" href="painelCliente.css">
    <link rel="stylesheet" href="styleCliente.css">

</head>
<body>

<div class="conteiner">

    <h2>Lista de Clientes</h2>

    <?php if ($sucesso): ?>
        <p class="sucesso">Operação realizada com sucesso!</p>
    <?php endif; ?>

    <a href="cadastrarCliente.php" class="btn">+ Novo Cliente</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td><?= $cliente["idCliente"] ?></td>
                <td><?= $cliente["nome"] ?></td>
                <td><?= $cliente["telefone"] ?></td>
                <td><?= $cliente["email"] ?></td>

                <td>
                    <a href="editarCliente.php?id=<?= $cliente['idCliente'] ?>" class="acao editar">Editar</a>
                    <a href="excluirCliente.php?id=<?= $cliente['idCliente'] ?>" class="acao excluir" onclick="return confirm('Excluir este cliente?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

    <a href="painelCliente.php" class="voltar">Voltar</a>

</div>

</body>
</html>
