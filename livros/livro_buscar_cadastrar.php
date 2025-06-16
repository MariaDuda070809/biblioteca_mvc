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
    <title>Biblioteca - Buscar e Cadastrar Livro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
       body {
    height: 100vh;
    margin: 0;
    background: url('../imagens/buscar_procurar.jpg') no-repeat center center fixed;
    background-size: cover;
    font-family: 'Merriweather', serif;
    overflow-x: hidden;
    
}

/* Topo fixo com barra de busca */
.top-bar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.7);
    z-index: 1050;
}

/* Espaço para o conteúdo após a barra fixa */
.content-wrapper {
    margin-top: 10px;
    background-color: rgba(255, 255, 255, 0.45); /* menos transparente */
    box-shadow: 0 4px 20px rgba(0,0,0,0.55);
    border-radius: 20px;
}

/* Botão voltar */
.btn-voltar {
    position: fixed;
    top: 20px;
    left: 20px;
    background-color: rgb(125, 25, 115);
    color: rgb(236, 233, 238);
    font-size: 20px;
    font-weight: bold;
    padding: 10px 16px;
    border-radius: 50%;
    border: 2px solid rgb(125, 25, 115);
    text-decoration: none;
    transition: all 0.3s ease;
    z-index: 1100;
}

.btn-voltar:hover {
    background-color: rgb(222, 115, 255);
    color: white;
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

/* Cards de resultado */
.card {
    background: #ffffff;
    border: none;
    border-left: 5px solidrgb(103, 0, 114);
    transition: all 0.3s ease;
    border-radius: 20px;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.btn-success {
    border-radius: 20px;
    padding: 6px 18px;
    background-color:rgb(125, 25, 115); 
    border-color: rgb(125, 25, 115);
}

/* Mensagem de sucesso no centro da tela */
.mensagem-central {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999;
    min-width: 300px;
    max-width: 90%;
    padding: 20px;
    background-color: #fff;
    border: 2px solid rgb(125, 25, 115);
    text-align: center;
    box-shadow: 0 0 20px rgba(0,0,0,0.3);
    display: none;
}

.mensagem-central.show {
    display: block;
    animation: fadeInOut 4s forwards;
}

@keyframes fadeInOut {
    0% { opacity: 0; }
    10% { opacity: 1; }
    90% { opacity: 1; }
    100% { opacity: 0; display: none; }
}
h1 {
  font-weight: 700; /* ou 800, 900 para mais grosso */
  text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

    
    </style>
</head>
<body class="container py-5">

<a href="../dashboard.php" class="btn btn-voltar">🡸</a>

<div class="content-wrapper container p-4 shadow-lg rounded">
    <h1 class="mb-4 text-center">Biblioteca - Buscar e Cadastrar Livro</h1>

    <input type="text" id="busca" class="form-control mb-4" placeholder="Digite o nome do livro..." />

    <div id="resultados"></div>
    <div id="mensagem" class="mt-3"></div>
    <div id="mensagem-central" class="mensagem-central alert alert-success"></div>
</div>

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
                        resultados.innerHTML = '<p class="text-muted">Nenhum livro encontrado.</p>';
                        return;
                    }

                    data.items.slice(0, 5).forEach(livro => {
                        const info = livro.volumeInfo;
                        const nome_livro = info.title || 'Sem título';
                        const nome_autor = (info.authors && info.authors.join(', ')) || 'Desconhecido';
                        const isbn = (info.industryIdentifiers && info.industryIdentifiers[0].identifier) || '';
                        const capa = (info.imageLinks && info.imageLinks.thumbnail) || 'https://via.placeholder.com/100x150?text=Sem+Capa';

                        const div = document.createElement('div');
                        div.classList.add('card', 'mb-3', 'p-3');
                        div.innerHTML = `
                            <div class="d-flex align-items-start">
                                <img src="${capa}" alt="Capa do livro" class="me-3 rounded" style="width:100px;">
                                <div>
                                    <h5>${nome_livro}</h5>
                                    <p class="mb-1"><strong>Autor:</strong> ${nome_autor}</p>
                                    ${isbn ? `<p class="mb-1"><strong>ISBN:</strong> ${isbn}</p>` : ''}
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

        function cadastrarLivro(nome_livro, nome_autor, isbn, verificados) {
            const formData = new FormData();
            formData.append('nome_livro', nome_livro);
            formData.append('nome_autor', nome_autor);
            formData.append('isbn', isbn);
            formData.append('verificados', verificados);

            fetch('livro_buscar_cadastrar.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                mostrarMensagemCentral(data.message, data.status === 'success' ? 'success' : 'danger');

                if (data.status === 'success') {
                    setTimeout(() => {
                        window.location.href = 'livro_buscar_cadastrar.php';
                    }, 2500);
                }
            })
            .catch(err => {
                mostrarMensagemCentral("Erro ao conectar com o servidor.", "danger");
                console.error('Erro:', err);
            });
        }

        function mostrarMensagemCentral(texto, tipo = 'success') {
            const box = document.getElementById('mensagem-central');
            box.className = `mensagem-central alert alert-${tipo} show`;
            box.textContent = texto;

            setTimeout(() => {
                box.classList.remove('show');
            }, 4000);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
