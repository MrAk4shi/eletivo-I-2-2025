<?php
session_start();
require("../conexao.php");

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}

$servicos = $pdo->query("SELECT * FROM servicos ORDER BY idServico ASC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listar Serviços</title>
    <link rel="stylesheet" href="styleServico.css">
</head>
<body>

<div class="conteiner">
    <h2>Lista de Serviços</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Valor</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($servicos as $s): ?>
            <tr>
                <td><?= $s["idServico"] ?></td>
                <td><?= $s["nomeServico"] ?></td>
                <td><?= $s["descricaoServico"] ?></td>
                <td>R$ <?= number_format($s["precoServico"], 2, ",", ".") ?></td>

                <td class="acao">
                    <a href="editarServico.php?id=<?= $s['idServico'] ?>">Editar</a>
                    <a href="excluirServico.php?id=<?= $s['idServico'] ?>">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="painelServico.php" class="voltar">Voltar</a>
</div>

</body>
</html>
