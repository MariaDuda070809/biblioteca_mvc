<?php
require '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM alunos WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: listar_alunos.php");
    exit();
} else {
    echo "ID do aluno não especificado.";
}
?>
