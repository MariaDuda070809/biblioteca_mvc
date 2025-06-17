<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cadastro de Professores</title>
  <link rel="icon" href="../imagens/icon.jpg" type="image/gif" sizes="16x16" />
  <link rel="stylesheet" href="../style.css" />

  <!-- Importar Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

  <style>
    /* Adicionando imagem de fundo no body */
    body {
      background-image: url('../imagens/cadastro_professor.jpg');
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
      background-color: #fc8600;
      color: black;
      border: none;
      border-radius: 12px;
      font-size: 1em;
      font-weight: bold;
      cursor: pointer;
      transition: transform 0.3s ease;
      display: block;
      margin: 10px auto;
    }

    button:hover, .btn:hover {
      transform: scale(1.1);
      background-color: #ff6701;
    }

    .modal-bg {
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      display: none; /* inicialmente escondido */
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }
    .modal-box {
      background: white;
      padding: 25px 35px;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.3);
      max-width: 400px;
      text-align: center;
      font-family: 'Merriweather', serif;
      font-size: 18px;
      color: #333;
    }

    .modal-box p {
      margin-bottom: 20px;
    }

    .modal-box button {
      padding: 10px 30px;
      font-size: 16px;
      border: none;
      background-color: #fc8600;
      color: black;
      border-radius: 12px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .modal-box button:hover {
      background-color: #ff6701;
      transform: scale(1.05);
    }
  </style>
</head>

<body>
  <div class="form-container">
    <h1>Cadastro de Professores</h1>
    <form method="POST" action="professores.php" autocomplete="off" id="formCadastro">
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

  <!-- Modal para mensagens -->
  <div class="modal-bg" id="modalMsg">
    <div class="modal-box">
      <p id="modalText"></p>
      <button id="modalCloseBtn">Fechar</button>
    </div>
  </div>

  <!-- ... seu HTML e CSS como antes ... -->

<script>
  const cpfInput = document.getElementById('cpf');

  // Máscara do CPF enquanto digita
  cpfInput.addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 11) value = value.slice(0, 11);
    value = value.replace(/(\d{3})(\d)/, '$1.$2');
    value = value.replace(/(\d{3})(\d)/, '$1.$2');
    value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    e.target.value = value;
  });

  // Limpa o CPF (remove máscara) antes de enviar para o backend
  document.getElementById('formCadastro').addEventListener('submit', function (e) {
    cpfInput.value = cpfInput.value.replace(/\D/g, ''); // remove pontos e traços
  });

    // Toggle mostrar/ocultar senha
    const toggleBtn = document.getElementById('toggleSenha');
    const senhaInput = document.getElementById('senha');
    const icon = toggleBtn.querySelector('.material-icons');

    toggleBtn.addEventListener('click', () => {
      if (senhaInput.type === 'password') {
        senhaInput.type = 'text';
        icon.textContent = 'visibility_off';
        toggleBtn.setAttribute('aria-label', 'Ocultar senha');
      } else {
        senhaInput.type = 'password';
        icon.textContent = 'visibility';
        toggleBtn.setAttribute('aria-label', 'Mostrar senha');
      }
    });

    // Função para mostrar modal
    function showModal(msg) {
      const modalBg = document.getElementById('modalMsg');
      const modalText = document.getElementById('modalText');
      modalText.textContent = msg;
      modalBg.style.display = 'flex';
    }

    // Fechar modal
    document.getElementById('modalCloseBtn').addEventListener('click', () => {
      document.getElementById('modalMsg').style.display = 'none';
      // Remove o parâmetro da URL para evitar reaparecer a mensagem ao atualizar
      if (window.history.replaceState) {
        const url = new URL(window.location);
        url.searchParams.delete('msg');
        window.history.replaceState({}, document.title, url.toString());
      }
    });

    // Verificar se tem mensagem na URL e mostrar modal
    window.addEventListener('load', () => {
      const params = new URLSearchParams(window.location.search);
      const msg = params.get('msg');
      if (msg) {
        showModal(decodeURIComponent(msg));
      }
    });
  </script>
</body>
</html>
