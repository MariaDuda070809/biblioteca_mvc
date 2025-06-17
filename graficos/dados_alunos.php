<?php
header('Content-Type: application/json');
include '../db.php';

$turno = $_GET['turno'] ?? '';
$salas = $_GET['salas'] ?? '';

if (!$turno || !$salas) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT a.nome, COUNT(e.id) AS total 
        FROM alunos a
        LEFT JOIN emprestimos e ON e.aluno_id = a.id
        WHERE a.turno = ? AND a.salas = ?
        GROUP BY a.id, a.nome";

$stmt = $pdo->prepare($sql);
$stmt->execute([$turno, $salas]);
$alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($alunos);
