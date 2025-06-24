<?php
header('Content-Type: application/json');
include '../db.php';

$turno = $_GET['turno'] ?? '';

$sql = "SELECT a.salas, COUNT(e.id) AS total
        FROM emprestimos e
        JOIN alunos a ON e.aluno_id = a.id
        WHERE LOWER(a.turno) = LOWER(?)
        GROUP BY a.salas
        ORDER BY total DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute([$turno]);
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
