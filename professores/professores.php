<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $email = $_POST['email'] ?? '';
} else {
    header('Location: indexProfessores.php');
    exit;
}

// Verifica se campos estão vazios
if ($nome == '' || $cpf == '' || $senha == '' || $email == '') {
    header('Location: indexProfessores.php?msg=' . urlencode('Por favor, preencha todos os campos.'));
    exit;
}

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// Limpa CPF, deixa só números
$cpfLimpo = preg_replace('/\D/', '', $cpf);

try {
    global $pdo;
    $sql = "INSERT INTO professores (nome, cpf, senha, email) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    // **Aqui deve usar $cpfLimpo para salvar no banco**
    $stmt->execute([$nome, $cpfLimpo, $senhaHash, $email]);

    header('Location: indexProfessores.php?msg=' . urlencode('Professor cadastrado com sucesso!'));
    exit;

} catch (PDOException $e) {
    header('Location: indexProfessores.php?msg=' . urlencode('Erro ao cadastrar professor: ' . $e->getMessage()));
    exit;
}
