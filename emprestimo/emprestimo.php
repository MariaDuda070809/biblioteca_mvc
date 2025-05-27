<?php

include '../db.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $aluno_id = $_POST['aluno_id'];
    $professor_id = $_SESSION['id'];
    $livro_id = $_POST['livro_id'];
    $data_retirada = $_POST['data_retirada'];
    $data_devolucao = $_POST['data_devolucao'];

    // Verifica se a data de devolução é maior ou igual à data de retirada
    if (strtotime($data_devolucao) < strtotime($data_retirada)) {
        echo "<script>alert('Erro: A data de devolução não pode ser anterior à data de retirada.');</script>";
    } else {
        $sql = "INSERT INTO emprestimos (aluno_id, professor_id, livro_id, data_retirada, data_devolucao) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$aluno_id, $professor_id, $livro_id, $data_retirada, $data_devolucao])) {
            echo "<script>alert('Empréstimo registrado com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao registrar o empréstimo.');</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Empréstimo de Livro</title>
</head>
<body>
    <h1>Empréstimo de Livro</h1>
    <form method="POST" action="" class="form-container">
        <label for="nome_aluno">Nome do Aluno:</label>
        <input type="text" id="nome_aluno" name="nome_aluno" required>
        
        <label for="nome_livro">Nome do Livro:</label>
        <input type="text" id="nome_livro" name="nome_livro" required>
        
        <label for="data_retirada">Data de Retirada:</label>
        <input type="date" id="data_retirada" name="data_retirada" required>
        
        <label for="data_devolucao">Data de Devolução:</label>
        <input type="date" id="data_devolucao" name="data_devolucao" required>
        
        <button type="submit" class="btn">Registrar Empréstimo</button>
    </form>
</body>
</html>

