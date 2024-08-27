<html>
  <head>

  <?php
  include_once('conexao_ccr.php'); 

  $sql = "SELECT * FROM classificados WHERE cidade='São José dos Campos' AND data_coleta='2024-08-25'";
  $result = $conn->query($sql);

  $intensidade = [];
  $hora = [];
  $hora2 = [];

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

  foreach($chaves as $i){

    $format = $hora[$i];
    $hora_format[] = substr($format, 0, 5);
    echo $hora_format[$i].' - '.$intensidade[$i];
    echo "<br>";

    if($i == 1){
      $hora_inicial = $hora_format[$i];
    }
    $hora_final = $hora_format[$i];
  }
  echo '<br>';
  echo '<br>';
  echo 'Hora Inicial= '.$hora_inicial;
  echo '<br>';
  echo 'Hora Final= '.$hora_final;


  function generateExpectedTimes($start, $end) {
    $times = [];
    $current = strtotime($start);
    $end = strtotime($end);

    while ($current <= $end) {
        $times[] = date('H:i', $current);
        $current = strtotime('+15 minutes', $current);
    }

    return $times;
}

// Função para verificar se todos os horários foram capturados
function checkTimes($start, $end, $actualTimes) {
    $expectedTimes = generateExpectedTimes($start, $end);
    $missingTimes = array_diff($expectedTimes, $actualTimes);
    $extraTimes = array_diff($actualTimes, $expectedTimes);

    if (empty($missingTimes) && empty($extraTimes)) {
        return "Todos os horários foram capturados corretamente.";
    } else {
        $result = array(
          'missing' => array_values($missingTimes),
          'extra' => array_values($extraTimes)
      );
        return $result;
    }
}
#echo '<br>';
$result = checkTimes($hora_inicial, $hora_final, $hora_format);
#var_dump($result);
#echo "Horários ausentes: " . implode(', ', $result['missing']) . "\n";
#echo "Horários extras: " . implode(', ', $result['extra']) . "\n";

echo '<br>';
echo '<br>';
print_r($result);




  ?>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);                      

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Hora', 'Fluxo de Veículos'],
          ['<?php echo "teste";?>', <?php echo "9";?>],
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