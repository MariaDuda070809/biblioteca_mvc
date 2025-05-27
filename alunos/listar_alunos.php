<?php
// Incluir o arquivo de configuração para conectar ao banco de dados
require '../db.php';

// Consultar todos os professores
$sql = "SELECT * FROM alunos";
$stmt = $pdo->prepare($sql); // Prepara a consulta
$stmt->execute(); // Executa a consulta
$alunos = $stmt->fetchAll(); // Armazena os resultados na variável $professores
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alunos</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<h3>Lista de alunos</h3>

<table class="table-pink">

    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Serie</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Inclui o arquivo que traz a lista de professores
        @include ('../alunos.php'); // Verifique o caminho do arquivo

        // Verifique se a variável $professores foi definida e se é um array
        if (isset($alunos) && is_array($alunos)) {
            foreach ($alunos as $alunos): ?>
                <tr>
                    <td><?php echo $alunos['id']; ?></td>
                    <td><?php echo htmlspecialchars($alunos['nome']); ?></td>
                    <td><?php echo htmlspecialchars($alunos['serie']); ?></td>
                    <td><?php echo htmlspecialchars($alunos['email']); ?></td>
                </tr>
            <?php endforeach; 
        } else {
            echo "<tr><td colspan='3' class='no-data'>Nenhum aluno encontrado.</td></tr>";
        }
        ?>
    </tbody>
</table>

<a href="../listas.php" class="btn" style="position: absolute; top: 20px; left:20px;">
    ←
</a>
</body>
</html>
