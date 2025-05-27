<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Buscar e Cadastrar Livro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

  <h1 class="mb-4">Buscar Livro e Cadastrar</h1>

  <input type="text" id="searchInput" class="form-control mb-3" placeholder="Digite o nome do livro...">

  <div id="resultados"></div>
  <div id="mensagem" class="mt-3"></div>

  <script>
    const searchInput = document.getElementById('searchInput');
    const resultados = document.getElementById('resultados');
    const mensagem = document.getElementById('mensagem');

    searchInput.addEventListener('input', async () => {
      const query = searchInput.value.trim();
      resultados.innerHTML = '';
      mensagem.innerHTML = '';

      if (query.length < 3) return;

      try {
        const res = await fetch(`https://www.googleapis.com/books/v1/volumes?q=${encodeURIComponent(query)}`);
        const data = await res.json();

        if (!data.items) {
          resultados.innerHTML = '<p>Nenhum livro encontrado.</p>';
          return;
        }

        data.items.slice(0, 5).forEach(livro => {
          const info = livro.volumeInfo;
          const nome_livro = info.title || 'Sem título';
          const nome_autor = (info.authors && info.authors.join(', ')) || 'Autor desconhecido';
          const capa = (info.imageLinks && info.imageLinks.thumbnail) || 'https://via.placeholder.com/100x150?text=Sem+Capa';

          const div = document.createElement('div');
          div.classList.add('card', 'mb-2', 'p-3');

          div.innerHTML = `
            <div class="d-flex align-items-start">
              <img src="${capa}" alt="Capa do livro" class="me-3" style="width:100px; height:auto;">
              <div>
                <strong>Título:</strong> ${nome_livro}<br>
                <strong>Autor:</strong> ${nome_autor}<br>
                <button class="btn btn-success mt-2">Cadastrar</button>
              </div>
            </div>
          `;

          const botao = div.querySelector('button');
          botao.addEventListener('click', () => {
            console.log('Botão cadastrar clicado:', nome_livro, nome_autor);
            cadastrarLivro(nome_livro, nome_autor);
          });

          resultados.appendChild(div);
        });
      } catch (error) {
        mensagem.innerHTML = `<div class="alert alert-danger">Erro ao buscar livros.</div>`;
      }
    });

    async function cadastrarLivro(nome_livro, nome_autor) {
      const formData = new FormData();
      formData.append('nome_livro', nome_livro);
      formData.append('nome_autor', nome_autor);

      try {
        const res = await fetch('livro.php', {
          method: 'POST',
          body: formData
        });
        const data = await res.json();

        mensagem.innerHTML = `
          <div class="alert alert-${data.status === 'success' ? 'success' : 'danger'}">
            ${data.message}
          </div>
        `;
      } catch (error) {
        mensagem.innerHTML = `
          <div class="alert alert-danger">Erro ao conectar com o servidor.</div>
        `;
      }
    }
  </script>

</body>
</html>
