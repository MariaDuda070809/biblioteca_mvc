<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Alunos</title>
  <link rel="icon" href="../imagens/icon.jpg" type="image/gif" sizes="16x16" />
  <link rel="stylesheet" href="../style.css">
  <style>
    body {
      background-image: url('../imagens/cadasro_aluno.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      min-height: 100vh;
      margin: 0;
      font-family: 'Merriweather', serif;
    }
    button, .btn {
     width: 102%;
    padding: 15px;
    background-color:rgb(26, 72, 255);
    color: black;
    border: none;
    border-radius: 12px;
    font-size: 1em;
    font-weight: bold; /* Aumenta o tamanho do texto */
    cursor: pointer;
    transition: transform 0.3s ease;
    display: block;
    margin: 10px auto;
}

button:hover, .btn:hover {
      transform: scale(1.1); /* Expande o botão */
    background-color:rgb(0, 3, 192); /* Cor mais clara ao passar o mouse */
}

    input[type="text"], input[type="email"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    .turno-group {
      display: flex;
      justify-content: space-between;
      margin-bottom: 15px;
    }

    .turno-group input[type="radio"] {
      display: none;
    }

    .turno-group label {
      flex: 1;
      text-align: center;
      padding: 10px;
      margin: 0 3px;
      border: 2px solidrgb(0, 93, 193);
      border-radius: 10px;
      background-color: white;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.2s, color 0.2s;
    }

    .turno-group input[type="radio"]:checked + label {
      background-color:rgb(26, 72, 255);
      color: white;
    }

          #btn-voltar {
  position: absolute;
  top: 20px;
  left: 20px;
  background-color: rgb(119, 182, 235);
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
  background-color: rgb(26, 79, 179);
  transform: scale(1.05);
}

  </style>
</head>
<body>

  <div class="form-container">
    <h1>Cadastro de Alunos</h1>
    <form method="POST" action="alunos.php">
      <input type="text" name="nome" placeholder="Nome" required>
      <input type="text" name="serie" placeholder="Série" required>
      <input type="email" name="email" placeholder="Email" required>

      <div class="turno-group">
        <input type="radio" id="manha" name="turno" value="manhã" required>
        <label for="manha">Manhã</label>

        <input type="radio" id="tarde" name="turno" value="tarde">
        <label for="tarde">Tarde</label>

        <input type="radio" id="noite" name="turno" value="noite">
        <label for="noite">Noite</label>
      </div>

      <button type="submit">Cadastrar</button>
    </form>
  </div>
  <a href="../cadastro.php" id="btn-voltar">← Voltar</a>
  </a>
</body>
</html>
