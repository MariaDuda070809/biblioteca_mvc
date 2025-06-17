<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Empréstimos por Turno</title>
    <link rel="icon" href="../imagens/icon.jpg" type="image/gif" sizes="16x16" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <a href="../listas.php" class="back-button">
    <button class="btn">🡸</button>
  </a>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 20px;
        color: #333;
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #1a73e8;
    }

    #graficoTurno {
        display: block;
        margin: 0 auto 30px auto;
        max-width: 600px;
        background-color: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    #salas, #alunos {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 0 8px rgba(0,0,0,0.08);
    }

    h3, h4 {
        color: #333;
        margin-top: 0;
    }

    ul, ol {
        padding-left: 20px;
    }

    li {
        margin-bottom: 8px;
    }

    a {
        color: #1a73e8;
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

</head>
<body>
    <h2>Empréstimos por Turno</h2>
    <canvas id="graficoTurno" width="400" height="200"></canvas>

    <div id="salas"></div>
    <div id="alunos"></div>

    <script>
    function carregarGrafico() {
        fetch('dados_turnos.php')
            .then(res => res.json())
            .then(data => {
                if (!data || data.length === 0) {
                    document.getElementById('graficoTurno').outerHTML = "<p>Nenhum dado de empréstimo por turno disponível.</p>";
                    return;
                }

                const ctx = document.getElementById('graficoTurno').getContext('2d');
                const labels = data.map(d => d.turno);
                const values = data.map(d => d.total);

                const chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total de Empréstimos',
                            data: values,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)'
                        }]
                    },
                    options: {
                        onClick: (e, elements) => {
                            if (elements.length > 0) {
                                const turno = chart.data.labels[elements[0].index];
                                carregarSalas(turno);
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Erro ao carregar dados dos turnos:', error);
                document.getElementById('graficoTurno').outerHTML = "<p>Erro ao carregar os dados.</p>";
            });
    }

    function carregarSalas(turno) {
        fetch('dados_salas.php?turno=' + encodeURIComponent(turno))
            .then(res => res.json())
            .then(data => {
                let html = `<h3>Salas do turno ${turno}</h3><ul>`;
                data.forEach(s => {
                    html += `<li><a href="#" onclick="carregarAlunos('${turno}', '${s.salas}')">${s.salas}</a> - ${s.total} empréstimos</li>`;
                });
                html += '</ul>';
                document.getElementById('salas').innerHTML = html;
                document.getElementById('alunos').innerHTML = '';
            })
            .catch(error => {
                console.error('Erro ao carregar salas:', error);
                document.getElementById('salas').innerHTML = '<p>Erro ao carregar salas.</p>';
            });
    }

    function carregarAlunos(turno, salas) {
        fetch(`dados_alunos.php?turno=${encodeURIComponent(turno)}&salas=${encodeURIComponent(salas)}`)
            .then(res => res.json())
            .then(data => {
                let html = `<h4>Alunos da sala ${salas} (${turno})</h4><ol>`;
                data.forEach(a => {
                    html += `<li>${a.nome} - ${a.total} empréstimos</li>`;
                });
                html += '</ol>';
                document.getElementById('alunos').innerHTML = html;
            })
            .catch(error => {
                console.error('Erro ao carregar alunos:', error);
                document.getElementById('alunos').innerHTML = '<p>Erro ao carregar alunos.</p>';
            });
    }

    carregarGrafico();
</script>
