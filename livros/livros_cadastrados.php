<?php
require '../db.php';

$sql = "SELECT * FROM livros";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros Cadastrados</title>
    <link rel="icon" href="../imagens/icon.jpg" type="image/gif" sizes="16x16" />
    <style>
        body {
            background-color:rgb(235, 185, 255);
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
            font-size: 28px;
            color:rgb(126, 15, 160);
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
            border: 1px solidrgb(101, 19, 179);
            text-align: left;
        }

        .table-pink th {
            background-color:rgb(150, 50, 207);
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
            background:rgb(160, 28, 221);
            padding: 10px 16px;
            text-decoration: none;
            color: white;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn:hover {
            background:rgb(98, 12, 133);
        }
              #btn-voltar {
  position: absolute;
  top: 20px;
  left: 20px;
  background-color: rgb(189, 119, 235);
  color: white;
  padding: 10px 16px;
  border: none;
  border-radius: 8px;
  font-weight: bold;
  text-decoration: none;
  transition: all 0.2s ease-in-out;
  z-index: 999;
}

#btn-voltar:hover {
  background-color: rgb(100, 5, 129);
  transform: scale(1.05);
}

    </style>
</head>
<body>
<div class="container">
    <h3>Livros Cadastrados</h3>

    <div class="search-box">
        <input type="text" id="searchInput" placeholder="Pesquisar por nome ou autor...">
    </div>

    <table class="table-pink" id="livrosTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Autor</th>
                <th>ISBN</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($livros): ?>
                <?php foreach ($livros as $livro): ?>
                    <tr>
                        <td><?= $livro['id']; ?></td>
                        <td><?= htmlspecialchars($livro['nome_livro']); ?></td>
                        <td><?= htmlspecialchars($livro['nome_autor']); ?></td>
                        <td><?= htmlspecialchars($livro['isbn']); ?></td>
                         <td>
        <a class="btn" style="background:rgb(216, 142, 245);" 
           href="excluir_livros.php?id=<?= $livro['id']; ?>" 
           onclick="return confirm('Tem certeza que deseja excluir este livro?');">
            Excluir
        </a>
    </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3" class="no-data">Nenhum livro encontrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

      <a href="../listas.php" id="btn-voltar">← Voltar</a>
</div>

<script>
    const searchInput = document.getElementById("searchInput");
    const table = document.getElementById("livrosTable").getElementsByTagName("tbody")[0];

    searchInput.addEventListener("keyup", function () {
        const filter = searchInput.value.toLowerCase();
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            const nome = rows[i].cells[1].textContent.toLowerCase();
            const autor = rows[i].cells[2].textContent.toLowerCase();
            rows[i].style.display = (nome.includes(filter) || autor.includes(filter)) ? "" : "none";
        }
    });
</script>
</body>
</html>
