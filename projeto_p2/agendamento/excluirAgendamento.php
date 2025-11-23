<?php
require("../conexao.php");

$id = $_GET["id"] ?? 0;

$sql = $pdo->prepare("DELETE FROM agendamento WHERE idAgendamento = ?");
$sql->execute([$id]);

header("Location: listarAgendamento.php");
exit;
