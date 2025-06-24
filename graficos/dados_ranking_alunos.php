<?php
header('Content-Type: application/json');
include '../db.php';

$sql = "SELECT a.nome, a.turno, a.salas, COUNT(e.id) AS total
        FROM alunos a
        JOIN emprestimos e ON e.aluno_id = a.id
        GROUP BY a.id, a.turno, a.salas
        ORDER BY total DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute();
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
