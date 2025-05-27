
    <!-- Formulário para criar um novo usuário -->
    <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="container">
    
    <h1>Cadastrar Aluno</h1>

    <!-- Formulário para criar um novo professor -->
    <form action="../alunos/alunos.php" method="POST" class="form-container">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required><br><br>

        <label for="serie">Serie:</label>
        <input type="text" name="serie" id="serie" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <button type="submit" class="btn">Cadastrar</button>
    </form>
</div>

<a href="../cadastro.php" class="back-button">
    <button class="btn">
        ←
    </button>
</a>
</body>
</html>










