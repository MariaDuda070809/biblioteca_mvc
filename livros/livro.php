<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include '../db.php';
header('Content-Type: application/json');

$nome_livro = trim($_POST['nome_livro'] ?? '');
$nome_autor = trim($_POST['nome_autor'] ?? '');
$isbn = trim($_POST['isbn'] ?? '');

if (!$nome_livro || !$nome_autor) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Por favor, preencha todos os campos.'
    ]);
    exit;
}

try {
    $sqlInsert = "INSERT INTO livros (nome_livro, nome_autor, isbn) 
                  VALUES (:nome_livro, :nome_autor, :isbn)";
    $stmt = $conn->prepare($sqlInsert);
    $stmt->execute([
        ':nome_livro' => $nome_livro,
        ':nome_autor' => $nome_autor,
        ':isbn' => $isbn,
    ]);

    echo json_encode([
        'status' => 'success',
        'message' => 'Livro cadastrado com sucesso!'
    ]);
} catch (PDOException $ex) {
    if ($ex->getCode() == 23000) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Erro: ISBN já cadastrado.'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Erro ao cadastrar o livro: ' . $ex->getMessage()
        ]);
    }
}
exit;
