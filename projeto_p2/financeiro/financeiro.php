<?php
session_start();
require("../conexao.php");

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}

// Total arrecadado
$sql = $pdo->query("
    SELECT SUM(s.precoServico) AS total
    FROM agendamento a
    JOIN servicos s ON a.servicos_idServico = s.idServico
");
$totalFaturado = $sql->fetch(PDO::FETCH_ASSOC)["total"] ?? 0;

// Totais por serviço
$sql = $pdo->query("
    SELECT s.nomeServico, COUNT(*) AS qtd, SUM(s.precoServico) AS total
    FROM agendamento a
    JOIN servicos s ON a.servicos_idServico = s.idServico
    GROUP BY s.nomeServico
");
$porServico = $sql->fetchAll(PDO::FETCH_ASSOC);

// Totais por profissional
$sql = $pdo->query("
    SELECT p.nomeProfissional, COUNT(*) AS qtd, SUM(s.precoServico) AS total
    FROM agendamento a
    JOIN profissionais p ON a.profissionais_idProfissionais = p.idProfissionais
    JOIN servicos s ON a.servicos_idServico = s.idServico
    GROUP BY p.nomeProfissional
");
$porProfissional = $sql->fetchAll(PDO::FETCH_ASSOC);

// Agendamentos recentes
$sql = $pdo->query("
    SELECT a.idAgendamento, a.dataAgendamento, a.status, 
           c.nome AS nomeCliente, s.nomeServico, s.precoServico
    FROM agendamento a
    JOIN cliente c ON a.cliente_idCliente = c.idCliente
    JOIN servicos s ON a.servicos_idServico = s.idServico
    ORDER BY a.idAgendamento DESC LIMIT 5
");
$recentes = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Financeiro</title>
    <link rel="stylesheet" href="styleFinanceiro.css">
</head>
<body>

<div class="container">
    <h2>Relatório Financeiro</h2>

    <div class="box-total">
        <h3>Total Faturado</h3>
        <p class="valor">R$ <?= number_format($totalFaturado, 2, ',', '.') ?></p>
    </div>

    <h3>Faturamento por Serviço</h3>
    <table>
        <tr>
            <th>Serviço</th>
            <th>Qtd Agendamentos</th>
            <th>Total</th>
        </tr>
        <?php foreach ($porServico as $s): ?>
        <tr>
            <td><?= $s["nomeServico"] ?></td>
            <td><?= $s["qtd"] ?></td>
            <td>R$ <?= number_format($s["total"], 2, ',', '.') ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Faturamento por Profissional</h3>
    <table>
        <tr>
            <th>Profissional</th>
            <th>Qtd Atendimentos</th>
            <th>Total Recebido</th>
        </tr>
        <?php foreach ($porProfissional as $p): ?>
        <tr>
            <td><?= $p["nomeProfissional"] ?></td>
            <td><?= $p["qtd"] ?></td>
            <td>R$ <?= number_format($p["total"], 2, ',', '.') ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Últimos Agendamentos</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th>Cliente</th>
            <th>Serviço</th>
            <th>Valor</th>
            <th>Status</th>
        </tr>
        <?php foreach ($recentes as $r): ?>
        <tr>
            <td><?= $r["idAgendamento"] ?></td>
            <td><?= $r["dataAgendamento"] ?></td>
            <td><?= $r["nomeCliente"] ?></td>
            <td><?= $r["nomeServico"] ?></td>
            <td>R$ <?= number_format($r["precoServico"], 2, ',', '.') ?></td>
            <td><?= $r["status"] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <a href="../painel.php" class="voltar">Voltar ao Painel</a>
</div>

</body>
</html>
