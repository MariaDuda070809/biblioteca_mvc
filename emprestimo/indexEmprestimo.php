<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $aluno_id = $_POST['aluno_id'];
    $livro_id = $_POST['livro_id'];
    $data_retirada = $_POST['data_retirada'];
    $data_devolucao = $_POST['data_devolucao'];
    $professor_id = $_SESSION['id'];

    // Verifica se a data de devolução é maior ou igual à data de retirada
    if (strtotime($data_devolucao) < strtotime($data_retirada)) {
        echo "<script>alert('Erro: A data de devolução não pode ser anterior à data de retirada.');</script>";
    } else {
        $sql = "INSERT INTO emprestimos (aluno_id, livro_id, data_retirada, data_devolucao, professor_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$aluno_id, $livro_id, $data_retirada, $data_devolucao,$professor_id])) {
            echo "<script>alert('Empréstimo registrado com sucesso!');</script>";
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
    <title>Emprestimo de Livro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<!-- <h1>Ficha de Controle Empréstimo de Livro Sala de Leitura</h1> -->
<div class="container">
    <h2 class="text-center">Ficha de Controle Empréstimo de Livro Sala de Leitura</h2>
    <form action="../emprestimo/indexEmprestimo.php" method="POST" class="form-container">
        <!-- Campo Aluno -->
        <div class="mb-3">
            <label for="aluno_id" class="form-label">Aluno:</label>
            <select name="aluno_id" id="aluno_id" class="form-select" required></select>
        </div>

        <!-- Campo Livro -->
        <div class="mb-3">
            <label for="livro_id" class="form-label">Livro:</label>
            <select name="livro_id" id="livro_id" class="form-select" required></select>
        </div>

        <!-- Datas -->
        <div class="mb-3">
            <label for="data_emprestimo" class="form-label">Data de Empréstimo:</label>
            <input type="date" name="data_retirada" id="data_emprestimo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="data_devolucao" class="form-label">Data de Devolução:</label>
            <input type="date" name="data_devolucao" id="data_devolucao" class="form-control" required>
        </div>

        <!-- Botão -->
        <button type="submit" class="btn btn-gradient w-100">Registrar Empréstimo</button>
    </form>
</div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function () {
    function initSelect2(selector, url, placeholderText) {
        $(selector).select2({
            placeholder: placeholderText,
            allowClear: false,  // Desabilitar o "x" para limpar a seleção
            ajax: {
                url: url,
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        term: params.term // texto digitado
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(function (item) {
                            return {
                                id: item.id,    // id do aluno ou livro
                                text: item.text  // o nome do aluno ou livro que deve aparecer no select
                            };
                        })
                    };
                },
                cache: true
            },
            minimumInputLength: 1,
            language: {
                inputTooShort: function () {
                    return "Digite pelo menos 1 caractere";
                },
                noResults: function () {
                    return "Nenhum resultado encontrado";
                }
            }
        }).val(null).trigger("change");  // Garantir que o valor do select seja vazio ao iniciar
    }

    initSelect2('#aluno_id', 'buscar_alunos.php', 'Digite o nome do aluno');
    initSelect2('#livro_id', 'buscar_livros.php', 'Digite o nome do livro');
});
</script>

</body>
</html>

<a href="../dashboard.php" class="back-button">
    <button class="btn">
        ←
    </button>
</a>
