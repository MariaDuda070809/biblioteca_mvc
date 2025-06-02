<?php
require '../db.php';

$sql = "SELECT 
    e.id AS id, 
    a.nome AS aluno_nome, 
    a.serie AS serie,
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

</head>
<body>

<h3>Empréstimos Cadastrados</h3>

<table class="table-pink">

    <thead>
        <tr>
            <th>ID</th>
            <th>Aluno</th>
            <th>Série</th>
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
            <td><?php echo htmlspecialchars($emprestimo['serie']); ?></td>
            <td><?php echo htmlspecialchars($emprestimo['email']); ?></td>
            <td><?php echo htmlspecialchars($emprestimo['livro_nome']); ?></td>
            <td><?php echo htmlspecialchars($emprestimo['professor_nome']); ?></td>
            <td><?php echo htmlspecialchars($emprestimo['data_retirada']); ?></td>
            <td><?php echo htmlspecialchars($emprestimo['data_devolucao']); ?></td>
            <td>
            <button 
                class="btn-status" 
                style="background-color: <?php echo $btnCor; ?>" 
                onclick="confirmarDevolucao(<?php echo $emprestimo['id']; ?>)">
                <?php echo $btnTexto; ?>
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
    <button class="btn">
        ←
    </button>
</a>

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
</script>

</body>
</html>
