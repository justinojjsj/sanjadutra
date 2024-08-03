<html>
    <?php
        #Ajustar timezone no PHP
        date_default_timezone_set('America/Sao_Paulo');
    ?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="refresh" content="180">
        <title>Sanja Hoje</title>
        <link rel="icon" type="image/png" href="./img/favicon.ico"/>
        <?php include "./header.php"; ?>
    </head>

    <body onload="moveRelogio()">
        <div class="top">
            <div class="collapse" id="navbarToggleExternalContent">
                <div class="bg-dark p-4">
                    <h5 class="text-white h4">Sanja Hoje</h5>
                    <span class="text-muted">Sistema de Micro Serviços de Mobilidade para São José dos Campos - Projeto Integrador III - UNIVESP</span>
                </div>
            </div>
            <nav class="navbar navbar-dark bg-dark">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                </div>
            </nav>
        </div>

        <div class="container">
            <br>                
            <div class="alert alert-info text-center rounded-pill" role="alert">
                <h2>
                São José dos Campos - SP
                </h2>
            </div>
            <div id='telaSmart'>
                <div id='relogioSmart'>                    
                    <span id='hSmart'></span><span class='doisPontos'>:</span><span id='mSmart'></span><span class='doisPontos'>:</span><span id='sSmart'></span>
                </div>
                <div id='dataSmart'>
                    <span id='semana'></span>
                    <span id='data'></span>
                </div>                       
            </div>
            <br>
            <div class="row row-cols-1 row-cols-md-3 g-4 ">
                
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body "> 
                            <?php
                                include_once('conexao_ccr.php');

                                // Pega a última hora que está salva no banco para obter dados mais recentes
                                $consulta = "SELECT * FROM dados ORDER BY id DESC LIMIT 1";
                                $resultado = mysqli_query($conn, $consulta);
                                $dados = mysqli_fetch_assoc($resultado);                                         
                                $hora_coleta = $dados['hora_coleta']; 
                                $data_coleta = $dados['data_coleta'];
                                $data_coleta = implode("/",array_reverse(explode("-",$data_coleta)));

                                // Com base na última hora salva, captura as demais notícias de tráfego
                                $sql = "SELECT * FROM dados WHERE hora_coleta='$hora_coleta' ORDER BY id DESC LIMIT 3";
                                $result = $conn->query($sql);

                                while($dados = mysqli_fetch_assoc($result)){
                                    if($dados['id']%2 == 0){
                                        echo "<div id='back-cinza' style='margin-bottom: 20px; background-color: rgb(227, 228, 228, 0.5);'>";
                                            echo "<b>".$dados['titulo']."</b>";
                                            echo "<br><br>";
                                            echo $dados['texto'];
                                        echo "</div>";
                                    }else{
                                        echo "<div id='back-white' style='margin-bottom: 20px; background-color: rgb(255, 255, 255, 0.5);'>";
                                            echo "<b>".$dados['titulo']."</b>";
                                            echo "<br><br>";
                                            echo $dados['texto'];
                                        echo "</div>";
                                    }                                                        
                                }  
                            ?>           
                        </div>
                        <div class="card-footer" style="height: 9rem;">
                            <h5 class="card-title">Condições de Tráfego na Via Dutra</h5>
                            <p class="card-text">Dados Obtidos da Concessionária CCR-RIOSP, referente ao trecho de São José dos Campos, Km 246 e proximidades.</p>
                        </div>
                        <div class="card-footer">
                            <small>Última atualização: 
                                <?php        
                                    echo $hora_coleta;
                                    echo ' de ';
                                    echo $data_coleta;                     
                                ?>                            
                            </small>
                        </div>
                    </div>
                </div>                    
            </div>               
        </div>
        <div class="footer">
            </br>
        </div>
        <script src="datahora.js"></script>
    </body>
</html>