<html>
  <head>

    <?php

    /*
    https://stackoverflow.com/questions/67257976/how-to-populate-google-visualization-data-table-from-mysql-database-with-php
    */

    include_once('conexao_ccr.php');                                   
    $sql = "SELECT * FROM classificados WHERE cidade='São José dos Campos' AND data_coleta='2024-08-25'";
    $result = $conn->query($sql);

    $sql2 = "SELECT * FROM classificados WHERE cidade='São José dos Campos' AND data_coleta='2024-08-25' ORDER BY id ASC LIMIT 1";
    $result2 = $conn->query($sql2);

    $primeira_hora = mysqli_fetch_assoc($result2);                                         
    echo $primeira_hora['hora_coleta'];

    while($dados = mysqli_fetch_assoc($result)){     

      if($dados['trafego'] == 'Intenso'){
        echo '5 - ';
        echo $dados['hora_coleta'];
        echo '<br>';
      }elseif($dados['trafego'] == 'Lento'){
        echo '4 - ';
        echo $dados['hora_coleta'];
        echo '<br>';
      }
    }   

    ?>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);                      

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Hora', 'Fluxo de Veículos'],



          
          ['05:00 - 06:00', 5],
          ['06:00 - 07:00', 5],
          ['07:00 - 08:00', 4],
          ['08:00 - 09:00', 3],
          ['09:00 - 10:00', 0],
          ['10:00 - 11:00', 3],
          ['11:00 - 12:00', 3]
        ]);

        var options = {
          title: 'São José dos Campos',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 700px; height: 500px"></div>
  </body>
</html>