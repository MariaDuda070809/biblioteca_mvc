<?php
// Processamento do cadastro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    include '../db.php';

    $nome_livro = $_POST['nome_livro'] ?? '';
    $nome_autor = $_POST['nome_autor'] ?? '';
    $isbn = $_POST['isbn'] ?? '';

    if (empty($nome_livro) || empty($nome_autor)) {
        echo json_encode(['status' => 'error', 'message' => 'Título e autor são obrigatórios.']);
        exit;
    }

    try {
       
        // Inserir o livro
        $sql = "INSERT INTO livros (nome_livro, nome_autor, isbn) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome_livro, $nome_autor, $isbn]);

        echo json_encode(['status' => 'success', 'message' => 'Livro cadastrado com sucesso!']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao cadastrar: ' . $e->getMessage()]);
    }
    exit;
    
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Buscar e Cadastrar Livro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container py-4">

<h1 class="mb-4">Buscar e Cadastrar Livro</h1>
<input type="text" id="busca" class="form-control mb-3" placeholder="Digite o nome do livro..." />
<div id="resultados"></div>
<div id="mensagem" class="mt-3"></div>

<script>
    const input = document.getElementById('busca');
    const resultados = document.getElementById('resultados');
    const mensagem = document.getElementById('mensagem');

    input.addEventListener('input', () => {
        const termo = input.value.trim();
        resultados.innerHTML = '';
        mensagem.innerHTML = '';

        if (termo.length < 3) return;

        fetch(`https://www.googleapis.com/books/v1/volumes?q=${encodeURIComponent(termo)}`)
            .then(res => res.json())
            .then(data => {
                resultados.innerHTML = '';

                if (!data.items) {
                    resultados.innerHTML = '<p>Nenhum livro encontrado.</p>';
                    return;
                }

                data.items.slice(0, 5).forEach(livro => {
                    const info = livro.volumeInfo;
                    const nome_livro = info.title || 'Sem título';
                    const nome_autor = (info.authors && info.authors.join(', ')) || 'Desconhecido';
                    const isbn = (info.industryIdentifiers && info.industryIdentifiers[0].identifier) || '';
                    const capa = (info.imageLinks && info.imageLinks.thumbnail) || 'https://via.placeholder.com/100x150?text=Sem+Capa';

                    const div = document.createElement('div');
                    div.classList.add('card', 'mb-2', 'p-3');
                    div.innerHTML = `
                        <div class="d-flex align-items-start">
                            <img src="${capa}" alt="Capa do livro" class="me-3" style="width:100px;">
                            <div>
                                <strong>Título:</strong> ${nome_livro}<br>
                                <strong>Autor:</strong> ${nome_autor}<br>
                                ${isbn ? `<strong>ISBN:</strong> ${isbn}<br>` : ''}
                                <button class="btn btn-success mt-2">Cadastrar</button>
                            </div>
                        </div>
                    `;

                    div.querySelector('button').addEventListener('click', () => {
                        cadastrarLivro(nome_livro, nome_autor, isbn);
                    });

                    resultados.appendChild(div);
                });
            });
    });

    function cadastrarLivro(nome_livro, nome_autor, isbn) {
        mensagem.innerHTML = `
            <div class="alert alert-info" role="alert">
                Cadastrando livro...
            </div>
        `;

        const formData = new FormData();
        formData.append('nome_livro', nome_livro);
        formData.append('nome_autor', nome_autor);
        formData.append('isbn', isbn);

        fetch('livro_buscar_cadastrar.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            if (data.status === 'success') {
                window.location.href = 'livro_buscar_cadastrar.php'; // redireciona para página de livros cadastrados
            } else {
                mensagem.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                `;
                setTimeout(() => { mensagem.innerHTML = ''; }, 5000);
            }
        })
        .catch(err => {
            mensagem.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Erro ao conectar com o servidor.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            `;
            console.error('Erro:', err);
            setTimeout(() => { mensagem.innerHTML = ''; }, 5000);
        });
    }
    
</script>

     <a href="../dashboard.php" class="back-button">
<
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
