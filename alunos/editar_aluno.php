<?php
require '../db.php';

if (!isset($_GET['id'])) {
    die("ID do aluno não informado.");
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM alunos WHERE id = ?");
$stmt->execute([$id]);
$aluno = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $salas = $_POST['salas'];
    $email = $_POST['email'];

    $update = $pdo->prepare("UPDATE alunos SET nome = ?, salas = ?, email = ? WHERE id = ?");
    $update->execute([$nome, $salas, $email, $id]);

    header("Location: alunos_cadastrados.php");
    exit();
}
?>

<form method="post">
    <h3>Editar Aluno</h3>
    <label>Nome: <input type="text" name="nome" value="<?= htmlspecialchars($aluno['nome']) ?>"></label><br>
    <label>Sala: <input type="text" name="salas" value="<?= htmlspecialchars($aluno['salas']) ?>"></label><br>
    <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($aluno['email']) ?>"></label><br>
    <button type="submit">Salvar</button>
</form>
