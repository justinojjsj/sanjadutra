<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>SanjaDutra Tempo Real</title>
    <style>
        /* Estilo adicional para o gráfico */
        #curve_chart {
            width: 100%;
            height: 400px; /* Altura fixa do gráfico */
            margin-top: 20px; /* Espaço acima do gráfico */
        }
        body {
            overflow-x: hidden; /* Evitar rolagem horizontal */
        }
    </style>
</head>
<body>

<div class="container text-center mt-5">
    <h1 class="text-primary">GRÁFICO DE TRÁFEGO EM TEMPO REAL</h1>
    <h2 class="text-muted">SÃO JOSÉ DOS CAMPOS</h2>
</div>    

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">

try{

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
                    $hoje = '2024-10-15';
                    #$sql = "SELECT *, '$hoje' AS data_especifica FROM classificados WHERE cidade LIKE 'São José%'";
                    $sql = "SELECT * FROM classificados WHERE data_coleta = '$hoje' AND cidade LIKE 'São José%'";
                    $result = $conn->query($sql);

                    $cont_hr = 0; 
                    $intensidade = []; 
                    $hora_coleta = []; 
                    $hora_inicial = 0;
                    $hora_final = 0;
                    $hora_intensidade = []; 

                    while($dados = mysqli_fetch_assoc($result)){
                        if($cont_hr == 0){
                            $hora_inicial = substr($dados['hora_coleta'], 0, 5); 
                        }
                        $cont_hr++;

                        $intensidadeValor = match ($dados['trafego']) {
                            'Bloqueado' => 7,
                            'bloqueado' => 7,
                            'Interditado' => 6,
                            'interditado' => 6,
                            'Congestionado' => 5,
                            'congestionado' => 5,
                            'Intenso' => 4,
                            'intenso' => 4,
                            'Lento' => 3,
                            'lento' => 3,
                            'Acesso' => 2,
                            'acesso' => 2,
                            'Normal' => 1,
                            'normal' => 1,
                            default => 0, #Coloquei esse caso para não parar de funcionar o gráfico inesperadamente caso a CCR cadastro um novo tipo de tráfego não previsto no meu código
                        };
                        $intensidade[] = $intensidadeValor;
                        $hora_intensidade[] = array(substr($dados['hora_coleta'], 0, 5) => $intensidadeValor);
                        $hora_coleta[] = substr($dados['hora_coleta'], 0, 5); 
                        $hora_final = substr($dados['hora_coleta'], 0, 5); 
                    }

                    return [$hora_inicial, $hora_final, $hora_coleta, $intensidade, $hora_intensidade];
                }

                [$hora_inicial, $hora_final, $hora_coleta, $intensidade, $hora_intensidade] = hora_intensidade();

                function obterUltimoQuartoDeHora() {
                    $agora = new DateTime();
                    $minutos = (int)($agora->format('i') / 15) * 15;
                    $agora->setTime($agora->format('H'), $minutos, 0);
                    return $agora->format('H:i');
                }

                $ultimoQuarto = obterUltimoQuartoDeHora();

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

                $horas_totais = geraHoras($hora_inicial, $ultimoQuarto);
                $horas_vagas = array_diff($horas_totais, $hora_coleta);

                foreach($horas_vagas as $hv){
                    $hora_intensidade[] = [$hv => 0]; 
                }

                function compararHorarios($a, $b) {
                    $chaveA = key($a);
                    $chaveB = key($b);
                    return strcmp($chaveA, $chaveB);
                }

                uasort($hora_intensidade, 'compararHorarios');
                $hora_intensidade = array_values($hora_intensidade);

                $k = 0;
                while(key($hora_intensidade[$k]) != $ultimoQuarto){
                    $chave_hora = key($hora_intensidade[$k]);
                    $valor_intensidade = ($hora_intensidade[$k][$chave_hora]);
                    ?>
                    ['<?php echo $chave_hora;?>', <?php echo $valor_intensidade;?>],
                    <?php  
                    $k = $k+1;
                }
            ?>
        ]);

        var options = {
            width: '100%', 
            height: '100%', 
            vAxis: {
                title: 'Cidade: São José dos Campos - Data: <?php echo $hoje;?> - Última captura: <?php echo $ultimoQuarto; ?>',
                curveType: 'function',
                legend: { position: 'bottom' },
                ticks: [
                    { v: 0, f: "Contínuo" },
                    { v: 1, f: "Normal" },
                    { v: 2, f: "Acesso" },
                    { v: 3, f: "Lento" },
                    { v: 4, f: "Intenso" },
                    { v: 5, f: "Congestionado" },
                    { v: 6, f: "Interditado" },
                    { v: 7, f: "Bloqueado" }
                ]
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        chart.draw(data, options);
    }

    window.addEventListener('resize', drawChart);
}catch (e) {
    // Exibir erro na tela
    document.getElementById('erro').textContent = "Erro: " + e.message;
}
</script>

<div id="curve_chart"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>