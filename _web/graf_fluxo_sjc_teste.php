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

            function hora_intensidade(){

              include_once('conexao_ccr.php'); 
              $sql = "SELECT * FROM classificados WHERE cidade='São José dos Campos' AND data_coleta='2024-09-02'";
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
                  $hora_intensidade[] = array(substr($dados['hora_coleta'], 0, 5) => 5);
                }elseif($dados['trafego'] == 'Lento'){
                  #echo '4 - ';
                  #echo $dados['hora_coleta'];
                  #echo '<br>';
                  $intensidade[] = 4;
                  $hora_intensidade[] = array(substr($dados['hora_coleta'], 0, 5) => 4);
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

            $horas_vagas = array_diff($horas_totais, $hora_coleta);

            #echo '<br> HORAS VAGAS DIFF<br> ';
            foreach($horas_vagas as $hv){
              #echo $hv."<br>";
              $hora_intensidade[] = [$hv => 0]; #Adicionando zeros nas horas vagas
            }


            #echo '<br> HORAS - INTENSIDADE JÁ COLETADAS <br> ';

            // Função de comparação para ordenar horários
            function compararHorarios($a, $b) {
              // Obtendo as chaves dos arrays associativos
              $chaveA = key($a);
              $chaveB = key($b);

              // Comparando as chaves
              return strcmp($chaveA, $chaveB);
            }

            // Ordenando o array pelas chaves (horários)
            uasort($hora_intensidade, 'compararHorarios');

            $hora_intensidade = array_values($hora_intensidade);

            #echo "<pre>";
            #print_r($hora_intensidade);
            #echo "</pre>";

            #echo '<br> --- <br> ';

            #IMPRIMIR CORRETAMENTE HORA - INTENSIDADE PARA OS DADOS CAPTURADOS, E COLOCAR INTENSIDADE 0 PARA HORAS NÃO CAPTURADAS

            #echo '<br> HORAS - INTENSIDADE COMPLETAS <br> ';

            // $chave = key($hora_intensidade[0]);
            // $valor = ($hora_intensidade[0][$chave]);
            // echo $chave." - ".$valor;

            $k = 0;
            while(key($hora_intensidade[$k]) != $hora_final){

              $chave_hora = key($hora_intensidade[$k]);
              $valor_intensidade = ($hora_intensidade[$k][$chave_hora]);

              #echo $chave_hora." - ".$valor_intensidade;

              #echo '<br>';
              $k = $k+1;
              ?>
              ['<?php echo $chave_hora;?>', <?php echo $valor_intensidade;?>],
            <?php  
            }
            ?>
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