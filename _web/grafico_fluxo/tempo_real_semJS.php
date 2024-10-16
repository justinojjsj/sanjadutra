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
   

<?php
    date_default_timezone_set('America/Sao_Paulo');

    function hora_intensidade(){
        include_once('../conexao_ccr.php'); 
        global $hoje;
        $hoje = date("Y-m-d");
        //echo $hoje;
        
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
                'Congestionado' => 5,
                'Intenso' => 4,
                'intenso' => 4,
                'Lento' => 3,
                'Acesso' => 2,
                'Normal' => 1,
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>