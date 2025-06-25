<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Gráficos Biblioteca</title>
  <link rel="icon" href="../imagens/icon.jpg" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color:rgb(255, 254, 242);
      padding: 20px;
      text-align: center;
    }
    .btn-container, .btn-container-turno {
      margin-bottom: 20px;
    }
    .btn-container button,
.btn-container-turno button,
#btn-voltar {
  margin: 5px;
  padding: 10px 20px;
  font-weight: bold;
  border: none;
  border-radius: 8px;
  background-color: rgb(119, 182, 235);
  color: white;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
}

.btn-container button:hover,
.btn-container-turno button:hover,
#btn-voltar:hover {
  background-color: rgb(26, 79, 179);
  transform: scale(1.05);
}

    .grafico {
      display: none;
      max-width: 800px;
      margin: 0 auto;
    }
    .grafico canvas, .grafico table {
      width: 100%;
      max-width: 800px;
      margin: 0 auto;
    }
    .grafico canvas {
      height: 400px;
    }
    .ativo {
      display: block;
    }
    #graficoPizzaTurnos {
      max-width: 400px;
      margin: 0 auto;
    }
    table.ranking-table, table.livros-table {
      border-collapse: collapse;
      margin-top: 10px;
    }
    table.ranking-table th, table.ranking-table td,
    table.livros-table th, table.livros-table td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
    }
    table.ranking-table th, table.livros-table th {
      background-color: #f0f0f0;
    }
    .livro-ouro { color: gold; }
    .livro-prata { color: silver; }
    .livro-bronze { color: #cd7f32; }
    .livro-normal { color: black; }
    
    #btn-voltar {
  position: absolute;
  top: 20px;
  left: 20px;
  background-color: rgb(119, 182, 235);
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
  background-color: rgb(26, 79, 179);
  transform: scale(1.05);
}


  </style>
</head>
<body>
  <a href="../dashboard.php" id="btn-voltar">← Voltar</a>

  
  <h2>Gráficos da Biblioteca</h2>

  <div class="btn-container">
    <button onclick="mostrarGrafico('grafico-turno')">Empréstimos por Turno</button>
    <button onclick="mostrarGrafico('grafico-salas')"> Empréstimos por Sala</button>
    <button onclick="mostrarGrafico('grafico-ranking')"> Ranking de Alunos</button>
    <button onclick="mostrarGrafico('grafico-livros')"> Livros Mais Lidos</button>
  </div>

  <!-- Gráfico Pizza Turnos -->
  <div id="grafico-turno" class="grafico ativo">
    <canvas id="graficoPizzaTurnos"></canvas>
  </div>

  <!-- Gráfico Empréstimos por Sala -->
  <div id="grafico-salas" class="grafico">
    <div class="btn-container-turno">
      <button onclick="criarGraficoSalas('manhã')">Manhã</button>
      <button onclick="criarGraficoSalas('tarde')">Tarde</button>
      <button onclick="criarGraficoSalas('noite')">Noite</button>
    </div>
    <canvas id="graficoSalasTurnos"></canvas>
  </div>

  <!-- Ranking de alunos -->
  <div id="grafico-ranking" class="grafico">
    <canvas id="graficoRankingTurnos"></canvas>
    <table class="ranking-table" id="tabelaRankingAlunos">
      <thead>
        <tr><th>Posição</th><th>Nome</th><th>Sala</th><th>Empréstimos</th></tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <!-- Livros mais lidos -->
  <div id="grafico-livros" class="grafico">
    <h3>Livros Mais Lidos - 1º Bimestre</h3>
    <table class="livros-table" id="tabelaLivrosMaisLidos">
      <thead>
        <tr><th>Posição</th><th>Livro</th><th>Total Empréstimos</th></tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

<script>
  function mostrarGrafico(id) {
    document.querySelectorAll('.grafico').forEach(div => div.classList.remove('ativo'));
    document.getElementById(id).classList.add('ativo');
    if (id === 'grafico-ranking') carregarRankingPorTurno();
    if (id === 'grafico-livros') carregarLivrosMaisLidos();
  }

  // Gráfico Pizza Empréstimos por Turno
  async function carregarGraficoPizzaTurnos() {
    const res = await fetch('dados_pizza_turnos.php');
    const data = await res.json();
    const ctx = document.getElementById('graficoPizzaTurnos').getContext('2d');
    if (window.graficoPizzaTurnos && typeof window.graficoPizzaTurnos.destroy === 'function') {
      window.graficoPizzaTurnos.destroy();
    }
    window.graficoPizzaTurnos = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: data.map(d => d.turno),
        datasets: [{
          data: data.map(d => d.total),
          backgroundColor: ['rgba(123, 190, 245, 0.6)', 'rgba(26, 79, 179, 0.6)', 'rgba(7, 0, 112, 0.6)'],
          borderColor: ['rgba(103, 181, 245, 0.6)', 'rgba(26, 79, 179, 0.6)', 'rgba(6, 5, 109, 0.6)'],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        cutout: '30%',
        plugins: {
          legend: { position: 'bottom' },
          title: { display: true, text: 'Empréstimos por Turno - Bimestre Atual' }
        }
      }
    });
  }

  // Gráfico Empréstimos por Sala
  async function criarGraficoSalas(turno) {
    const res = await fetch(`dados_salas_por_turno.php?turno=${encodeURIComponent(turno)}`);
    const data = await res.json();
    if (!data.length) return alert(`Nenhum dado para turno ${turno}`);
    const ctx = document.getElementById('graficoSalasTurnos').getContext('2d');
    if (window.graficoSalas && typeof window.graficoSalas.destroy === 'function') {
      window.graficoSalas.destroy();
    }
    window.graficoSalas = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: data.map(d => d.salas),
        datasets: [{
          data: data.map(d => Number(d.total)),
          backgroundColor: 'rgba(2, 64, 236, 0.6)',
          borderColor: 'rgb(7, 5, 133)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: { beginAtZero: true, title: { display: true, text: 'Número de Empréstimos' } },
          x: { title: { display: true, text: 'Salas' } }
        }
      }
    });
  }

  // Ranking de alunos com tabela
  async function carregarRankingPorTurno() {
    const res = await fetch('dados_ranking_alunos.php');
    const data = await res.json();
    const turnos = ['manhã', 'tarde', 'noite'];
    const somaPorTurno = turnos.map(t => data.filter(a => a.turno === t).reduce((acc, cur) => acc + Number(cur.total), 0));
    const ctx = document.getElementById('graficoRankingTurnos').getContext('2d');
    if (window.graficoRankingTurnos && typeof window.graficoRankingTurnos.destroy === 'function') {
      window.graficoRankingTurnos.destroy();
    }
    window.graficoRankingTurnos = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: turnos.map(t => t.charAt(0).toUpperCase() + t.slice(1)),
        datasets: [{ data: somaPorTurno, backgroundColor: ['#FF6384','#36A2EB','#FFCE56'] }]
      },
      options: {
        responsive: true,
        onClick: (evt, elems) => { if (elems.length) exibirTabelaRanking(turnos[elems[0].index], data); }
      }
    });
    exibirTabelaRanking('manhã', data); // exibe padrão manhã
  }

  function exibirTabelaRanking(turno, data) {
    const tbody = document.querySelector('#tabelaRankingAlunos tbody');
    tbody.innerHTML = '';
    const rows = data.filter(a => a.turno === turno).sort((a, b) => b.total - a.total).slice(0,3);
    rows.forEach((a,i) => {
      const tr = document.createElement('tr');
      tr.innerHTML = `<td>${i+1}</td><td>${a.nome}</td><td>${a.salas}</td><td>${a.total}</td>`;
      tbody.appendChild(tr);
    });
  }

  // Tabela Livros mais lidos
  async function carregarLivrosMaisLidos() {
    const res = await fetch('dados_livro_mais_lido.php');
    const data = await res.json();
    const tbody = document.querySelector('#tabelaLivrosMaisLidos tbody');
    tbody.innerHTML = '';
    data.forEach((l, i) => {
      const tr = document.createElement('tr');
      const cls = i === 0 ? 'livro-ouro' : i === 1 ? 'livro-prata' : i === 2 ? 'livro-bronze' : 'livro-normal';
      tr.innerHTML = `<td>${i+1}</td><td class="${cls}">${l.nome_livro}</td><td>${l.total}</td>`;
      tbody.appendChild(tr);
    });
  }

  // Inicialização
  carregarGraficoPizzaTurnos();
</script>
</body>
</html>
