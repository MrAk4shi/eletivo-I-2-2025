<?php
session_start();
require("../conexao.php");

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}

$clientes = $pdo->query("SELECT idCliente, nome FROM cliente")->fetchAll(PDO::FETCH_ASSOC);
$profissionais = $pdo->query("SELECT idProfissionais, nomeProfissional FROM profissionais")->fetchAll(PDO::FETCH_ASSOC);
$servicos = $pdo->query("SELECT idServico, nomeServico FROM servicos")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Agendamento</title>
    <link rel="stylesheet" href="cadastrarAgendamento.css?v=<?= time() ?>">
</head>
<body>

<div class="container">

    <h2>Cadastrar Agendamento</h2>

    <form method="POST" action="cadastrarAgendamento_action.php">

        <label>Data do Agendamento:</label>
        <input type="date" name="dataAgendamento" required>

        <label>Início do Serviço:</label>
        <input type="datetime-local" name="inicioServico" required>

        <label>Fim do Serviço:</label>
        <input type="datetime-local" name="fimServico" required>

        <label>Status:</label>
        <select name="status">
            <option value="Pendente">Pendente</option>
            <option value="Em andamento">Em andamento</option>
            <option value="Concluído">Concluído</option>
        </select>

        <label>Observações:</label>
        <textarea name="observacoes"></textarea>

        <label>Cliente:</label>
        <select name="cliente" required>
            <option value="">Selecione</option>
            <?php foreach ($clientes as $c): ?>
                <option value="<?= $c['idCliente'] ?>"><?= $c['nome'] ?></option>
            <?php endforeach; ?>
        </select>

        <label>Profissional:</label>
        <select name="profissional" required>
            <option value="">Selecione</option>
            <?php foreach ($profissionais as $p): ?>
                <option value="<?= $p['idProfissionais'] ?>"><?= $p['nomeProfissional'] ?></option>
            <?php endforeach; ?>
        </select>

        <label>Serviço:</label>
        <select name="servico" required>
            <option value="">Selecione</option>
            <?php foreach ($servicos as $s): ?>
                <option value="<?= $s['idServico'] ?>"><?= $s['nomeServico'] ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="btn">Salvar</button>
    </form>

    <a href="painelAgendamento.php" class="voltar">Voltar</a>

</div>

</body>
</html>
