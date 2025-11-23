<?php
session_start();
require("../conexao.php");

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}

$id = $_GET["id"] ?? 0;

// BUSCA O AGENDAMENTO
$sql = $pdo->prepare("
    SELECT * FROM agendamento WHERE idAgendamento = ?
");
$sql->execute([$id]);
$ag = $sql->fetch(PDO::FETCH_ASSOC);

if (!$ag) {
    echo "Agendamento não encontrado!";
    exit;
}

// BUSCA LISTAS
$clientes = $pdo->query("SELECT idCliente, nomeCliente FROM cliente")->fetchAll(PDO::FETCH_ASSOC);
$profissionais = $pdo->query("SELECT idProfissionais, nomeProfissional FROM profissionais")->fetchAll(PDO::FETCH_ASSOC);
$servicos = $pdo->query("SELECT idServico, nomeServico FROM servicos")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Agendamento</title>
    <link rel="stylesheet" href="styleAgendamento.css">
</head>
<body>

<div class="container">

    <h2>Editar Agendamento</h2>

    <form method="POST" action="editarAgendamento_action.php">

        <input type="hidden" name="id" value="<?= $ag['idAgendamento'] ?>">

        <label>Data do Agendamento:</label>
        <input type="date" name="dataAgendamento" value="<?= $ag['dataAgendamento'] ?>" required>

        <label>Início do Serviço:</label>
        <input type="datetime-local" name="inicioServico" value="<?= str_replace(" ", "T", $ag['inicioServico']) ?>" required>

        <label>Fim do Serviço:</label>
        <input type="datetime-local" name="fimServico" value="<?= str_replace(" ", "T", $ag['fimServico']) ?>" required>

        <label>Status:</label>
        <select name="status">
            <option value="Pendente" <?= $ag['status']=="Pendente"?"selected":"" ?>>Pendente</option>
            <option value="Em andamento" <?= $ag['status']=="Em andamento"?"selected":"" ?>>Em andamento</option>
            <option value="Concluído" <?= $ag['status']=="Concluído"?"selected":"" ?>>Concluído</option>
        </select>

        <label>Observações:</label>
        <textarea name="observacoes"><?= $ag['observacoes'] ?></textarea>

        <label>Cliente:</label>
        <select name="cliente" required>
            <?php foreach ($clientes as $c): ?>
                <option value="<?= $c['idCliente'] ?>" <?= $ag['cliente_idCliente']==$c['idCliente']?"selected":"" ?>>
                    <?= $c['nomeCliente'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Profissional:</label>
        <select name="profissional" required>
            <?php foreach ($profissionais as $p): ?>
                <option value="<?= $p['idProfissionais'] ?>" <?= $ag['profissionais_idProfissionais']==$p['idProfissionais']?"selected":"" ?>>
                    <?= $p['nomeProfissional'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Serviço:</label>
        <select name="servico" required>
            <?php foreach ($servicos as $s): ?>
                <option value="<?= $s['idServico'] ?>" <?= $ag['servicos_idServico']==$s['idServico']?"selected":"" ?>>
                    <?= $s['nomeServico'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="btn">Salvar Alterações</button>
    </form>

    <a href="listarAgendamento.php" class="voltar">Voltar</a>

</div>

</body>
</html>
