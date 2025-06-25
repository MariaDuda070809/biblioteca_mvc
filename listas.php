<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../biblioteca_mvc/imagens/icon.jpg" type="image/gif" sizes="16x16" />
  <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">

  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    body {
      background-image: url('../biblioteca_mvc/imagens/listas.png');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      font-family: 'Merriweather', serif;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
      position: relative;
    }

    .button-container {
      background: rgba(255, 255, 255, 0.3);
      backdrop-filter: blur(6px);
      -webkit-backdrop-filter: blur(6px);
      border-radius: 22px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
      padding: 30px;
      max-width: 600px;
      width: 100%;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h2 {
      margin-bottom: 10px;
      color: #fff;
      font-size: 37px
    }

    ul {
      list-style: none;
      padding-left: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
    }

    li {
      margin-bottom: 0;
    }

    .btn-link {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 14px 0;
      color: #fff;
      text-decoration: none;
      border-radius: 12px;
      transition: transform 0.3s ease, background-color 0.3s ease;
      text-align: center;
      width: 280px;
      box-sizing: border-box;
      font-weight: 400;
      user-select: none;
    }

    ul li:nth-child(1) .btn-link {
      background: linear-gradient(to bottom,rgb(255, 232, 85),rgb(255, 155, 216));
    }

    ul li:nth-child(2) .btn-link {
      background: linear-gradient(to bottom,rgb(255, 117, 25),rgb(255, 241, 89));
    }

    ul li:nth-child(3) .btn-link {
      background: linear-gradient(to bottom,rgb(171, 72, 190),rgb(20, 7, 91));
    }

    ul li:nth-child(4) .btn-link {
      background: linear-gradient(to bottom, #1041E1, #9A00FF);
    }

    ul li:nth-child(5) .btn-link {
      background: linear-gradient(to bottom, #00C9A7, #00B3FF);
    }

    .btn-link:hover {
      transform: scale(1.15);
      color: white;
    }

    /* Botão de voltar no canto superior esquerdo */
    .back-button {
      position: absolute;
      top: 20px;
      left: 20px;
      z-index: 999;
      text-decoration: none;
    }

    .btn {
      background-color: #D70000;
      color: white;
      border: none;
      border-radius: 10px;
      padding: 10px 16px;
      font-size: 18px;
      cursor: pointer;
      transition: transform 0.2s ease-in-out;
    }

    .btn:hover {
      transform: scale(1.15);
    }
  </style>
</head>
<body>

  <!-- Botão de voltar no canto -->
  <a href="dashboard.php" class="back-button">
    <button class="btn">←</button>
  </a>

  <!-- Conteúdo central -->
  <div class="button-container">
    <h2>Cadastros:</h2>
    <ul>
      <li><a href="livros/livros_cadastrados.php" class="btn-link">Livros</a></li>
      <li><a href="alunos/listar_alunos.php" class="btn-link">Alunos</a></li>
      <li><a href="professores/listar_professores.php" class="btn-link">Professores</a></li>
      <li><a href="emprestimo/lista_emprestimo.php" class="btn-link">Empréstimos</a></li>
    
    </ul>
  </div>

</body>
</html>
