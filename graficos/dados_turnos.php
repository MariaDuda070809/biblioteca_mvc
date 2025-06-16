<?php
header('Content-Type: application/json');
include '../db.php';

try {
    $sql = "SELECT a.turno, COUNT(e.id) AS total 
            FROM emprestimos e
            JOIN alunos a ON e.aluno_id = a.id
            WHERE MONTH(e.data_retirada) = MONTH(CURDATE()) 
              AND YEAR(e.data_retirada) = YEAR(CURDATE())
            GROUP BY a.turno";

    $result = $pdo->query($sql);
    $data = $result->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['erro' => $e->getMessage()]);
}
