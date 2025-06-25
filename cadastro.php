<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cadastros</title>
<link rel="icon" href="imagens/icon.jpg" type="image/gif" sizes="18x18">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      height: 100vh;
      margin: 0;
      background: url('imagens/cadastro.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Merriweather', serif;
      display:  flex;
      align-items: center;
      justify-content: center;
    }

    .container {
      background: rgba(228, 202, 202, 0.3);
      backdrop-filter: blur(6px);
      -webkit-backdrop-filter: blur(6px);
      padding: 40px;
      border-radius: 22px;
      box-shadow: 0 8px 16px rgb(0, 0, 0);
      text-align: center;
      max-width: 400px;
      width: 90%;
    }

    h2 {
      margin-bottom: 30px;
      font-weight: 700;
    }

    .form-container {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .btn {
      padding: 12px;
      font-size: 16px;
      font-weight: 600;
      border-radius: 12px;
      transition: transform 0.3s ease;
      color: black;
      border: none;
    }

    .btn:hover {
      transform: scale(1.08);
    }

    /* Degradê de CIMA PARA BAIXO (vertical) com 3 cores */
    button[formaction*="professores"] {
      background: linear-gradient(to bottom,rgb(243, 220, 15),rgb(255, 102, 0),rgb(99, 70, 10));
    }

    button[formaction*="alunos"] {
      background: linear-gradient(to bottom,rgb(61, 194, 255),rgb(17, 158, 240),rgb(5, 103, 168));
    }

    .back-button {
      position: fixed;
      top: 20px;
      left: 20px;
      text-decoration: none;
    }

         #btn-voltar {
  position: absolute;
  top: 20px;
  left: 20px;
  background-color: rgb(221, 166, 15);
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
  background-color: rgb(26, 179, 166);
  transform: scale(1.05);
}
  </style>
</head>
<body>

  <a href="dashboard.php" id="btn-voltar">← Voltar</a>

  <div class="container">
    <h2>Escolha uma opção para cadastro:</h2>
    <form action="" method="post" class="form-container">
      <button type="submit" formaction="professores/indexProfessores.php" class="btn">Cadastrar Professor</button>
      <button type="submit" formaction="alunos/indexAlunos.php" class="btn">Cadastrar Aluno</button>
    </form>
  </div>

</body>
</html>
