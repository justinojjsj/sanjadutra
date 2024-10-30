<?php
    include_once('../conexao_ccr.php'); 

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Inicializa variável para armazenar a mensagem
    $msg_data = "";
    $msg_cidade = "";

    // Consulta ao banco de dados
    $sql_consulta_data = "SELECT DISTINCT data_coleta FROM classificados_temporais;";
    $resultado_consulta_data = $conn->query($sql_consulta_data);
    
    $sql_consulta_cidade = "SELECT DISTINCT cidade FROM classificados_temporais WHERE cidade LIKE 'São José%'";
    $resultado_consulta_cidade = $conn->query($sql_consulta_cidade);

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['data']) && isset($_POST['cidade'])) {
            $dataSelecionada = $_POST['data'];
            $cidadeSelecionada = $_POST['cidade'];
            $msg_data = htmlspecialchars($dataSelecionada);
            $msg_cidade = htmlspecialchars($cidadeSelecionada);

            //echo $msg_cidade;
            //echo $msg_data;
        }
    }

    // Consulta o banco com as informações pretendidas
    $sql_consulta_data_selecionada = "SELECT * FROM classificados_temporais WHERE data_coleta='$msg_data' ORDER BY hora_coleta ASC;";
    $resultado_consulta_data_selecionada = $conn->query($sql_consulta_data_selecionada);

    $hora_capturada = array();
    $trafego = array();
    $contador = 0;
 
    if ($resultado_consulta_data_selecionada->num_rows > 0) {
        // Loop através dos resultados
        while ($linha = $resultado_consulta_data_selecionada->fetch_assoc()) {            
            $hora_capturada[$contador] = $linha['hora_coleta'];
            $trafego[$contador] = $linha['trafego'];
            $contador++;          
        }

        //echo "<h2>Dados Capturados</h2>";
        for ($i = 0; $i < $contador; $i++) {
            //echo "Hora Capturada: " . htmlspecialchars($hora_capturada[$i]) . "<br>";
            //echo "Tráfego: " . htmlspecialchars($trafego[$i]) . "<br>";
            //echo "<hr>"; // Separador entre os registros
        }
    } else {
        echo "Nenhum resultado encontrado.";
    }

?>

<html lang="pt-BR">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>SanjaDutra Tempo Real</title>
    <style>
        /* Estilo adicional para o gráfico */
        #curve_chart {
            width: 100%;
            height: 400px; /* Altura fixa do gráfico */
            margin-top: 20px; /* Espaço acima do gráfico */
        }
        body {
            overflow-x: hidden; /* Evitar rolagem horizontal */
        }
    </style>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Hora', '<?php echo $msg_cidade ?>'],

          <?php
            $k = $i;
            for($i = 0; $i < $k; $i++){
          ?>
                ['<?php echo $hora_capturada[$i]; ?>',<?php echo $trafego[$i]; ?>],
                
          <?php
            }
          ?>
        ]);

        var options = {
            width: '100%', 
            height: '100%', 
            title: 'Cidade: São José dos Campos - Data: <?php echo '$hoje';?> - Última captura: <?php echo '$ultimoQuarto'; ?>',
            curveType: 'function',
            legend: { position: 'bottom' },
            ticks: [
                { v: 0, f: "Contínuo" },
                { v: 1, f: "Normal" },
                { v: 2, f: "Acesso" },
                { v: 3, f: "Lento" },
                { v: 4, f: "Intenso" },
                { v: 5, f: "Congestionado" },
                { v: 6, f: "Interditado" },
                { v: 7, f: "Bloqueado" }
            ]
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        chart.draw(data, options);
      }
      window.addEventListener('resize', drawChart);

    </script>
  </head>


  <body>

    <div class="container text-center mt-5">
        <h1 class="text-primary">HISTÓRICO DE TRÁFEGO</h1>
        <h2 class="text-muted">CIDADES</h2>
    </div>    

    <div class="container mt-5">
        <h2 class="text-center">Escolha uma Data e uma Cidade</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="data">Escolha uma data:</label>
                <select name="data" id="data" class="form-control">
                    <?php
                    if ($resultado_consulta_data->num_rows > 0) {
                        while($row = $resultado_consulta_data->fetch_assoc()) {
                            $selected = ($msg_data === htmlspecialchars($row["data_coleta"])) ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($row["data_coleta"]) . '" ' . $selected . '>' . htmlspecialchars($row["data_coleta"]) . '</option>';
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
                    if ($resultado_consulta_cidade->num_rows > 0) {
                        while($row_cidade = $resultado_consulta_cidade->fetch_assoc()) {
                            $selected = ($msg_cidade === htmlspecialchars($row_cidade["cidade"])) ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($row_cidade["cidade"]) . '" ' . $selected . '>' . htmlspecialchars($row_cidade["cidade"]) . '</option>';
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


    <div id="curve_chart" style="width: 900px; height: 500px"></div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>