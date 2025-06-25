<?php
require '../db.php';

$sql = "SELECT 
    e.id AS id, 
    a.id AS aluno_id,
    a.nome AS aluno_nome, 
    a.salas AS salas,
    a.email AS email,
    p.nome AS professor_nome, 
    p.email AS professor_email,
    l.nome_livro AS livro_nome,
    e.data_retirada, 
    e.data_devolucao,
    e.status,
    (
        SELECT COUNT(*) 
        FROM emprestimos e2 
        WHERE e2.aluno_id = e.aluno_id AND e2.id <= e.id
    ) AS numero_emprestimo
FROM emprestimos e
INNER JOIN alunos a ON e.aluno_id = a.id
INNER JOIN professores p ON e.professor_id = p.id
INNER JOIN livros l ON e.livro_id = l.id
ORDER BY e.id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$emprestimos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Empréstimos</title>
    <link rel="icon" href="../imagens/icon.jpg" type="image/gif" />
    <style>
    body {
        background-color: rgb(206, 252, 214);
        font-family: 'Segoe UI', sans-serif;
        margin: 0;
        padding: 20px;
    }

    h2 {
        text-align: center;
        color: #444;
        margin-bottom: 30px;
    }

    .card {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .left, .right {
        width: 48%;
    }

    .left h4, .right h4 {
        margin-top: 0;
        color: #444;
        margin-bottom: 8px;
    }

    .info {
        margin-bottom: 10px;
        color: #333;
    }

    /* ------------------ BOTÕES COM TRANSIÇÃO ------------------ */
    .btn, .btn-marcar, .status-btn {
        transition: all 0.3s ease;
        transform: scale(1);
    }

    .btn:hover, .btn-marcar:hover, .status-btn:hover {
        transform: scale(1.08);
    }

    /* Botão voltar e filtros */
    .btn {
        background:rgb(47, 218, 113);
        padding: 8px 14px;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
    }

    .btn:hover {
        background:rgb(26, 184, 97);
    }

    /* Botão marcar como devolvido */
    .btn-marcar {
        background-color:rgb(48, 218, 133);
        color: white;
        padding: 8px 12px;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        cursor: pointer;
    }

    .btn-marcar:hover {
        background-color:rgb(36, 155, 72);
    }

    /* Status */
    .status-btn {
        padding: 8px 12px;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        color: white;
        cursor: default;
    }

    .prazo {
        background-color:rgb(14, 161, 19); /* verde */
    }

    .atrasado {
        background-color:rgb(219, 22, 8); /* vermelho */
    }

    .devolvido {
        background-color:rgb(2, 114, 206); /* azul */
    }

    /* Filtros e busca */
    .search-box, .filter-box {
        text-align: center;
        margin-bottom: 20px;
    }

    #searchInput {
        width: 60%;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 16px;
    }

    .filter-box .btn {
        margin: 5px;
    }
</style>

</head>
<body>
<a href="../listas.php">
    <button class="btn" style="margin-bottom: 15px;">← Voltar</button>
</a>

<h2>Lista de Empréstimos</h2>


<div class="search-box">
    <input type="text" id="searchInput" placeholder="Pesquisar por aluno, livro, professor, sala ou email...">
</div>

<div class="filter-box">
    <button class="btn" onclick="filtrarStatus('todos')">Todos</button>
    <button class="btn" onclick="filtrarStatus('No prazo')">No prazo</button>
    <button class="btn" onclick="filtrarStatus('Atrasado')">Atrasado</button>
    <button class="btn" onclick="filtrarStatus('Devolvido')">Devolvido</button>
</div>

<div id="emprestimosContainer">
<?php
$hoje = date('Y-m-d');

foreach ($emprestimos as $emp):
    $devolvido = $emp['status'] == 1;
    $atrasado = !$devolvido && strtotime($emp['data_devolucao']) < strtotime($hoje);
    $statusTexto = $devolvido ? 'Devolvido' : ($atrasado ? 'Atrasado' : 'No prazo');
    $classeStatus = $devolvido ? 'devolvido' : ($atrasado ? 'atrasado' : 'prazo');
?>
    <div class="card" data-status="<?= $statusTexto ?>" data-texto="<?= strtolower($emp['aluno_nome'] . ' ' . $emp['livro_nome'] . ' ' . $emp['professor_nome'] . ' ' . $emp['salas'] . ' ' . $emp['email']) ?>">
        <div class="left">
            <h4>Aluno: <?= htmlspecialchars($emp['aluno_nome']) ?></h4>
            <div class="info">Sala: <?= htmlspecialchars($emp['salas']) ?></div>
            <div class="info">Email: <?= htmlspecialchars($emp['email']) ?></div>
            <div class="info">Livro: <?= htmlspecialchars($emp['livro_nome']) ?></div>
            <div class="info">Retirada: <?= date('d/m/Y', strtotime($emp['data_retirada'])) ?></div>
            <div class="info">Devolução prevista: <?= date('d/m/Y', strtotime($emp['data_devolucao'])) ?></div>
            <div class="info">Classificação: <?= $emp['numero_emprestimo'] ?>º empréstimo</div>
        </div>
        <div class="right">
            <h4>Professor: <?= htmlspecialchars($emp['professor_nome']) ?></h4>
            <div class="info">Email: <?= htmlspecialchars($emp['professor_email']) ?></div>
            <div style="margin-top: 20px;">
                <span class="status-btn <?= $classeStatus ?>"><?= $statusTexto ?></span>
                    <?php if (!$devolvido): ?>
                        <button class="btn-marcar" onclick="confirmarDevolucao(<?= $emp['id'] ?>)">Marcar como devolvido</button>
                    <?php endif; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>

<script>
function confirmarDevolucao(id) {
    if (confirm("Confirmar devolução do livro?")) {
        fetch('marcar_devolvido.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id=' + id
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert("Erro ao marcar como devolvido.");
            }
        })
        .catch(() => alert("Erro ao se comunicar com o servidor."));
    }
}

const searchInput = document.getElementById("searchInput");
const cards = document.querySelectorAll(".card");

searchInput.addEventListener("keyup", function () {
    const filtro = searchInput.value.toLowerCase();
    cards.forEach(card => {
        const texto = card.dataset.texto;
        card.style.display = texto.includes(filtro) ? "" : "none";
    });
});

function filtrarStatus(status) {
    cards.forEach(card => {
        const cardStatus = card.dataset.status;
        card.style.display = (status === "todos" || cardStatus === status) ? "" : "none";
    });
}
</script>

</body>
</html>
