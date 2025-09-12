<?php
require '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verifica se existe empréstimo vinculado ao livro
    $checkSql = "SELECT COUNT(*) FROM emprestimos WHERE livro_id = :id";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->execute([':id' => $id]);
    $emprestimos = $checkStmt->fetchColumn();

    if ($emprestimos > 0) {
        echo "<script>alert('Este livro não pode ser excluído pois está vinculado a um empréstimo.'); window.location.href='livros_cadastrados.php';</script>";
        exit;
    }

    // Exclui o livro
    $sql = "DELETE FROM livros WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    header("Location: livros_cadastrados.php");
    exit;
}
?>