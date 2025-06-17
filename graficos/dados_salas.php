<?php
header('Content-Type: application/json');
include '../db.php';

$turno = $_GET['turno'] ?? '';

if (!$turno) {
    echo json_encode([]);
    exit;
}

// Pega as salas que têm pelo menos um empréstimo no turno informado
$sql = "SELECT a.salas, COUNT(e.id) AS total 
        FROM emprestimos e
        JOIN alunos a ON e.aluno_id = a.id
        WHERE a.turno = ? AND a.salas IS NOT NULL AND a.salas <> ''
        GROUP BY a.salas";

$stmt = $pdo->prepare($sql);
$stmt->execute([$turno]);
$salas = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($salas);
