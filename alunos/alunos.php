<?php
include '../db.php';

// Verifica se os dados foram enviados via POST e pega os valores.
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$salas = isset($_POST['salas']) ? $_POST['salas'] : '';
$turno = isset($_POST['turno']) ? $_POST['turno'] : '';

// Verifica se os campos obrigatórios não estão vazios
if ($nome == '' || $email == '' || $salas == '' || $turno == '') {
    echo "Por favor, preencha todos os campos.";
    exit;
}

global $pdo;

try {
    // Preparando a consulta SQL
    $sql = "INSERT INTO alunos (nome, email, salas, turno) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    // Executa a query com os valores passados
    $stmt->execute([$nome, $email, $salas, $turno]);

    // Exibir uma mensagem de sucesso
       // Alerta de sucesso e redirecionamento
       echo "<script>
       alert('Aluno cadastrado com sucesso!');
       window.location.href = 'indexAlunos.php';
    </script>";

} catch (PDOException $e) {
    // Exibir mensagem de erro se algo der errado
    echo "Erro ao cadastrar aluno: " . $e->getMessage();
}
?>