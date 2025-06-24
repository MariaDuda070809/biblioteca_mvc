<?php
header('Content-Type: application/json');
include '../db.php';

$sql = "
  SELECT
    a.turno,
    COUNT(e.id) AS total
  FROM emprestimos e
  JOIN alunos a ON e.aluno_id = a.id
  GROUP BY a.turno
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
