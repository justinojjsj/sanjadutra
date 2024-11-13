<?php
include_once('../conexao_ccr.php');

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Inicializa as variáveis para as datas selecionadas
$dataInicial = $_POST['data_inicial'] ?? '';
$dataFinal = $_POST['data_final'] ?? '';

// Inicializa a variável de dados
$dados = [];
$semAcidentes = false; // Variável para controlar a exibição da mensagem

// Consulta para obter datas disponíveis
$sql_datas = "SELECT DISTINCT data_coleta FROM classificados_temporais ORDER BY data_coleta DESC";
$result_datas = $conn->query($sql_datas);

// Armazena as datas em um array para reutilizar
$datasDisponiveis = [];
if ($result_datas && $result_datas->num_rows > 0) {
    while ($row = $result_datas->fetch_assoc()) {
        $datasDisponiveis[] = $row['data_coleta'];
    }
}

// Só faz a consulta e exibe o gráfico após o envio do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $dataInicial && $dataFinal) {
    // Consulta para obter os acidentes dentro do intervalo de datas
    $sql_acidentes = "
        SELECT id, cidade, motivo
        FROM classificados_temporais
        WHERE motivo = 'acidente' AND data_coleta BETWEEN ? AND ? 
        ORDER BY cidade, id
    ";

    // Prepara a consulta
    $stmt = $conn->prepare($sql_acidentes);
    $stmt->bind_param('ss', $dataInicial, $dataFinal);
    $stmt->execute();
    $result_acidentes = $stmt->get_result();

    // Variáveis para contagem de acidentes consecutivos
    $cidadeAcidentes = [];
    $ultimoIdPorCidade = []; // Armazena o último ID para cada cidade
    $contagemAcidentes = []; // Armazena a contagem de acidentes por cidade

    // Loop pelos dados retornados
    while ($linha = $result_acidentes->fetch_assoc()) {
        $cidade = $linha['cidade'];
        $motivo = $linha['motivo'];
        $id = $linha['id'];

        // Se a cidade ainda não foi iniciada, inicializa as variáveis
        if (!isset($ultimoIdPorCidade[$cidade])) {
            $ultimoIdPorCidade[$cidade] = null;
            $contagemAcidentes[$cidade] = 0;
        }

        // Verifica se o ID é consecutivo e o motivo é acidente para cada cidade
        if ($motivo === 'acidente') {
            // Verifica se o ID atual não é consecutivo ao último ID da cidade
            if ($ultimoIdPorCidade[$cidade] === null || $id != $ultimoIdPorCidade[$cidade] + 1) {
                // Caso não seja consecutivo, conta como um novo acidente
                $contagemAcidentes[$cidade]++;
            }
        }

        // Atualiza o último ID para a cidade
        $ultimoIdPorCidade[$cidade] = $id;
    }

    // Se não houver acidentes, define a variável para mostrar a mensagem
    if (empty($contagemAcidentes)) {
        $semAcidentes = true;
    } else {
        // Prepara os dados para o gráfico com a soma total dos acidentes por cidade
        foreach ($contagemAcidentes as $cidade => $quantidade) {
            $dados[] = [
                'cidade' => $cidade,
                'quantidade' => $quantidade,
                'cor' => sprintf('#%06X', mt_rand(0, 0xFFFFFF)) // Cor aleatória
            ];
        }
    }
}
?>

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

<div class="container mt-5">
    <h2 class="text-center">Escolha um Período</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="data_inicial">Data Inicial:</label>
            <select name="data_inicial" id="data_inicial" class="form-control" required>
                <?php if (!empty($datasDisponiveis)): ?>
                    <?php foreach ($datasDisponiveis as $data): ?>
                        <option value="<?php echo htmlspecialchars($data); ?>" 
                            <?php echo ($dataInicial === $data) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($data); ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">Nenhuma data disponível</option>
                <?php endif; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="data_final">Data Final:</label>
            <select name="data_final" id="data_final" class="form-control" required>
                <?php if (!empty($datasDisponiveis)): ?>
                    <?php foreach ($datasDisponiveis as $data): ?>
                        <option value="<?php echo htmlspecialchars($data); ?>" 
                            <?php echo ($dataFinal === $data) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($data); ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">Nenhuma data disponível</option>
                <?php endif; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Enviar</button>
    </form>
</div>

<?php if ($semAcidentes): ?>
    <div style="text-align: center; color: #006400; font-weight: bold; font-size: 1.5rem; margin: 20px auto;">
    Não houve acidentes no período selecionado.
</div>

<?php endif; ?>

<div id="curve_chart" style="display: <?php echo (count($dados) > 0 && $_SERVER['REQUEST_METHOD'] === 'POST') ? 'block' : 'none'; ?>;"></div>

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
            left: 80, 
            top: 50, 
            width: '90%', 
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
        document.getElementById('curve_chart').style.display = 'none'; // Esconde o gráfico
    }
}
</script>

</body>
</html>
