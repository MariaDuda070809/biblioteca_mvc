<?php
// Incluir o arquivo de configuração para conectar ao banco de dados
include '../db.php';

// Consultar todos os professores
$sql = "SELECT * FROM professores";
$stmt = $pdo->prepare($sql); // Prepara a consulta
$stmt->execute(); // Executa a consulta
$professores = $stmt->fetchAll(); // Armazena os resultados na variável $professores
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Professores</title>
</head>
<body>

<h3>Lista de Professores</h3>

<table class="table-pink">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Cpf</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Inclui o arquivo que traz a lista de professores
        @include '../professores.php'; // Verifique o caminho do arquivo

        // Verifique se a variável $professores foi definida e se é um array
        if (isset($professores) && is_array($professores)) {
            foreach ($professores as $professor): ?>
                <tr>
                    <td><?php echo $professor['id']; ?></td>
                    <td><?php echo htmlspecialchars($professor['nome']); ?></td>
                    <td><?php echo htmlspecialchars($professor['cpf']); ?></td>
                </tr>
            <?php endforeach; 
        } else {
            echo "<tr><td colspan='3' class='no-data'>Nenhum professor encontrado.</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
<a href="../listas.php" class="back-button">
    <button class="btn">
        ←
    </button>
</a>
