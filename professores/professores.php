<?php
include '../db.php';

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
}

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// Verifica se os campos obrigatórios não estão vazios
if ($nome == '' || $cpf == '' || $senha == '' || $email == '') {
    echo "Por favor, preencha todos os campos.";
    exit;
}

global $pdo;

try {
    $sql = "INSERT INTO professores (nome, cpf, senha, email) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $cpf, $senhaHash, $email]);

    // Alerta de sucesso e redirecionamento
    echo "<script>
        alert('Professor cadastrado com sucesso!');
        window.location.href = 'indexProfessores.php';
    </script>";

} catch (PDOException $e) {
    // Alerta de erro e redirecionamento
    echo "<script>
        alert('Erro ao cadastrar professor: " . $e->getMessage() . "');
        window.location.href = 'indexProfessores.php';
    </script>";
}
?>
