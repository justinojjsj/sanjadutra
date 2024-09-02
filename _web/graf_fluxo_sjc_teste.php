<html>
  <head>

  <?php

  function hora_intensidade(){

    include_once('conexao_ccr.php'); 
    $sql = "SELECT * FROM classificados WHERE cidade='São José dos Campos' AND data_coleta='2024-08-25'";
    $result = $conn->query($sql);
  
    $cont_hr = 0; #contador
    $intensidade = []; #armazena intensidade do tráfego
    $hora_coleta = []; #Armazena as horas coletadas
    $hora_inicial = 0;
    $hora_final = 0;
    $hora_intensidade = []; #Vetor que armazera hora e intensidade ao mesmo tempo

    while($dados = mysqli_fetch_assoc($result)){
      
      if($cont_hr == 0){
        $hora_inicial = substr($dados['hora_coleta'], 0, 5); 
      }
      $cont_hr++;

      if($dados['trafego'] == 'Intenso'){
        #echo '5 - ';
        #echo $dados['hora_coleta'];
        #echo '<br>';
        $intensidade[] = 5;
        $hora_intensidade[] = array($dados['hora_coleta'] => 5);
      }elseif($dados['trafego'] == 'Lento'){
        #echo '4 - ';
        #echo $dados['hora_coleta'];
        #echo '<br>';
        $intensidade[] = 4;
        $hora_intensidade[] = array($dados['hora_coleta'] => 4);
      }
      #$hora[] = $dados['hora_coleta']; 
      $hora_coleta[] = substr($dados['hora_coleta'], 0, 5); 
      $hora_final = substr($dados['hora_coleta'], 0, 5); 
    }

    #var_dump($hora_intensidade);

    #echo 'Hora Inicial= '.$hora_inicial;
    #echo '<br>';
    #echo 'Hora Final= '.$hora_final;

    return [$hora_inicial, $hora_final, $hora_coleta, $intensidade, $hora_intensidade];
  }

  [$hora_inicial, $hora_final, $hora_coleta, $intensidade, $hora_intensidade] = hora_intensidade();
  
  #FUNÇÃO PARA GERAR HORAS DE 15 EM 15 MINUTOS, BASEADOS DA PRIMEIRA E ÚLTIMA HORA DO BD
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

  echo '<br> HORAS TOTAIS DA FUNÇÃO GERAHORAS <br> ';
  foreach($horas_totais as $ht){
    echo $ht."<br>";
  }

  echo '<br> --- <br> ';

  $horas_vagas = array_diff($horas_totais, $hora_coleta);

  echo '<br> HORAS VAGAS DIFF<br> ';
  foreach($horas_vagas as $hv){
    echo $hv."<br>";
  }

  echo '<br> --- <br> ';

  $horas_duplicadas = array_diff($hora_coleta, $horas_totais);

  echo '<br> HORAS DUPLICADAS DIFF<br> ';
  foreach($horas_duplicadas as $hd){
    echo $hd."<br>";
  }

  echo '<br> --- <br> ';

  $horas_completas = array_merge($hora_coleta, $horas_vagas);
  sort($horas_completas);

  echo '<br> HORAS COMPLETAS = HORAS COLETADAS + HORAS VAGAS<br> ';
  foreach($horas_completas as $hc){
    echo $hc."<br>";
  }

  echo '<br> --- <br> ';

  echo '<br> HORAS - INTENSIDADE JÁ COLETADAS <br> ';
  
  echo "<pre>";
  print_r($hora_intensidade);
  echo "</pre>";

  foreach($hora_intensidade as $hi){
    foreach($hi as $in){
      echo $in." ";
    }
    echo "<br>";
  }

  echo '<br> --- <br> ';
 
  #IMPRIMIR CORRETAMENTE HORA - INTENSIDADE PARA OS DADOS CAPTURADOS, E COLOCAR INTENSIDADE 0 PARA HORAS NÃO CAPTURADAS
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