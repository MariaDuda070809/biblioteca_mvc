<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Buscar e Cadastrar Livros</title>
    <link rel="stylesheet" href="../style.css">

    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { text-align: center; }
        input[type="text"] { padding: 10px; width: 300px; border-radius: 5px; border: 1px solid #ccc; }
        .livro { display: flex; margin-top: 10px; border-bottom: 1px solid #ccc; padding-bottom: 10px; }
        .livro img { width: 80px; margin-right: 10px; }
        .livro div { flex: 1; }
        button { padding: 5px 10px; background: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>

<h1>Buscar e Cadastrar Livro</h1>


<input type="text" id="busca" placeholder="Digite o nome do livro">
<div id="resultados"></div>

<script>
const input = document.getElementById('busca');
const resultados = document.getElementById('resultados');

input.addEventListener('keyup', function() {
    const termo = input.value.trim();
    if (termo.length < 3) {
        resultados.innerHTML = '';
        return;
    }

    fetch(`https://www.googleapis.com/books/v1/volumes?q=${encodeURIComponent(termo)}`)
        .then(res => res.json())
        .then(data => {
            resultados.innerHTML = '';
            if (data.items) {
                data.items.forEach(item => {
                    const info = item.volumeInfo;
                    const titulo = info.title || 'Sem título';
                    const autores = info.authors ? info.authors.join(', ') : 'Desconhecido';
                    const imagem = info.imageLinks ? info.imageLinks.thumbnail : 'https://via.placeholder.com/80x120?text=Sem+Capa';
                    const isbn = info.industryIdentifiers ? info.industryIdentifiers[0].identifier : '';

                    const div = document.createElement('div');
                    div.className = 'livro';
                    div.innerHTML = `
                        <img src="${imagem}" alt="Capa">
                        <div>
                            <h3>${titulo}</h3>
                            <p><strong>Autor(es):</strong> ${autores}</p>
                            ${isbn ? `<p><strong>ISBN:</strong> ${isbn}</p>` : ''}
                            <button onclick='cadastrarLivro(${JSON.stringify(titulo)}, ${JSON.stringify(autores)}, ${JSON.stringify(isbn)})'>Cadastrar</button>
                        </div>
                    `;
                    resultados.appendChild(div);
                });
            } else {
                resultados.innerHTML = '<p>Nenhum livro encontrado.</p>';
            }
        });
});

function cadastrarLivro(titulo, autor, isbn) {
    const formData = new FormData();
    formData.append('titulo', titulo);
    formData.append('autor', autor);
    formData.append('isbn', isbn);

    fetch('/tcc/livros/livro.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(response => {
        alert(response.message);
    })
    .catch(() => {
        alert('Erro ao cadastrar livro.');
    });
}
</script>

</body>
</html>
