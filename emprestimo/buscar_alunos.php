<?php
require_once '../db.php';

$term = isset($_GET['term']) ? $_GET['term'] : '';

$stmt = $pdo->prepare("SELECT id, nome FROM alunos WHERE nome LIKE ?");
$stmt->execute(["%$term%"]);

$dados = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $dados[] = [
        'id' => $row['id'],
        'text' => $row['nome']  // Certifique-se de que o 'text' seja o nome do aluno
    ];
}

echo json_encode($dados);
?>