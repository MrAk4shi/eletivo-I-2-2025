<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel de Agendamentos</title>
    <link rel="stylesheet" href="styleAgendamento.css">
</head>
<body>

<div class="container">
    <h2>Painel de Agendamentos</h2>

    <a href="cadastrarAgendamento.php" class="btn">Cadastrar Agendamento</a>
    <a href="listarAgendamento.php" class="btn">Listar Agendamentos</a>
    <a href="../painel.php" class="btn voltar">Voltar</a>
</div>

</body>
</html>
