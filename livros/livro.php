<?php
header('Content-Type: application/json');
include '../db.php'; // ajuste o caminho se necessário
  

$nome_livro = trim($_POST['nome_livro'] ?? '');
$nome_autor = trim($_POST['nome_autor'] ?? '');

try {
    if ($nome_livro && $nome_autor) {
        $sql = "INSERT INTO livros (nome_livro, nome_autor) VALUES (:nome_livro, :nome_autor)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nome_livro' => $nome_livro,
            ':nome_autor' => $nome_autor
        ]);
        echo json_encode(['status' => 'success', 'message' => 'Livro cadastrado com sucesso!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Preencha todos os campos.']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Erro: ' . $e->getMessage()]);
}
