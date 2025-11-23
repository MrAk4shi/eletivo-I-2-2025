<?php
session_start();
require("../conexao.php");

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET["id"])) {
    header("Location: listarProfissional.php");
    exit;
}

$id = $_GET["id"];

// EXCLUSÃO USANDO A COLUNA CERTA (idProfissionais)
$sql = $pdo->prepare("DELETE FROM profissionais WHERE idProfissionais = ?");
$sql->execute([$id]);

header("Location: listarProfissional.php?excluido=1");
exit;
