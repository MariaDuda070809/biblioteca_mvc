<?php
// Incluir o arquivo de configuração para conectar ao banco de dados
require '../db.php';

// Consultar todos os professores
$sql = "SELECT * FROM livros";
$stmt = $pdo->prepare($sql); // Prepara a consulta
$stmt->execute(); // Executa a consulta
$livros = $stmt->fetchAll(); // Armazena os resultados na variável $professores
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros Cadastrados</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<h3>Livros Cadastrados</h3>

<table class="styled-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Autor</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Inclui o arquivo que traz a lista de professores
        @include '../livro.php'; // Verifique o caminho do arquivo

        // Verifique se a variável $professores foi definida e se é um array
        if (isset($livros) && is_array($livros)) {
            foreach ($livros as $livros): ?>
                <tr>
                    <td><?php echo $livros['id']; ?></td>
                    <td><?php echo htmlspecialchars($livros['nome_livro']); ?></td>
                    <td><?php echo htmlspecialchars($livros['nome_autor']); ?></td>
                </tr>
            <?php endforeach; 
        } else {
            echo "<tr><td colspan='3' class='no-data'>Nenhum livro encontrado.</td></tr>";
        }
        ?>
    </tbody>
</table>

<a href="../listas.php" class="btn" style="position: absolute; top: 20px; left:20px;">
    ←
</a>
</body>
</html>
