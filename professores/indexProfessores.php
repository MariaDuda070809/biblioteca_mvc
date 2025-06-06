<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cadastro de Professores</title>
  <link rel="stylesheet" href="../style.css" />

  <!-- Importar Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

  <style>
    /* Adicionando imagem de fundo no body */
    body {
      background-image: url('../imagens/cadastro_professor.jpg');
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
    background-color: #fc8600;
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
    background-color: #ff6701; /* Cor mais clara ao passar o mouse */
}
  </style>
</head>

<body>
  <div class="form-container">
    <h1>Cadastro de Professores</h1>
    <form method="POST" action="indexProfessores.php" autocomplete="off">
      <input type="text" name="nome" placeholder="Nome" required autocomplete="off" />
      <input type="text" name="cpf" id="cpf" placeholder="CPF" required autocomplete="off" />

      <div class="senha-container">
        <input type="password" name="senha" id="senha" placeholder="Senha" required autocomplete="new-password" />
        <button type="button" id="toggleSenha" aria-label="Mostrar senha">
          <span class="material-icons">visibility</span>
        </button>
      </div>

      <input type="email" name="email" placeholder="Email" required autocomplete="off" />
      <button type="submit">Cadastrar</button>
    </form>
  </div>

  <a href="../cadastro.php" class="back-button">
    <button class="btn">🡸</button>
  </a>

  <script>
    // Máscara de CPF
    document.getElementById('cpf').addEventListener('input', function (e) {
      let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não for número
      if (value.length > 11) value = value.slice(0, 11);
      value = value.replace(/(\d{3})(\d)/, '$1.$2');
      value = value.replace(/(\d{3})(\d)/, '$1.$2');
      value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
      e.target.value = value;
    });

    // Toggle mostrar/ocultar senha
    const toggleBtn = document.getElementById('toggleSenha');
    const senhaInput = document.getElementById('senha');
    const icon = toggleBtn.querySelector('.material-icons');

    toggleBtn.addEventListener('click', () => {
      if (senhaInput.type === 'password') {
        senhaInput.type = 'text';
        icon.textContent = 'visibility_off'; // Ícone de olho riscado
        toggleBtn.setAttribute('aria-label', 'Ocultar senha');
      } else {
        senhaInput.type = 'password';
        icon.textContent = 'visibility'; // Ícone de olho aberto
        toggleBtn.setAttribute('aria-label', 'Mostrar senha');
      }
    });
  </script>
</body>
</html>
