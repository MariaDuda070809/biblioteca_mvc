<?php
session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Professor</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 30px;
        }

        .form-container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 500px;
            margin: 0 auto;
        }

        h2 {
            margin-bottom: 20px;
        }

        ul {
            list-style: none;
            padding-left: 0;
        }

        li {
            margin-bottom: 15px;
        }

        .btn-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0d6efd;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s;
        }

        .btn-link:hover {
            background-color: #0b5ed7;
        }

        .logout {
            display: inline-block;
            margin-top: 20px;
            color: #dc3545;
            text-decoration: none;
            font-weight: bold;
        }

        .logout:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Bem-vindo, <?php echo $_SESSION['username']; ?></h2>
        <p>Este é o painel do professor. Aqui você pode acessar suas informações e recursos.</p>

        <ul>
            <li><a href="emprestimo/indexEmprestimo.php" class="btn-link">Empréstimo de Livro</a></li>
            <li><a href="cadastro.php" class="btn-link">Cadastros</a></li>
            <li><a href="livros/livro_buscar_cadastrar.php" class="btn-link">Buscar Livro</a></li>
            <li><a href="listas.php" class="btn-link">Listas Gerais</a></li>
        </ul>

        <a href="logout.php" class="logout">Sair</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>
