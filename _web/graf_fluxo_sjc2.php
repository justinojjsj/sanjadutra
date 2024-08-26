<html>
  <head>

    <?php

    /*
    https://stackoverflow.com/questions/67257976/how-to-populate-google-visualization-data-table-from-mysql-database-with-php
    */



    // $sql2 = "SELECT * FROM classificados WHERE cidade='São José dos Campos' AND data_coleta='2024-08-25' ORDER BY id ASC LIMIT 1";
    // $result2 = $conn->query($sql2);

    // $primeira_hora = mysqli_fetch_assoc($result2);                                         
    // echo $primeira_hora['hora_coleta'];

    // include_once('conexao_ccr.php');                                   
    // $sql = "SELECT * FROM classificados WHERE cidade='São José dos Campos' AND data_coleta='2024-08-25'";
    // $result = $conn->query($sql);

    // $intensidade = [];
    // $hora = [];

    // while($dados = mysqli_fetch_assoc($result)){  
    //   if($dados['trafego'] == 'Intenso'){
    //     #echo '5 - ';
    //     #echo $dados['hora_coleta'];
    //     #echo '<br>';
    //     $intensidade[] = 5;
    //   }elseif($dados['trafego'] == 'Lento'){
    //     #echo '4 - ';
    //     #echo $dados['hora_coleta'];
    //     #echo '<br>';
    //     $intensidade[] = 4;
    //   }
    //   $hora[] = $dados['hora_coleta'];         
    // }

    // $chaves = array_keys($intensidade);  

    // foreach($chaves as $i){
    //   echo $hora[$i].' - '.$intensidade[$i];
    //   echo "<br>";
    // }
    // ?>



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
              #echo '5 - ';
              #echo $dados['hora_coleta'];
              #echo '<br>';
              $intensidade[] = 5;
            }elseif($dados['trafego'] == 'Lento'){
              #echo '4 - ';
              #echo $dados['hora_coleta'];
              #echo '<br>';
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