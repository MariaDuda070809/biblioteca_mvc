<?php
include 'db.php';

$erro = ''; // variável para armazenar mensagem

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST['email']);
  $senha = trim($_POST['senha']);

  $sql = "SELECT * FROM professores WHERE email = :email";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':email', $email);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $tr = password_verify($senha, $row['senha']);

    if ($tr) {
      session_start();
      $_SESSION['email'] = $row['email'];
      $_SESSION['username'] = $row['nome'];
      $_SESSION['id'] = $row['id'];
      header("Location: dashboard.php");
      exit();
    } else {
      $erro = "Senha incorreta!";
    }
  } else {
    $erro = "Usuário não encontrado!";
  }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="icon" href="./imagens/icon.jpg" type="image/gif" sizes="16x16" />
  <style>
    html,
    body {
      height: 100%;
      margin: 0;
    }

    body {
      background-image: url('./imagens/dashboard.webp');
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-position: center;
      font-family: 'Merriweather', serif;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      background-color: rgba(255, 255, 255, 0.65);
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 350px;
      text-align: center;
      backdrop-filter: blur(4px);
    }

    h2 {
      margin-bottom: 20px;
      color: #2c3e50;
    }

    .mb-3 {
      margin-bottom: 15px;
      text-align: left;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: 500;
      color: #333;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      box-sizing: border-box;
      transition: border-color 0.2s;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      border-color: #1a73e8;
      outline: none;
    }

    .btn {
      width: 100%;
      padding: 10px;
      background-color: rgb(250, 146, 253);
      border: none;
      border-radius: 6px;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.2s, transform 0.2s;
    }

    .btn:hover {
      background-color: rgb(192, 96, 236);
      transform: scale(1.02);
    }

    .error-msg {
      color: red;
      font-size: 0.9em;
      margin-top: 10px;
    }
  </style>

</head>

<body>
  <div class="container">
    <h2>Login</h2>
    <?php if (!empty($erro)) : ?>
      <div class="error-msg"><?= $erro ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php">
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