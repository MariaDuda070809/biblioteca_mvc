<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Alunos</title>
    <link rel="stylesheet" href="../style.css">
    <style>
    /* Adicionando imagem de fundo no body */
    body {
      background-image: url('../imagens/cadasro_aluno.jpg');
      background-size: cover;          /* cobre toda a área */
      background-repeat: no-repeat;    /* não repete a imagem */
      background-position: center;     /* centraliza a imagem */
      min-height: 100vh;               /* altura mínima para cobrir toda a tela */
      margin: 0;                      /* remove margem padrão */
      font-family: 'Merriweather', serif;
       /* se quiser manter fonte igual do seu CSS */
    }
    
button, .btn {
     width: 102%;
    padding: 15px;
    background-color:rgb(50, 122, 255);
    color: black;
    border: none;
    border-radius: 12px;
    font-size: 1em; 
    font-weight: bold;/* Aumenta o tamanho do texto */
    cursor: pointer;
    transition: transform 0.3s ease;
    display: block;
    margin: 10px auto;
}

button:hover, .btn:hover {
      transform: scale(1.05); /* Expande o botão */
    background-color:rgb(0, 43, 185); /* Cor mais clara ao passar o mouse */
}
  </style>
<body>
    <div class="form-container">
        <h1>Cadastro de Alunos</h1>
        <form method="POST" action="alunos.php">
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="text" name="serie" placeholder="Série" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
    <a href="../cadastro.php" class="back-button">
    <button class="btn">
        🡸
    </button>
</body>
</html>
