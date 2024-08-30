<html>
  <head>

  <?php
  include_once('conexao_ccr.php'); 

  $sql = "SELECT * FROM classificados WHERE cidade='São José dos Campos' AND data_coleta='2024-08-25'";
  $result = $conn->query($sql);

  $intensidade = [];
  $hora = [];
  $hora2 = [];

  $hora_intensidade = [];

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
    #$hora[] = $dados['hora_coleta']; 
    $hora[] = substr($dados['hora_coleta'], 0, 5); 
    $hora_intensidade[] = array($dados['hora_coleta'] => $intensidade);
  }

  var_dump($hora_intensidade);

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
 #echo 'Hora Inicial= '.$hora_inicial;
 # echo '<br>';
  #echo 'Hora Final= '.$hora_final;

  function geraHoras($inicial, $final){
    $horas = [];
    $momento = strtotime($inicial);
    $final = strtotime($final);
    #echo '<br> Função StrToTime Hora Final= '.$final;

    while($momento <= $final){
      $horas[] = date('H:i', $momento);
      $momento = strtotime('+15 minutes', $momento);
    }
    #print_r($horas);
    #echo '<br>';
    return $horas;
  }

  $horas_totais = geraHoras($hora_inicial, $hora_final);
  #echo '<br>';
  #print_r($hora_format);

  $horas_vagas = array_diff($horas_totais, $hora_format);
  echo '<br> HORAS VAGAS <br> ';
  print_r($horas_vagas);
  echo '<br> --- <br> ';

  $horas_completas = array_merge($hora_format, $horas_vagas);
 
  echo '<br> HORAS TOTAIS <br> ';
  sort($horas_completas);
  print_r($horas_completas);
  echo '<br> --- <br> ';

  $k = 0;
  while(strtotime($horas_completas[$k]) != strtotime($hora_final)){
    
    if ($horas_completas[$k] == $hora_intensidade[$k]){
      echo 'oi';
    }
    
    echo $horas_completas[$k];
    echo '<br>';
    $k = $k+1;
  }




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