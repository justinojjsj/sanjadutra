<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>SANJADUTRA</title>
    <style>
        /* Limitar a altura do gráfico */
        #curve_chart {
            width: 100%;
            height: 400px; /* Altura fixa para o gráfico */
            overflow: auto; /* Permite rolagem se necessário */
        }
    </style>
</head>
<body>

<div class="container text-center mt-5">
    <h1 class="text-primary">GRÁFICO DE TRÁFEGO TEMPORAL</h1>
    <h2 class="text-muted">SÃO JOSÉ DOS CAMPOS</h2>
</div>    

<?php
    include_once('../conexao_ccr.php'); 

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Inicializa variável para armazenar a mensagem
    $msg_data = "";
    $msg_cidade = "";

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Captura a data e cidade selecionadas
        if (isset($_POST['datas']) && isset($_POST['cidade'])) {
            $dataSelecionada = $_POST['datas'];
            $cidadeSelecionada = $_POST['cidade'];
            $msg_data = htmlspecialchars($dataSelecionada);
            $msg_cidade = htmlspecialchars($cidadeSelecionada);
        } else {
            $msg_data = "Nenhuma data foi selecionada.";
            $msg_cidade = "Nenhuma cidade foi selecionada.";
        }
    }

    // Consulta ao banco de dados
    $sql = "SELECT DISTINCT data_coleta FROM classificados_temporais;";
    $result = $conn->query($sql);
    
    $sql_cidade = "SELECT DISTINCT cidade FROM classificados_temporais WHERE cidade LIKE 'São José%'";
    $result_cidade = $conn->query($sql_cidade);
?>

<div class="container mt-5">
    <h2 class="text-center">Escolha uma Data e uma Cidade</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="datas">Escolha uma data:</label>
            <select name="datas" id="datas" class="form-control">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<option value="' . htmlspecialchars($row["data_coleta"]) . '">' . htmlspecialchars($row["data_coleta"]) . '</option>';
                    }
                } else {
                    echo '<option value="">Nenhuma data disponível</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="cidade">Escolha uma cidade:</label>
            <select name="cidade" id="cidade" class="form-control">
                <?php
                if ($result_cidade->num_rows > 0) {
                    while($row_cidade = $result_cidade->fetch_assoc()) {
                        echo '<option value="' . htmlspecialchars($row_cidade["cidade"]) . '">' . htmlspecialchars($row_cidade["cidade"]) . '</option>';
                    }
                } else {
                    echo '<option value="">Nenhuma cidade disponível</option>';
                }
                ?>
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
        var data = google.visualization.arrayToDataTable([
            ['Hora', 'Fluxo de Veículos'],
            <?php
                include_once('../conexao_ccr.php'); 
                $sql = "SELECT * FROM classificados_temporais WHERE cidade='$msg_cidade' AND data_coleta='$msg_data'";
                $result = $conn->query($sql);          

                while($dados = mysqli_fetch_assoc($result)){
            ?>
                ['<?php echo $dados['hora_coleta'];?>', <?php echo $dados['trafego'];?>],
            <?php  
                }
            ?>
        ]);

        var options = {
            width: '100%', // Ajuste dinâmico
            height: '100%', // Ajuste dinâmico
            vAxis: {
                title: 'Cidade: <?php echo $msg_cidade  ?> - Data: <?php echo $msg_data  ?>',
                curveType: 'function',
                legend: { position: 'bottom' },
                ticks: [
                    { v: 0, f: "Contínuo" },
                    { v: 1, f: "Normal" },
                    { v: 2, f: "Acesso" },
                    { v: 3, f: "Lento" },
                    { v: 4, f: "Intenso" },
                    { v: 5, f: "Congestionado" },
                    { v: 6, f: "Interditado" }
                ]
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        chart.draw(data, options);
    }
    
    window.addEventListener('resize', drawChart);
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>