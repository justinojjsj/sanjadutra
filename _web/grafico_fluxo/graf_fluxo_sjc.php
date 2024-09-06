<html>
  <head>

  </head>

  <body>

    <h1> GRÁFICO DE INTENSIDADE DE TRÁFEGO POR HORAS </h1>
    
    <?php
      include_once('../conexao_ccr2.php'); 

      // Verifica a conexão
      if ($conn->connect_error) {
          die("Falha na conexão: " . $conn->connect_error);
      }

      // Inicializa variável para armazenar a mensagem
      $msg = "";

      // Verifica se o formulário foi enviado
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // Verifica se a data foi selecionada
          if (isset($_POST['datas'])) {
              // Captura a data selecionada
              $dataSelecionada = $_POST['datas'];
              #$msg = "Data selecionada: " . htmlspecialchars($dataSelecionada);
              $msg = htmlspecialchars($dataSelecionada);
          } else {
              $msg = "Nenhuma data foi selecionada.";
          }
      }

      // Consulta ao banco de dados
      $sql = "SELECT DISTINCT data_coleta FROM classificados;";
      $result = $conn->query($sql);
      
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

            function hora_intensidade(){
              include_once('../conexao_ccr.php'); 
              global $msg;
              $sql = "SELECT * FROM classificados WHERE cidade='São José dos Campos' AND data_coleta='$msg'";
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
                  $intensidade[] = 5;
                  $hora_intensidade[] = array(substr($dados['hora_coleta'], 0, 5) => 5);
                }elseif($dados['trafego'] == 'Lento'){
                  $intensidade[] = 4;
                  $hora_intensidade[] = array(substr($dados['hora_coleta'], 0, 5) => 4);
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
          title: 'Cidade: São José dos Campos - Data: <?php echo $msg  ?>',
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