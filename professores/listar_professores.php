<?php
include '../db.php';

$sql = "SELECT * FROM professores";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$professores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Professores</title>
    <link rel="icon" href="../imagens/icon.jpg" type="image/gif" sizes="16x16" />
    <style>
        body {
            background-color: #fff0f5;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
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
            padding: 12px;
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

        .no-data {
            text-align: center;
            color: #999;
            padding: 20px;
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
    </style>
</head>
<body>
<div class="container">
    <h3>Lista de Professores</h3>

    <div class="search-box">
        <input type="text" id="searchInput" placeholder="Pesquisar por nome ou CPF...">
    </div>

    <table class="table-pink" id="professoresTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($professores): ?>
                <?php foreach ($professores as $professor): ?>
                    <tr>
                        <td><?= $professor['id']; ?></td>
                        <td><?= htmlspecialchars($professor['nome']); ?></td>
                        <td><?= htmlspecialchars($professor['cpf']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3" class="no-data">Nenhum professor encontrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="../listas.php" class="back-button">
        <button class="btn">←</button>
    </a>
</div>

<script>
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
</script>
</body>
</html>
