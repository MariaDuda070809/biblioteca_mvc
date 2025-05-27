<?php
header('Content-Type: application/json');
include '../db.php';

$titulo = trim($_POST['titulo'] ?? '');
$autor = trim($_POST['autor'] ?? '');
$isbn = trim($_POST['isbn'] ?? '');

try {
    if ($titulo && $autor && $isbn) {
        $sql = "INSERT INTO livros (titulo, autor, isbn) VALUES (:titulo, :autor, :isbn)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':titulo' => $titulo,
            ':autor' => $autor,
            ':isbn' => $isbn
        ]);
        echo json_encode(['status' => 'success', 'message' => 'Livro cadastrado com sucesso!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Preencha todos os campos.']);
    }
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        echo json_encode(['status' => 'error', 'message' => 'ISBN já cadastrado.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro: ' . $e->getMessage()]);
    }
}
