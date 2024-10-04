<html>
  <body>

    <h1> GRÁFICO DE INTENSIDADE DE TRÁFEGO POR HORAS EM TEMPO REAL </h1>
    
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
          // Verifica se a data foi selecionada
          if (isset($_POST['datas']) and (isset($_POST['cidade']))) {
              // Captura a data selecionada
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

      $sql_cidade = "SELECT DISTINCT cidade FROM classificados_temporais;";
      $result_cidade = $conn->query($sql_cidade);
      
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="datas">Escolha uma data:</label>
        <select name="datas" id="datas">
            <?php
            if ($result->num_rows > 0) {
                // Exibe cada data como uma opção
                while($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row["data_coleta"] . '">' . $row["data_coleta"] . '</option>';
                }
            } else {
                echo '<option value="">Nenhuma data disponível</option>';
            }
            ?>
        </select>
        </br>
        <label for="datas">Escolha uma cidade:</label>
        <select name="cidade" id="cidade">
            <?php
            if ($result_cidade->num_rows > 0) {
                // Exibe cada data como uma opção
                while($row_cidade = $result_cidade->fetch_assoc()) {
                    echo '<option value="' . $row_cidade["cidade"] . '">' . $row_cidade["cidade"] . '</option>';
                }
            } else {
                echo '<option value="">Nenhuma cidade disponível</option>';
            }
            ?>
        </select>
        </br>
        <input type="submit" value="Enviar">
    </form>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);                      

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Hora', 'Fluxo de Veículos'],

          <?php

            include_once('../conexao_ccr.php'); 
            global $msg_data;
            global $msg_cidade;
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
          title: 'Cidade: <?php echo $msg_cidade  ?> - Data: <?php echo $msg_data  ?>',
          curveType: 'function',
          legend: { position: 'bottom' }

          
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>


    <div id="curve_chart" style="width: 700px; height: 500px"></div>

  </body>
</html>