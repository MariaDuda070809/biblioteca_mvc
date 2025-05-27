<!-- index.php -->
 <!-- Incluir o arquivo PHP -->
 
 <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Formulário de Cadastro</title>
</head>
<body>

    <!-- Formulário para criar um novo usuário -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Professor</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="container">
    <h1>Cadastrar Professor</h1>

    <!-- Formulário para criar um novo professor -->
    <form action="../professores/professores.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" placeholder="Digite seu Nome" required><br><br>

        <label for="cpf">CPF:</label>
        <input type="tel" name="cpf" id="cpf" maxlength="11" minlength="11" placeholder="Digite seu CPF"required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Email" required> <br><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" placeholder="Senha" required><br><br>

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
