<?php
include '../db.php';
session_start();

$mensagemSucesso = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $aluno_id = $_POST['aluno_id'];
    $livro_id = $_POST['livro_id'];
    $data_retirada = $_POST['data_retirada'];
    $data_devolucao = $_POST['data_devolucao'];
    $professor_id = $_SESSION['id'];
    $hoje = date('Y-m-d');

    if ($data_retirada !== $hoje) {
        echo "<script>alert('Erro: A data de retirada deve ser o dia de hoje.');</script>";
    } elseif ($data_devolucao < $hoje) {
        echo "<script>alert('Erro: A data de devolução não pode ser anterior a hoje.');</script>";
    } else {
        $sql = "INSERT INTO emprestimos (aluno_id, livro_id, data_retirada, data_devolucao, professor_id, status) 
        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$aluno_id, $livro_id, $data_retirada, $data_devolucao, $professor_id, 0])) {
            $mensagemSucesso = "Empréstimo registrado com sucesso!";
        } else {
            echo "<script>alert('Erro ao registrar o empréstimo.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Empréstimo de Livro</title>
    <link rel="icon" href="../imagens/.jpg" type="image/gif" sizes="18x18">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        body {
            background-image: url('../imagens/emprestimo.jpg');
            background-size: cover;
            background-position: center;
            font-family: 'Merriweather', serif;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.60);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 50px auto;
        }

        .container h2 {
            color: #000;
            margin-bottom: 30px;
            font-weight: 700;
            text-align: center;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .form-control,
        .form-select,
        input[type="date"] {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px 210px;
            font-size: 14px;
            background-color: #fff;
            height: 45px;
            box-sizing: border-box;
        }

        .form-control:focus,
        .form-select:focus,
        input[type="date"]:focus {
            border-color: rgb(247, 71, 203);
            box-shadow: 0 0 5px rgba(180, 5, 122, 0.5);
            outline: none;
        }

        .btn-gradient {
            background: linear-gradient(to bottom, rgb(247, 71, 203), rgb(180, 5, 122, 0.5));
            border: none;
            padding: 10px 20px;
            color: rgb(0, 0, 0);
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: transform 0.2s ease-in-out, background 0.3s;
            margin: 20px 0;
        }

        .btn-gradient:hover {
            transform: scale(1.10);
            color: black;
        }

        #btn-voltar {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: rgb(212, 6, 126);
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
            background-color: rgb(129, 0, 86);
            transform: scale(1.05);
        }

        .select2-container--default .select2-selection--single {
            height: 45px !important;
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 6px 12px;
            font-size: 14px;
            background-color: #fff;
            display: flex;
            align-items: center;
            box-sizing: border-box;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #555;
            font-size: 20px;
            font-weight: 500;
        }

        .select2-container {
            width: 100% !important;
        }

        .mensagem-popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #d4edda;
            color: #155724;
            padding: 20px 30px;
            border: 2px solid #c3e6cb;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            z-index: 9999;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            animation: fadeInOut 3s ease-in-out;
        }

        @keyframes fadeInOut {
            0% { opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { opacity: 0; }
        }
    </style>
</head>
<body>

<a href="../dashboard.php" id="btn-voltar">← Voltar</a>

<div class="container">
    <h2 class="text-center">Ficha de Controle Empréstimo de Livro Sala de Leitura</h2>
    <form action="indexEmprestimo.php" method="POST">
        <div class="mb-3">
            <label for="aluno_id" class="form-label">Aluno:</label>
            <select name="aluno_id" id="aluno_id" class="form-select" required></select>
        </div>

        <div class="mb-3">
            <label for="livro_id" class="form-label">Livro:</label>
            <select name="livro_id" id="livro_id" class="form-select" required></select>
        </div>

        <div class="mb-3">
            <label for="data_retirada" class="form-label">Data de Retirada:</label>
            <input type="date" id="data_retirada" name="data_retirada" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>" required>
        </div>

        <div class="mb-3">
            <label for="data_devolucao" class="form-label">Data de Devolução:</label>
            <input type="date" id="data_devolucao" name="data_devolucao" min="<?= date('Y-m-d') ?>" required>
        </div>

        <button type="submit" class="btn btn-gradient">Registrar Empréstimo</button>
    </form>
</div>

<!-- Mensagem de sucesso -->
<?php if (!empty($mensagemSucesso)): ?>
    <div id="mensagem-sucesso" class="mensagem-popup"><?= $mensagemSucesso ?></div>
    <script>
        setTimeout(() => {
            const msg = document.getElementById('mensagem-sucesso');
            if (msg) msg.style.display = 'none';
        }, 3000);
    </script>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function () {
    function initSelect2(selector, url, placeholderText) {
        $(selector).select2({
            placeholder: placeholderText,
            ajax: {
                url: url,
                dataType: 'json',
                delay: 250,
                data: params => ({ term: params.term }),
                processResults: data => ({
                    results: data.map(item => ({ id: item.id, text: item.text }))
                }),
                cache: true
            },
            minimumInputLength: 1,
            language: {
                inputTooShort: () => "Digite pelo menos 1 caractere",
                noResults: () => "Nenhum resultado encontrado"
            }
        }).val(null).trigger("change");
    }

    initSelect2('#aluno_id', 'buscar_alunos.php', 'Digite o nome do aluno');
    initSelect2('#livro_id', 'buscar_livros.php', 'Digite o nome do livro');
});
</script>
</body>
</html>
