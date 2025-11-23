<?php
session_start();
require("../conexao.php");

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}

// VERIFICA SE O ID VEIO NA URL
if (!isset($_GET["id"])) {
    header("Location: listarProfissional.php");
    exit;
}

$id = $_GET["id"];

// BUSCA O PROFISSIONAL CORRETO (COLUNA CERTA: idProfissionais)
$sql = $pdo->prepare("SELECT * FROM profissionais WHERE idProfissionais = ?");
$sql->execute([$id]);
$profissional = $sql->fetch(PDO::FETCH_ASSOC);

if (!$profissional) {
    die("Profissional não encontrado.");
}

// SE ENVIAR O FORMULÁRIO (POST) → ATUALIZA
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = $_POST["nomeProfissional"];
    $especialidade = $_POST["especialidade"];
    $telefone = $_POST["telefoneProfissional"];
    $email = $_POST["emailProfissional"];

    $update = $pdo->prepare("
        UPDATE profissionais 
        SET nomeProfissional=?, especialidade=?, telefoneProfissional=?, emailProfissional=? 
        WHERE idProfissionais=?
    ");

    $update->execute([$nome, $especialidade, $telefone, $email, $id]);

    header("Location: listarProfissional.php?editado=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Profissional</title>
    <link rel="stylesheet" href="styleProfissional.css">
</head>
<body>

<div class="conteiner">
    <h2>Editar Profissional</h2>

    <form method="POST">

        <label>Nome:</label>
        <input type="text" name="nomeProfissional" value="<?= $profissional['nomeProfissional'] ?>" required>

        <label>Especialidade:</label>
        <input type="text" name="especialidade" value="<?= $profissional['especialidade'] ?>">

        <label>Telefone:</label>
        <input type="text" name="telefoneProfissional" value="<?= $profissional['telefoneProfissional'] ?>">

        <label>Email:</label>
        <input type="email" name="emailProfissional" value="<?= $profissional['emailProfissional'] ?>">

        <button type="submit" class="btn">Salvar alterações</button>
    </form>

    <a href="listarProfissional.php" class="voltar">Voltar</a>
</div>

</body>
</html>
