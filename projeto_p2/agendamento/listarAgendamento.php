<?php
session_start();
require("../conexao.php");

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}

$sql = $pdo->query("
    SELECT a.*, c.nomeCliente, p.nomeProfissional, s.nomeServico
    FROM agendamento a
    JOIN cliente c ON a.cliente_idCliente = c.idCliente
    JOIN profissionais p ON a.profissionais_idProfissionais = p.idProfissionais
    JOIN servicos s ON a.servicos_idServico = s.idServico
");
$lista = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agendamentos</title>
    <link rel="stylesheet" href="styleAgendamento.css">
</head>
<body>

<div class="container">
<h2>Lista de Agendamentos</h2>

<table class="tabela-roxa">
    <tr>
        <th>ID</th>
        <th>Data</th>
        <th>Início</th>
        <th>Fim</th>
        <th>Status</th>
        <th>Cliente</th>
        <th>Profissional</th>
        <th>Serviço</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($lista as $a): ?>
    <tr>
        <td><?= $a["idAgendamento"] ?></td>
        <td><?= $a["dataAgendamento"] ?></td>
        <td><?= $a["inicioServico"] ?></td>
        <td><?= $a["fimServico"] ?></td>
        <td><?= $a["status"] ?></td>
        <td><?= $a["nomeCliente"] ?></td>
        <td><?= $a["nomeProfissional"] ?></td>
        <td><?= $a["nomeServico"] ?></td>

        <td>
            <a href="editarAgendamento.php?id=<?= $a['idAgendamento'] ?>" class="btn-table edit">Editar</a>
            <a href="excluirAgendamento.php?id=<?= $a['idAgendamento'] ?>" class="btn-table delete"
            onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<a href="painelAgendamento.php" class="voltar">Voltar</a>
</div>
</body>
</html>
