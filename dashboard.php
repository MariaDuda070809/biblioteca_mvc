<?php
 session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Professor</title>
    <link rel="stylesheet" href="style.css">
    <!-- <img src="mvc.png" alt="imagemcury" class="img"> -->
</head>
<body>
<div class="form-container">
    <h2>Bem-vindo, <?php echo $_SESSION['username'];?></h2>
    <p>Este é o painel do professor. Aqui você pode acessar suas informações e recursos.</p>

    <ul>
        <li><a href="emprestimo/indexEmprestimo.php" class="btn-link">Emprestimo de Livro</a></li>
        <li><a href="cadastro.php" class="btn-link">Cadastros</a></li>
        <li><a href="livros/livro_buscar_cadastrar.php" class="btn-link">Buscar Livro</a></li>
        <li><a href="listas.php" class="btn-link">Listas Gerais</a></li>
    </ul>

    <a href="logout.php" class="logout">Sair</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

</body>
</html>
