<?php

// esta pagina confere no banco de dados a o email e a senha, e confere, depois inicia a sessão pegando o ID do professor para 

include '../db.php';
// include '../dashboard.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $conn = new mysqli("localhost", "root", "", "biblioteca_mvc");

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM professores WHERE email = '$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $tr=password_verify($senha, $row['senha']);
        var_dump($row['senha']);


        // Comparar a senha diretamente, pois não está usando hash
        if ($tr) {
            session_start();
            $_SESSION['email'] = $row['email'];
            $_SESSION['username'] = $row['nome'];
            $_SESSION['id'] = $row['id'];
            //var_dump($row['nome']);
            header("Location: ../dashboard.php");
            exit();
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form method="POST" action="login.php">
        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required>
        </div>
        <button type="submit" class="btn">Entrar</button>

    </form>
</div>

</body>
</html>
