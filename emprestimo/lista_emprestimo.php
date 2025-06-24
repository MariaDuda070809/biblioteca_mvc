<?php
require '../db.php';

$sql = "SELECT 
    e.id AS id, 
    a.nome AS aluno_nome, 
    a.salas AS salas,
    a.email AS email,
    p.nome AS professor_nome, 
    l.nome_livro AS livro_nome,
    e.data_retirada, 
    e.data_devolucao
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
    <title>Empréstimos Cadastrados</title>
    <link rel="icon" href="../imagens/icon.jpg" type="image/gif" sizes="16x16" />
    <style>
        body {
            background-color: #fff0f5;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1100px;
            margin: 60px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h3 {
            text-align: center;
            color: #c71585;
            margin-bottom: 20px;
        }

        .search-box {
            margin-bottom: 20px;
            text-align: center;
        }

        #searchInput {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        .table-pink {
            width: 100%;
            border-collapse: collapse;
        }

        .table-pink th, .table-pink td {
            padding: 10px;
            border: 1px solid #f2a3c2;
            text-align: left;
        }

        .table-pink th {
            background-color: #ffc0cb;
            color: #333;
        }

        .table-pink tbody tr:nth-child(even) {
            background-color: #fff5f8;
        }

        .btn-status {
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn {
            background: #f48fb1;
            padding: 10px 16px;
            text-decoration: none;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #d81b60;
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .no-data {
            text-align: center;
            color: #999;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h3>Empréstimos Cadastrados</h3>

    <div class="search-box">
        <input type="text" id="searchInput" placeholder="Pesquisar por aluno, livro, professor, sala ou email...">
    </div>

    <table class="table-pink" id="emprestimosTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Aluno</th>
                <th>Sala</th>
                <th>Email</th>
                <th>Livro</th>
                <th>Professor</th>
                <th>Data Retirada</th>
                <th>Data Devolução</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($emprestimos)) {
            foreach ($emprestimos as $emprestimo): 
                $hoje = date('Y-m-d');
                $data_devolucao = $emprestimo['data_devolucao'];
                $atrasado = (strtotime($data_devolucao) < strtotime($hoje));
                $btnTexto = $atrasado ? 'Atrasado' : 'No prazo';
                $btnCor = $atrasado ? '#f44336' : '#4CAF50';
        ?>
        <tr id="linha-<?php echo $emprestimo['id']; ?>">
            <td><?php echo $emprestimo['id']; ?></td>
            <td><?php echo htmlspecialchars($emprestimo['aluno_nome']); ?></td>
            <td><?php echo htmlspecialchars($emprestimo['salas']); ?></td>
            <td><?php echo htmlspecialchars($emprestimo['email']); ?></td>
            <td><?php echo htmlspecialchars($emprestimo['livro_nome']); ?></td>
            <td><?php echo htmlspecialchars($emprestimo['professor_nome']); ?></td>
            <td><?php echo htmlspecialchars($emprestimo['data_retirada']); ?></td>
            <td><?php echo htmlspecialchars($emprestimo['data_devolucao']); ?></td>
            <td>
                <button 
                    class="btn-status" 
                    style="background-color: <?= $btnCor ?>" 
                    onclick="confirmarDevolucao(<?= $emprestimo['id']; ?>)">
                    <?= $btnTexto ?>
                </button>
            </td>
        </tr>
        <?php endforeach;
        } else {
            echo "<tr><td colspan='9' class='no-data'>Nenhum empréstimo encontrado.</td></tr>";
        } ?>
        </tbody>
    </table>

    <a href="../listas.php" class="back-button">
        <button class="btn">←</button>
    </a>
</div>

<script>
function confirmarDevolucao(emprestimoId) {
    if (confirm("Livro devolvido?")) {
        fetch('marcar_devolvido.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'id=' + emprestimoId
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const linha = document.getElementById('linha-' + emprestimoId);
                if (linha) linha.remove();
                alert("Livro marcado como devolvido.");
            } else {
                alert("Erro ao marcar como devolvido.");
            }
        })
        .catch(error => {
            console.error("Erro:", error);
            alert("Erro na comunicação com o servidor.");
        });
    }
}

const searchInput = document.getElementById("searchInput");
const table = document.getElementById("emprestimosTable").getElementsByTagName("tbody")[0];

searchInput.addEventListener("keyup", function () {
    const filter = searchInput.value.toLowerCase();
    const rows = table.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
        const texto = rows[i].textContent.toLowerCase();
        rows[i].style.display = texto.includes(filter) ? "" : "none";
    }
});
</script>

</body>
</html>
