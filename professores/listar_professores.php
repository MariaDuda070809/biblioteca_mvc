<?php
require '../db.php';

$editando = false;
$professorEditado = null;

if (isset($_GET['editar'])) {
    $editando = true;
    $id = $_GET['editar'];
    $stmt = $pdo->prepare("SELECT * FROM professores WHERE id = ?");
    $stmt->execute([$id]);
    $professorEditado = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['atualizar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    // Remove tudo que não for número antes de salvar (limpa máscara)
    $cpf = preg_replace('/\D/', '', $_POST['cpf']);
    $email = $_POST['email'];

    $stmt = $pdo->prepare("UPDATE professores SET nome = ?, cpf = ?, email = ? WHERE id = ?");
    $stmt->execute([$nome, $cpf, $email, $id]);

    header("Location: listar_professores.php");
    exit();
}

if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $stmt = $pdo->prepare("DELETE FROM professores WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: listar_professores.php");
    exit();
}

$sql = "SELECT * FROM professores";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$professores = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Função para formatar CPF na exibição (000.000.000-00)
function formatCPF($cpf) {
    if (strlen($cpf) === 11) {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $cpf);
    }
    return $cpf;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lista de Professores</title>
    <link rel="icon" href="../imagens/icon.jpg" type="image/gif" sizes="16x16" />
    <style>
        body {
            background-color:rgb(215, 253, 251);
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 960px;
            margin: 60px auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        h3 {
            text-align: center;
            color:rgb(47, 238, 212);
            font-size: 24px;
            margin-bottom: 30px;
        }
        .search-box {
            margin-bottom: 25px;
            text-align: center;
        }
        #searchInput {
            width: 60%;
            padding: 10px 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th, table td {
            padding: 14px 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        table th {
            background-color:rgb(11, 218, 173);
            color: #fff;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .btn {
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            color: #fff;
            transition: background-color 0.2s ease;
            cursor: pointer;
            border: none;
        }
        .btn-editar {
            background-color:rgb(67, 240, 173);
        }
        .btn-editar:hover {
            background-color:rgb(27, 190, 128);
        }
        .btn-excluir {
            background-color:rgb(81, 240, 205);
        }
        .btn-excluir:hover {
            background-color:rgb(18, 153, 146);
        }
        .btn-voltar {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color:rgb(36, 243, 226);
        }
        .btn-voltar:hover {
            background-color:rgb(14, 165, 165);
        }
        .form-edicao {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #f0f3f5;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .form-edicao label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
            color: #34495e;
        }
        .form-edicao input, .form-edicao button {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            font-size: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }
        .form-edicao button {
            background-color:rgb(80, 231, 223);
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .form-edicao button:hover {
            background-color: rgb(11, 133, 133);
        }
    </style>
</head>
<body>
<div class="container">
    <h3>Lista de Professores</h3>

    <?php if ($editando && $professorEditado): ?>
    <form method="post" class="form-edicao">
        <input type="hidden" name="id" value="<?= $professorEditado['id']; ?>">
        
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($professorEditado['nome']); ?>" required>

        <label>CPF:</label>
        <input 
            type="text" 
            name="cpf" 
            id="cpfInput"
            value="<?= htmlspecialchars(formatCPF($professorEditado['cpf'])); ?>" 
            maxlength="14" 
            required
            placeholder="000.000.000-00"
            autocomplete="off"
        >

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($professorEditado['email']); ?>" required>

        <button type="submit" name="atualizar">Salvar Alterações</button>
    </form>
    <?php endif; ?>

    <div class="search-box">
        <input type="text" id="searchInput" placeholder="Pesquisar por nome ou CPF...">
    </div>

    <table id="professoresTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($professores): ?>
                <?php foreach ($professores as $professor): ?>
                    <tr>
                        <td><?= $professor['id']; ?></td>
                        <td><?= htmlspecialchars($professor['nome']); ?></td>
                        <td><?= htmlspecialchars(formatCPF($professor['cpf'])); ?></td>
                        <td><?= htmlspecialchars($professor['email']); ?></td>
                        <td>
                            <div style="display: flex; justify-content: center; gap: 8px;">
                                <a class="btn btn-editar" href="?editar=<?= $professor['id']; ?>">Editar</a>
                                <a class="btn btn-excluir" href="?excluir=<?= $professor['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este professor?');">Excluir</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" class="no-data">Nenhum professor encontrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="../listas.php" class="btn btn-voltar">← Voltar</a>
</div>

<script>
    // Pesquisa
    const searchInput = document.getElementById("searchInput");
    const table = document.getElementById("professoresTable").getElementsByTagName("tbody")[0];

    searchInput.addEventListener("keyup", function () {
        const filter = searchInput.value.toLowerCase();
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            const nome = rows[i].cells[1].textContent.toLowerCase();
            const cpf = rows[i].cells[2].textContent.toLowerCase();
            rows[i].style.display = (nome.includes(filter) || cpf.includes(filter)) ? "" : "none";
        }
    });

    // Máscara para CPF no input
    const cpfInput = document.getElementById('cpfInput');

    cpfInput.addEventListener('input', function(e) {
        let value = e.target.value;

        // Remove tudo que não for número
        value = value.replace(/\D/g, '');

        // Limita a 11 números
        if (value.length > 11) {
            value = value.slice(0, 11);
        }

        // Aplica a máscara 000.000.000-00
        value = value.replace(/^(\d{3})(\d)/, '$1.$2');
        value = value.replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3');
        value = value.replace(/^(\d{3})\.(\d{3})\.(\d{3})(\d)/, '$1.$2.$3-$4');

        e.target.value = value;
    });
</script>
</body>
</html>
