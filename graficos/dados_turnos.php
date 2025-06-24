<?php
// header('Content-Type: application/json');
// require '../db.php';

// try {
//     $sql = "SELECT a.turno, COUNT(e.id) AS total 
//             FROM emprestimos e
//             JOIN alunos a ON e.aluno_id = a.id
//             WHERE MONTH(e.data_retirada) = MONTH(CURDATE()) 
//               AND YEAR(e.data_retirada) = YEAR(CURDATE())
//             GROUP BY a.turno";

//     $result = $pdo->query($sql);
//     $data = $result->fetchAll(PDO::FETCH_ASSOC);
//     echo json_encode($data);
// } catch (PDOException $e) {
//     http_response_code(500);
//     echo json_encode(['erro' => $e->getMessage()]);
// }

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexão com o banco
require '../db.php'; // Caminho correto pro seu arquivo de conexão

header('Content-Type: application/json');

try {
    $sql = "
        SELECT a.turno, COUNT(e.id) AS total
        FROM emprestimos e
        JOIN alunos a ON e.aluno_id = a.id
        GROUP BY a.turno
    ";
    $stmt = $pdo->query($sql);
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($dados);
} catch (PDOException $e) {
    echo json_encode(['erro' => $e->getMessage()]);
}


