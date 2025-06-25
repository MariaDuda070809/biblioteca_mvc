<?php
require '../db.php';

$editando = false;
$alunoEditado = null;

if (isset($_GET['editar'])) {
    $editando = true;
    $id = $_GET['editar'];
    $stmt = $pdo->prepare("SELECT * FROM alunos WHERE id = ?");
    $stmt->execute([$id]);
    $alunoEditado = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['atualizar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $salas = $_POST['salas'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("UPDATE alunos SET nome = ?, salas = ?, email = ? WHERE id = ?");
    $stmt->execute([$nome, $salas, $email, $id]);

    header("Location: listar_alunos.php");
    exit();
}

$sql = "SELECT * FROM alunos";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alunos</title>
    <link rel="icon" href="../imagens/icon.jpg" type="image/gif" sizes="16x16" />
    <style>
        body {
            background-color:rgb(197, 212, 255);
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1100px;
            margin: 60px auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        h3 {
            text-align: center;
            color: rgb(56, 69, 250);
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
            background-color: rgb(69, 66, 243);
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
        }

        .btn-editar {
            background-color: rgb(84, 124, 255);
        }

        .btn-editar:hover {
            background-color: rgb(65, 76, 231);
        }

        .btn-excluir {
            background-color: rgb(23, 59, 218);
        }

        .btn-excluir:hover {
            background-color:rgb(19, 5, 145);
        }


        .form-edicao {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #f0f3f5;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        .form-edicao input, .form-edicao button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            font-size: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .form-edicao button {
            background-color:hsl(229, 81.10%, 64.70%);
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .form-edicao button:hover {
            background-color:rgb(43, 75, 221);
        }
              #btn-voltar {
  position: absolute;
  top: 20px;
  left: 20px;
  background-color: rgb(72, 69, 228);
  color: white;
  padding: 5px 10px;
  border: none;
  border-radius: 8px;
  font-weight: bold;
  text-decoration: none;
  transition: all 0.2s ease-in-out;
  z-index: 999;
}

#btn-voltar:hover {
  background-color: rgb(11, 41, 99);
  transform: scale(1.05);
}

    </style>
</head>
<body>
    <div class="container">
        <h3>Lista de Alunos</h3>

        <?php if ($editando && $alunoEditado): ?>
        <form method="post" class="form-edicao">
            <input type="hidden" name="id" value="<?= $alunoEditado['id']; ?>">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($alunoEditado['nome']); ?>" required>

            <label>Série:</label>
            <input type="text" name="salas" value="<?= htmlspecialchars($alunoEditado['salas']); ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($alunoEditado['email']); ?>" required>

            <button type="submit" name="atualizar">Salvar Alterações</button>
        </form>
        <?php endif; ?>

        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Pesquisar por nome, série ou email...">
        </div>

        <table id="alunosTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Série</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($alunos): ?>
                    <?php foreach ($alunos as $aluno): ?>
                    <tr>
                        <td><?= $aluno['id']; ?></td>
                        <td><?= htmlspecialchars($aluno['nome']); ?></td>
                        <td><?= htmlspecialchars($aluno['salas']); ?></td>
                        <td><?= htmlspecialchars($aluno['email']); ?></td>
                        <td>
                            <div style="display: flex; justify-content: center; gap: 8px;">
                                <a class="btn btn-editar" href="?editar=<?= $aluno['id']; ?>">Editar</a>
                                <a class="btn btn-excluir" href="excluir_aluno.php?id=<?= $aluno['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este aluno?');">Excluir</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">Nenhum aluno encontrado.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

          <a href="../listas.php" id="btn-voltar">← Voltar</a>
    </div>

    <script>
        const searchInput = document.getElementById("searchInput");
        const table = document.getElementById("alunosTable").getElementsByTagName("tbody")[0];

        searchInput.addEventListener("keyup", function () {
            const filter = searchInput.value.toLowerCase();
            const rows = table.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const nome = rows[i].cells[1].textContent.toLowerCase();
                const serie = rows[i].cells[2].textContent.toLowerCase();
                const email = rows[i].cells[3].textContent.toLowerCase();
                rows[i].style.display = (nome.includes(filter) || serie.includes(filter) || email.includes(filter)) ? "" : "none";
            }
        });
    </script>
</body>
</html>
