<html>
    <?php
        date_default_timezone_set('America/Sao_Paulo');
    ?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="refresh" content="180">
        <title>SanjaDutra</title>
        <link rel="icon" type="image/png" href="./img/favicon.ico"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <?php include "./header.php"; ?>
    </head>

    <body onload="moveRelogio()">
        <div class="top">
            <div class="collapse" id="navbarToggleExternalContent">
                <div class="bg-dark p-4">
                    <h5 class="text-white h4">SanjaDutra</h5>
                    <span class="text-muted">Sistema de Micro Serviços de Análise de Dados do km 128 a 162 da rodovia Presidente Dutra trecho de São José dos Campos - Projeto Integrador IV - UNIVESP</span>
                </div>                
            </div>
            
            <nav class="navbar navbar-dark bg-dark">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
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
                </div>
            </nav>
        </div>

        <div class="container">
            <br>                
            <div class="alert alert-info text-center rounded-pill" role="alert">
                <h2>
                Análise do trecho da rodovia em São José dos Campos - SP
                </h2>
            </div>
            
            <div class="row row-cols-1 row-cols-md-3 g-4 ">
                
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body "> 
                            <?php
                                include_once('conexao_ccr.php');
                                $consulta = "SELECT * FROM dados ORDER BY id DESC LIMIT 1";
                                $resultado = mysqli_query($conn, $consulta);
                                $dados = mysqli_fetch_assoc($resultado);                                         
                                $hora_coleta = $dados['hora_coleta']; 
                                $data_coleta = $dados['data_coleta'];
                                $data_coleta = implode("/",array_reverse(explode("-",$data_coleta)));
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
                        <div class="card-footer  text-center" style="height: 9rem;">
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

                <div class="col">
                    <div class="card h-100">
                        <div class="card-body ">                            
                            <img class="card-img-top img-fluid" src="img/real.png" alt="Card image cap" style="object-fit: cover; width: 100%; height: auto;">
                        </div>
                        <div class="card-footer  text-center" style="height: 9rem;">
                            <h5 class="card-title">Gráfico Tempo Real</h5>
                            <p class="card-text">Gráfico em tempo real do fluxo de veículos em São José dos Campos.</p>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#graficoModalReal">
                                    Ver Tempo real
                            </button>
                            <a href="grafico_fluxo/tempo_real.php" class="btn btn-primary" target="_blank">
                                Abrir em outra página
                            </a>
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
                
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body ">                            
                            <img class="card-img-top img-fluid" src="img/temporal2.png" alt="Card image cap" style="object-fit: cover; width: 100%; height: auto;">
                        </div>
                        <div class="card-footer  text-center" style="height: 9rem;">
                            <h5 class="card-title">Gráfico Temporal</h5>
                            <p class="card-text">Horários com os maiores fluxos de veículos em São José dos Campos.</p>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#graficoModal">
                                    Ver Gráfico Temporal
                            </button>
                            <a href="grafico_fluxo/temporal.php" class="btn btn-primary" target="_blank">
                                Abrir em outra página
                            </a>
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
                
                

        <!-- Modal -->
        <div class="modal fade" id="graficoModal" tabindex="-1" role="dialog" aria-labelledby="graficoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="graficoModalLabel">Gráfico Temporal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe src="grafico_fluxo/temporal.php" style="width: 100%; height: 800px; border: none;"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="graficoModalReal" tabindex="-1" role="dialog" aria-labelledby="graficoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="graficoModalLabel">Gráfico Tempo Real</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe src="grafico_fluxo/tempo_real.php" style="width: 100%; height: 800px; border: none;"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
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
