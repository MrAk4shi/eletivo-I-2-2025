<?php
require("../conexao.php");

$data = $_POST["dataAgendamento"];
$inicio = $_POST["inicioServico"];
$fim = $_POST["fimServico"];
$status = $_POST["status"];
$obs = $_POST["observacoes"];
$cliente = $_POST["cliente"];
$prof = $_POST["profissional"];
$servico = $_POST["servico"];

$sql = $pdo->prepare("INSERT INTO agendamento 
(dataAgendamento, inicioServico, fimServico, status, observacoes, cliente_idCliente, profissionais_idProfissionais, servicos_idServico)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$sql->execute([$data, $inicio, $fim, $status, $obs, $cliente, $prof, $servico]);

header("Location: listarAgendamento.php");
exit;
