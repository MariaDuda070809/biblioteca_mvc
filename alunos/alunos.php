<?php
include '../db.php';

// Verifica se os dados foram enviados via POST e pega os valores.
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$serie = isset($_POST['serie']) ? $_POST['serie'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$turno = isset($_POST['turno']) ? $_POST['turno'] : '';

// Verifica se os campos obrigatórios não estão vazios
if ($nome == '' || $serie == '' || $email == '' || $turno == '') {
    echo "Por favor, preencha todos os campos.";
    exit;
}

global $pdo;

try {
    // Preparando a consulta SQL
    $sql = "INSERT INTO alunos (nome, serie, email, turno) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    // Executa a query com os valores passados
    $stmt->execute([$nome, $serie, $email, $turno]);

    // Exibir uma mensagem de sucesso
       // Alerta de sucesso e redirecionamento
       echo "<script>
       alert('Aluno cadastrado com sucesso!');
       window.location.href = 'indexAluno.php';
   </script>";

} catch (PDOException $e) {
    // Exibir mensagem de erro se algo der errado
    echo "Erro ao cadastrar aluno: " . $e->getMessage();
}
?>