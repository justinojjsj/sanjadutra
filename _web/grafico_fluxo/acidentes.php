<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>SanjaDutra Temporal</title>
    <style>
        /* Limitar a altura do gráfico */
        #curve_chart {
            width: 100%;
            height: 400px;
            display: none; /* Inicialmente escondido */
        }
    </style>
</head>
<body>

<div class="container text-center mt-5">
    <h1 class="text-primary">GRÁFICO DE ACIDENTES POR CIDADE</h1>
</div>    

<?php
include_once('../conexao_ccr.php'); 

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Inicializa a variável para a data selecionada
$dataSelecionada = $_POST['datas'] ?? '';

// Inicializa a variável de dados
$dados = [];

// Consulta para obter dados de acidentes
if ($dataSelecionada) {
    $sql_acidentes = "SELECT cidade, COUNT(*) AS quantidade_acidentes FROM classificados_temporais WHERE motivo = 'acidente' AND data_coleta = ? GROUP BY cidade";
    $stmt = $conn->prepare($sql_acidentes);
    $stmt->bind_param('s', $dataSelecionada);
    $stmt->execute();
    $result_acidentes = $stmt->get_result();

    // Prepare dados para o gráfico
    while ($linha = $result_acidentes->fetch_assoc()) {
        $dados[] = [
            'cidade' => $linha['cidade'],
            'quantidade' => intval($linha['quantidade_acidentes']),
            'cor' => sprintf('#%06X', mt_rand(0, 0xFFFFFF)) // Cor aleatória
        ];
    }
}

// Consulta para obter datas disponíveis
$sql_datas = "SELECT DISTINCT data_coleta FROM classificados_temporais ORDER BY data_coleta DESC";
$result_datas = $conn->query($sql_datas);
?>

<div class="container mt-5">
    <h2 class="text-center">Escolha uma Data</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="datas">Escolha uma data:</label>
            <select name="datas" id="datas" class="form-control" required>
                <?php if ($result_datas && $result_datas->num_rows > 0): ?>
                    <?php while ($row = $result_datas->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($row['data_coleta']); ?>" 
                            <?php echo ($dataSelecionada === $row['data_coleta']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($row['data_coleta']); ?>
                        </option>
                    <?php endwhile; ?>
                <?php else: ?>
                    <option value="">Nenhuma data disponível</option>
                <?php endif; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Enviar</button>
    </form>
</div>

<div id="curve_chart"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var dataTable = new google.visualization.DataTable();
    dataTable.addColumn('string', 'Cidade');
    dataTable.addColumn('number', 'Quantidade de Acidentes');
    dataTable.addColumn({ role: 'style' });

    // Adiciona dados do PHP ao gráfico
    var dados = <?php echo json_encode($dados); ?>; 
    dados.forEach(row => {
        dataTable.addRow([row.cidade, row.quantidade, `color: ${row.cor}`]);
    });

    var options = {
        hAxis: {
            title: 'CIDADE',
            gridlines: { count: 0 }
        },
        vAxis: {
            title: 'QUANTIDADE DE ACIDENTES',
            gridlines: { count: 0 },
            format: '0'
        },
        chartArea: { 
            left: 50, 
            top: 50, 
            width: '100%', 
            height: '70%'
        },
        bar: { groupWidth: '50%' },
        legend: { position: 'none' }
    };

    // Verifica se há dados para desenhar o gráfico
    if (dados.length > 0) {
        document.getElementById('curve_chart').style.display = 'block'; // Mostra o gráfico
        var chart = new google.visualization.ColumnChart(document.getElementById('curve_chart'));
        chart.draw(dataTable, options);
    } else {
        document.getElementById('curve_chart').style.display = 'none'; // Esconde o gráfico se não houver dados
    }
}

// Executa o desenho do gráfico se houver dados após o envio
if (<?php echo json_encode($dados); ?>.length > 0) {
    drawChart();
}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
