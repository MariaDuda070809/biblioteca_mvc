<?php
require '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Exclui o livro com segurança usando prepared statement
    $stmt = $pdo->prepare("DELETE FROM livros WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: livros_cadastrados.php"); // redireciona após exclusão
    exit();
} else {
    echo "ID do livro não especificado.";
}
?>
