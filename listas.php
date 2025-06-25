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
      background-image: url('../biblioteca_mvc/imagens/cadastros.png');
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
      border-radius: 16px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.35);
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
      color: black;
      font-size: 30px;
      font-weight: 600;
      text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);
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
      background: linear-gradient(to bottom,rgb(193, 139, 255),rgb(168, 56, 243));
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.35);
    }

    ul li:nth-child(2) .btn-link {
      background: linear-gradient(to bottom,rgb(10, 125, 233),rgb(80, 156, 255));
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.35);
    }

    ul li:nth-child(3) .btn-link {
      background: linear-gradient(to bottom,rgb(87, 236, 241),rgb(7, 224, 170));
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.35);
    }

    ul li:nth-child(4) .btn-link {
      background: linear-gradient(to bottom,rgb(14, 223, 118),rgb(74, 247, 126));
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.35);
     
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

         #btn-voltar {
  position: absolute;
  top: 20px;
  left: 20px;
  background-color: rgb(129, 28, 160);
  color: white;
  padding: 10px 16px;
  border: none;
  border-radius: 8px;
  font-weight: bold;
  text-decoration: none;
  transition: all 0.2s ease-in-out;
  z-index: 999;
}

#btn-voltar:hover {
  background-color: rgb(54, 8, 68);
  transform: scale(1.05);
}

  </style>
</head>
<body>

  <!-- Botão de voltar no canto -->
    <a href="./dashboard.php" id="btn-voltar">← Voltar</a>

  <!-- Conteúdo central -->
  <div class="button-container">
    <h2>Painel informativo:</h2>
    <ul>
      <li><a href="livros/livros_cadastrados.php" class="btn-link">Livros</a></li>
      <li><a href="alunos/listar_alunos.php" class="btn-link">Alunos</a></li>
      <li><a href="professores/listar_professores.php" class="btn-link">Professores</a></li>
      <li><a href="emprestimo/lista_emprestimo.php" class="btn-link">Empréstimos</a></li>
    
    </ul>
  </div>

</body>
</html>
