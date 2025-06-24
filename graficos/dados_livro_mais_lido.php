<?php
header('Content-Type: application/json');
include '../db.php';

$sql = "SELECT l.nome_livro, COUNT(e.id) AS total
        FROM emprestimos e
        JOIN livros l ON e.livro_id = l.id
        WHERE QUARTER(e.data_retirada) = QUARTER(CURDATE())
          AND YEAR(e.data_retirada) = YEAR(CURDATE())
        GROUP BY l.nome_livro
        ORDER BY total DESC
        LIMIT 10";

$stmt = $pdo->prepare($sql);
$stmt->execute();
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
