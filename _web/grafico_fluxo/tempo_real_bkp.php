<html>
  <body>

    <h1> GRÁFICO DE TRÁFEGO EM TEMPO REAL SJC </h1>  
    

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);                      

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Hora', 'Fluxo de Veículos'],

          <?php

            date_default_timezone_set('America/Sao_Paulo');

            function hora_intensidade(){
              include_once('../conexao_ccr.php'); 
              
              global $hoje;
              $hoje = date("Y-m-d");
              #$sql = "SELECT * FROM classificados WHERE cidade='São José dos Campos' AND data_coleta='$hoje'";
              $sql = "SELECT *, '$hoje' AS data_especifica FROM classificados WHERE cidade LIKE 'São José%'";

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
                  $intensidade[] = 4;
                  $hora_intensidade[] = array(substr($dados['hora_coleta'], 0, 5) => 4);
                }elseif($dados['trafego'] == 'Lento'){
                  $intensidade[] = 3;
                  $hora_intensidade[] = array(substr($dados['hora_coleta'], 0, 5) => 3);
                }elseif($dados['trafego'] == 'Acesso'){
                  $intensidade[] = 2;
                  $hora_intensidade[] = array(substr($dados['hora_coleta'], 0, 5) => 2);
                }elseif($dados['trafego'] == 'Normal'){
                  $intensidade[] = 1;
                  $hora_intensidade[] = array(substr($dados['hora_coleta'], 0, 5) => 1);
                }elseif($dados['trafego'] == 'Congestionado'){
                  $intensidade[] = 5;
                  $hora_intensidade[] = array(substr($dados['hora_coleta'], 0, 5) => 5);
                }elseif($dados['trafego'] == 'Interditado'){
                  $intensidade[] = 6;
                  $hora_intensidade[] = array(substr($dados['hora_coleta'], 0, 5) => 6);
                }
                $hora_coleta[] = substr($dados['hora_coleta'], 0, 5); 
                $hora_final = substr($dados['hora_coleta'], 0, 5); 
              }

              return [$hora_inicial, $hora_final, $hora_coleta, $intensidade, $hora_intensidade];
            }

            [$hora_inicial, $hora_final, $hora_coleta, $intensidade, $hora_intensidade] = hora_intensidade();

            #FUNÇÃO PARA GERAR HORAS DE 15 EM 15 MINUTOS, BASEADOS DA PRIMEIRA E ÚLTIMA HORA DO BD
            function geraHoras($inicial, $final){
              $horas = [];
              $momento = strtotime($inicial);
              $final = strtotime($final);

              while($momento <= $final){
                $horas[] = date('H:i', $momento);
                $momento = strtotime('+15 minutes', $momento);
              }
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
          title: 'Cidade: São José dos Campos - Data: <?php echo $hoje  ?>',
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