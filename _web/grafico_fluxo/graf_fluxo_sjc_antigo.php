<html>
  <head>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);                      

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Hora', 'Fluxo de Veículos'],
          
          <?php

          include_once('conexao_ccr.php');                                   
          $sql = "SELECT * FROM classificados WHERE cidade='São José dos Campos' AND data_coleta='2024-08-25'";
          $result = $conn->query($sql);

          $intensidade = [];
          $hora = [];

          while($dados = mysqli_fetch_assoc($result)){  
            if($dados['trafego'] == 'Intenso'){
              $intensidade[] = 5;
            }elseif($dados['trafego'] == 'Lento'){
              $intensidade[] = 4;
            }
            $hora[] = $dados['hora_coleta'];         
          }

          $chaves = array_keys($intensidade); 
          
          foreach($chaves as $i){?>          
            ['<?php echo $hora[$i];?>',<?php echo $intensidade[$i];?>],            
            <?php 
            } ?>          
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