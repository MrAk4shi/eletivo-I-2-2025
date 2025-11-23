<?php
// Mostrar erros na tela
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require("../conexao.php");

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}

// Verificar se os dados estão chegando
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id = $_POST["id"] ?? null;
    $data = $_POST["dataAgendamento"] ?? null;
    $inicio = $_POST["inicioServico"] ?? null;
    $fim = $_POST["fimServico"] ?? null;
    $status = $_POST["status"] ?? null;
    $obs = $_POST["observacoes"] ?? null;
    $cliente = $_POST["cliente"] ?? null;
    $prof = $_POST["profissional"] ?? null;
    $servico = $_POST["servico"] ?? null;

    // Validar se o ID existe
    if (!$id) {
        die("ID do agendamento não encontrado.");
    }

    // Atualiza corretamente com nomes da tabela
    $sql = $pdo->prepare("
        UPDATE agendamento SET
            dataAgendamento = ?,
            inicioServico = ?,
            fimServico = ?,
            status = ?,
            observacoes = ?,
            cliente_idCliente = ?,
            profissionais_idProfissionais = ?,
            servicos_idServico = ?
        WHERE idAgendamento = ?
    ");

    if ($sql->execute([$data, $inicio, $fim, $status, $obs, $cliente, $prof, $servico, $id])) {
        header("Location: listarAgendamento.php?editado=1");
        exit;
    } else {
        echo "Erro ao atualizar agendamento.";
    }
} else {
    echo "Requisição inválida.";
}
?>
