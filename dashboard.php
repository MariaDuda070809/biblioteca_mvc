<?php
session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Professor</title>
    <link rel="icon" href="./imagens/icon.jpg" type="image/gif" sizes="16x16">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <style>
    html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}

body {
    background-image: url('imagens/dashboard.webp'); /* ou 'imagens/dashboard.jpg' */
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
}

    .form-container {
    background: rgba(255, 255, 255, 0.6); 
    backdrop-filter: blur(6px);          
    -webkit-backdrop-filter: blur(6px);   
    border-radius: 22px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    padding: 50px;
    max-width: 400px;
    width: 100%;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
}
        body {
            font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;
            padding: 40px;
        }


        h2 {
            margin-bottom: 20px;
        }
    ul {
        list-style: none;
        padding-left: 0;
        display: flex;
        flex-direction: column;
        align-items: center; 
        gap: 20px;
        position: relative;
    }

    /* Dedo acima dos botões */
    ul::before {
        display: block;
        font-size: 30px;
        text-align: center;
        margin-bottom: 10px;
        width: 100%;
        position: absolute;
        top: -40px;
        left: 0;
    }

    li {
        margin-bottom: 0; /* removi para usar gap no ul */
    }

    .btn-link {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 14px 0;
        /* background-color: #0d6efd; */
        color: #fff;
        text-decoration: none;
        border-radius: 12px;
        transition: background-color 0.3s;
        text-align: center;
        width: 280px; /* tamanho fixo */
        box-sizing: border-box;
        font-weight: 600;
        user-select: none;
    }


    ul li:nth-child(1) .btn-link {
            background: linear-gradient(to bottom, #FF00BC, #E60000);
        }

        ul li:nth-child(2) .btn-link {
            background: linear-gradient(to bottom, #FF7700, #EFD007);
        }

        ul li:nth-child(3) .btn-link {
            background: linear-gradient(to bottom, #4FC94B, #00DEFF);
        }

        ul li:nth-child(4) .btn-link {
            background: linear-gradient(to bottom, #1041E1, #9A00FF);
        }
        ul li .btn-link {
    color: white; 
    text-decoration: none; 
    transition: transform 0.2s ease-in-out;
}

ul li .btn-link:hover {
    transform: scale(1.25);
    color: white;
}

    .logout {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px 0;
        background-color: #D70000;
        color: #fff;
        text-decoration: none;
        border-radius: 12px;
        transition: transform 0.2s ease-in-out;
        text-align: center;
        width: 100px; /* tamanho fixo */
        box-sizing: border-box;
        font-weight: 500;
        user-select: none;
        
    }

    .logout:hover {
        transform: scale(1.15);
        color: white;
        text-decoration: none;
        
    }
</style>

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
