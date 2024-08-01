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
                        <div class="card h-100 fundo-cinza">

                            <div class="card-body">
                                <?php
                                    include_once('conexao_inpe.php');

                                    $consulta = "SELECT * FROM dados ORDER BY id DESC LIMIT 1";
                                    $resultado = mysqli_query($conn, $consulta);
                                    $dados = mysqli_fetch_assoc($resultado); 

                                    echo "<div id='chuva' class='inpe-titulo'>";             
                                        echo "Chuva";   
                                        echo "<br>";	   
                                        echo "<div class='inpe'>";                  
                                            if ($dados['chuva_manha']!='Sem dados'){
                                                echo "<div id='chuva-manha' class='inpe'>";
                                                    echo "Manhã: ".$dados['chuva_manha'];  
                                                    echo "<div id='gota' class='inpe'></div>";                                                
                                                echo "</div>";                                  									
                                            }                                    
                                            echo "<div id='chuva-tarde' class='inpe'>";
                                                echo "Tarde: ".$dados['chuva_tarde'];        
                                                echo "<div id='gota' class='inpe'></div>";                                                
                                            echo "</div>";        
                                            echo "<div id='chuva-noite' class='inpe'>";
                                                echo "Noite: ".$dados['chuva_noite'];
                                                echo "<div id='gota' class='inpe'></div>";                                                
                                            echo "</div>";        
                                            echo "<br>";	                                    
                                        echo "</div>";
                                    echo "</div>";


                                    if ($dados['temp_max'] <= 9){
                                        $background_temp = "#43f4fae4;";
                                    }elseif($dados['temp_max'] > 9 && $dados['temp_max'] <= 26){
                                        $background_temp = "#80fa43e4;";
                                    }elseif($dados['temp_max'] > 26 && $dados['temp_max'] <= 32){
                                        $background_temp = "#fa9843e4;";
                                    }elseif($dados['temp_max'] > 32 && $dados['temp_max'] <= 38){
                                        $background_temp = "#fa7603e4;";
                                    }else{
                                        $background_temp = "#fa0303e4";
                                    }

                                    echo "<div id='temperatura' class='inpe-titulo' style='background-color: $background_temp;'>";                                        
                                        echo "Temperatura";
                                        echo "<br>";	
                                        echo "<div class='inpe'>";
                                            echo "<div id='temperatura-min' class='inpe'>";
                                                echo "<div id='frio' class='inpe'></div>";
                                                echo $dados['temp_min']."°";                                                    
                                            echo "</div>";
                                            echo "<div id='temperatura-max' class='inpe'>";                                            
                                                echo "<div id='quente' class='inpe'></div>";                                							
                                                echo $dados['temp_max']."°";                                                            
                                            echo "</div>";
                                            echo "<br>";	
                                        echo "</div>";	
                                    echo "</div>";								
                                    echo "<div id='induv' class='inpe'>";
                                        echo "Índice UV <a href='https://pt.wikipedia.org/wiki/%C3%8Dndice_ultravioleta'>(?)</a>: ";
                                        if($dados['ind_uv'] <= 2.9){
                                            echo "<a style='margin-left: 10px; color: green;'>".$dados['ind_uv']."</a>";                                
                                        }elseif($dados['ind_uv'] >= 3 && $dados['ind_uv'] <= 5.9){
                                            echo "<a style='margin-left: 10px; color: yellow;'>".$dados['ind_uv']."</a>";                                
                                        }elseif($dados['ind_uv'] >= 6 && $dados['ind_uv'] <= 7.9){
                                            echo "<a style='margin-left: 10px; color: orange;'>".$dados['ind_uv']."</a>";                                
                                        }elseif($dados['ind_uv'] >= 8 && $dados['ind_uv'] <= 10.9){
                                            echo "<a style='margin-left: 10px; color: red;'>".$dados['ind_uv']."</a>";                                
                                        }else{
                                            echo "<a style='margin-left: 10px; color: purple;'>".$dados['ind_uv']."</a>";                                
                                        }
                                    echo "</div>";										
                                    echo "<div id='sol' class='inpe'>";
                                        echo "<div id='sol-nascer' class='inpe-titulo'>";
                                            echo "<div id='sunrise'></div>";
                                            echo $dados['amanhecer'];
                                        echo "</div>";	
                                        echo "<div id='sol-por' class='inpe-titulo'>";
                                            echo "<div id='sunset'></div>";
                                            echo $dados['entardecer'];
                                        echo "</div>";									
                                    echo "</div>";										
                                ?>
                            </div>

                            <div class="card-footer"  style="height: 9rem; ">
                                <h5 class="card-title">Condições Climáticas</h5>
                                <p class="card-text">Dados obtidos do Centro de Previsão de Tempo e Estudos Climáticos do Instituto Nacional de Pesquisas Espaciais (CPTEC/INPE) </p>
                            </div>
                            <div class="card-footer atualizacao">
                                <small>Última atualização: <?php echo $dados['hora_coleta']; ?></small>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100 fundo-cinza">
                            <div class="card-body" style="padding: 5px;"> 
                                <?php
                                    include_once('conexao_noticias.php');

                                    $data = date('Y-m-d');
                                                                        
                                    $sql = "SELECT * FROM dados WHERE data_coleta='$data' ORDER BY id DESC LIMIT 4";
                                    $result = $conn->query($sql);

                                    while($dados = mysqli_fetch_assoc($result)){
                                        if($dados['id']%2 == 0){
                                            echo "<div id='back-cinza' style='margin-bottom: 20px; background-color: rgb(227, 228, 228, 0.5);'>";
                                                echo "<a href=".$dados['url'].">".$dados['titulo']."</a> - ".$dados['tempo'];
                                            echo "</div>";
                                        }else{
                                            echo "<div id='back-white' style='margin-bottom: 20px; background-color: rgb(255, 255, 255, 0.5);'>";
                                                echo "<a href=".$dados['url'].">".$dados['titulo']."</a> - ".$dados['tempo'];
                                            echo "</div>";
                                        }                                                        
                                    }        
                                    
                                ?>
                            </div>
                            
                            <div style="background-image: url('./img/noticias.jpg');">                            
                                <div class="card-footer" style="height: 9rem;">
                                    <h5 class="card-title">Últimas notícias do G1</h5>
                                    <p class="card-text">Notícias de São José dos Campos coletadas no portal do G1</p>
                                </div>
                                <div class="card-footer atualizacao">
                                
                                    <small>Última atualização: 
                                        <?php 
                                            $consulta = "SELECT * FROM dados ORDER BY id DESC LIMIT 1";
                                            $resultado = mysqli_query($conn, $consulta);
                                            $dados = mysqli_fetch_assoc($resultado);                                         
                                            echo $dados['hora_coleta'];                                  
                                        ?>                            
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
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