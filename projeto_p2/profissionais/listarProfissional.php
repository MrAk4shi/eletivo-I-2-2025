<?php
session_start();
require("../conexao.php");

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}

$sql = $pdo->query("SELECT * FROM profissionais");
$profissionais = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Profissionais</title>
    <link rel="stylesheet" href="styleProfissional.css?v=<?= time() ?>">
    
</head>
<body>

<div class="conteiner">
    <h2>Lista de Profissionais</h2>

    <table class="tabela-profissionais">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Especialidade</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($profissionais as $linha): ?>
        <tr>
            <td><?= $linha["idProfissionais"] ?></td>
            <td><?= $linha["nomeProfissional"] ?></td>
            <td><?= $linha["especialidade"] ?></td>
            <td><?= $linha["telefoneProfissional"] ?></td>
            <td><?= $linha["emailProfissional"] ?></td>

            <td>
                <a href="editarProfissional.php?id=<?= $linha['idProfissionais'] ?>" class="btn-table edit">Editar</a>
                <a href="excluirProfissional.php?id=<?= $linha['idProfissionais'] ?>" class="btn-table delete" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>

    <a href="painelProfissional.php" class="voltar">Voltar</a>
</div>

</body>
</html>
