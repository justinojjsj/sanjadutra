<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>SanjaDutra Temporal</title>
    <style>
        /* Limitar a altura do gráfico */
        #curve_chart {
            width: 100%;
            height: 400px; /* Altura fixa para o gráfico */
            overflow: auto; /* Permite rolagem se necessário */
        }
    </style>
</head>
<body>

<div class="container text-center mt-5">
    <h1 class="text-primary">GRÁFICO DE TRÁFEGO TEMPORAL</h1>
    <h2 class="text-muted">SÃO JOSÉ DOS CAMPOS</h2>
</div>    

<?php
    include_once('../conexao_ccr.php'); 

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Inicializa variável para armazenar a mensagem
    $msg_data = "";
    $msg_cidade = "";

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['datas']) && isset($_POST['cidade'])) {
            $dataSelecionada = $_POST['datas'];
            $cidadeSelecionada = $_POST['cidade'];
            $msg_data = htmlspecialchars($dataSelecionada);
            $msg_cidade = htmlspecialchars($cidadeSelecionada);
        }
    }

    // Consulta ao banco de dados
    $sql = "SELECT DISTINCT data_coleta FROM classificados_temporais;";
    $result = $conn->query($sql);
    
    $sql_cidade = "SELECT DISTINCT cidade FROM classificados_temporais WHERE cidade LIKE 'São José%'";
    $result_cidade = $conn->query($sql_cidade);
?>

<div class="container mt-5">
    <h2 class="text-center">Escolha uma Data e uma Cidade</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="datas">Escolha uma data:</label>
            <select name="datas" id="datas" class="form-control">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $selected = ($msg_data === htmlspecialchars($row["data_coleta"])) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($row["data_coleta"]) . '" ' . $selected . '>' . htmlspecialchars($row["data_coleta"]) . '</option>';
                    }
                } else {
                    echo '<option value="">Nenhuma data disponível</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="cidade">Escolha uma cidade:</label>
            <select name="cidade" id="cidade" class="form-control">
                <?php
                if ($result_cidade->num_rows > 0) {
                    while($row_cidade = $result_cidade->fetch_assoc()) {
                        $selected = ($msg_cidade === htmlspecialchars($row_cidade["cidade"])) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($row_cidade["cidade"]) . '" ' . $selected . '>' . htmlspecialchars($row_cidade["cidade"]) . '</option>';
                    }
                } else {
                    echo '<option value="">Nenhuma cidade disponível</option>';
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Enviar</button>
    </form>
</div>


        <?php
            include_once('../conexao_ccr.php'); 
            #$sql = "SELECT * FROM classificados_temporais WHERE cidade='$msg_cidade' AND data_coleta='$msg_data'";
            $sql = "SELECT * FROM classificados_temporais WHERE cidade='$msg_cidade' AND data_coleta='$msg_data' ORDER BY hora_coleta ASC";
            $result = $conn->query($sql);          

            #$sql_hora_final = "SELECT hora_coleta FROM classificados_temporais WHERE cidade='$msg_cidade' AND data_coleta='$msg_data' ORDER BY hora_coleta DESC";
            #$result_hora_final = $conn->query($sql_hora_final);          
            #$horaFim = mysqli_fetch_row($result_hora_final);

            $i=0;
            if($i==0){
                while($dados = mysqli_fetch_assoc($result)){
                    // Define a data para o evento
                    
                    #$dataColeta = $msg_data;
                    $dataColeta = new DateTime($msg_data);
                    

                    #$horaInicio = new DateTime($dados['hora_coleta']);
                    $horaInicio = $dados['hora_coleta'];
                    #$horaInicio = '00:00';
                    $horaInicio = new DateTime($horaInicio);                    
                    
                    // Adiciona 15 minutos para a hora de fim
                    $horaFim = clone $horaInicio;
                    $horaFim->add(new DateInterval('PT15M')); // Adiciona 15 minutos

                    $horaLimite = '23:45';
                    $horaLimite = new DateTime($horaLimite);                    
    
                    // Garante que a hora de fim está depois da hora de início
                    if ($horaFim > $horaInicio) {
                        if ($horaInicio != $horaLimite) {
                            // Cria um evento único concatenando pista e motivo
                            $evento = htmlspecialchars($dados['pista']) . ' - ' . htmlspecialchars($dados['motivo']);
                            #$cor = '#ADD8E6';
                            $cor = htmlspecialchars($dados['cor']);
                            
                            
                            echo $evento . ' ' . $cor . ' ' .
                            $dataColeta->format('Y') . '-' .
                            ($dataColeta->format('m')-1) . '-' .
                            $dataColeta->format('d') . '  ' .
                            $horaInicio->format('H') . ':' .
                            $horaInicio->format('i') . ' || ' .
                            $dataColeta->format('Y') . '-' .
                            ($dataColeta->format('m') - 1) . '-' .
                            $dataColeta->format('d') . ' ' .
                            $horaFim->format('H') . ':' .
                            $horaFim->format('i');

                            echo "<br>";
                        }
                    }
                }
            }else{
                while($dados = mysqli_fetch_assoc($result)){
                    // Define a data para o evento
                    
                    #$dataColeta = new DateTime($msg_data);
                    $dataColeta = $msg_data;

                    #$horaInicio = new DateTime($dados['hora_coleta']);
                    $horaInicio = '00:00';
                    
                    // Adiciona 15 minutos para a hora de fim
                    $horaFim = '23:45';
                    //$horaFim->add(new DateInterval('PT15M')); // Adiciona 15 minutos
                      
                    // Garante que a hora de fim está depois da hora de início
                    //if ($horaFim > $horaInicio) {
                        // Cria um evento único concatenando pista e motivo
                        $evento = htmlspecialchars($dados['pista']) . ' - ' . htmlspecialchars($dados['motivo']);
                        #$cor = '#ADD8E6';
                        $cor = htmlspecialchars($dados['cor']);

                        ###
                        echo "Evento: " . $evento . " | Cor: " . $cor . " | Hora de Coleta: " . $dados['hora_coleta'];
                        echo "<br>";
                   // }else{
                        
                   // }
                }
            }
                
    

        ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
