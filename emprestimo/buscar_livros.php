<?php
require_once '../db.php';

$term = isset($_GET['term']) ? $_GET['term'] : '';

$stmt = $pdo->prepare("SELECT id, nome_livro FROM livros WHERE nome_livro LIKE ?");
$stmt->execute(["%$term%"]);

$dados = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $dados[] = [
        'id' => $row['id'],
        'text' => $row['nome_livro']  // Certifique-se de que o 'text' seja o nome do livro
    ];
}

echo json_encode($dados);
?>