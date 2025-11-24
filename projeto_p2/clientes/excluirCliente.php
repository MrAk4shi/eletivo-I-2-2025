<?php
session_start();

// Impedir acesso sem login
if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}

require("../conexao.php");

// Se usuário clicou em excluir
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["idCliente"];

    // Primeiro verifica se existe
    $stmt = $pdo->prepare("SELECT * FROM cliente WHERE idCliente = ?");
    $stmt->execute([$id]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cliente) {
        $erro = "Cliente não encontrado!";
    } else {
        //Exclui o cliente pelo ID
        $stmt = $pdo->prepare("DELETE FROM cliente WHERE idCliente = ?");
        if ($stmt->execute([$id])) {
            header("Location: listarCliente.php?msg=excluido");
            exit;
        } else {
            $erro = "Erro ao excluir o cliente!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Excluir Cliente</title>

    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="styleCliente.css">
</head>

<body>

<div class="container">

    <h2>Excluir Cliente</h2>

    <?php if (isset($erro)): ?>
        <p class="erro"><?= $erro ?></p>
    <?php endif; ?>

    <form method="POST" class="form-box">
        <label>ID do Cliente:</label>
        <input type="number" name="idCliente" required>

        <button type="submit" class="btn-danger">Excluir</button>
    </form>

    <a href="painelCliente.php" class="voltar">Voltar</a>

</div>

</body>
</html>
