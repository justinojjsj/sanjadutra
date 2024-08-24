<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="refresh" content="180">
        <title>Cidades cortadas pela via Dutra</title>
        <link rel="icon" type="image/png" href="./img/favicon.ico"/>
        <?php include "./header.php"; ?>
    </head>

    <body>
        <div class="d-flex justify-content-center align-items-center min-vh-100">
            <div class="card col-12 col-md-8 col-lg-6">
                <div class="card-header text-center">
                    <h5 class="card-title">Trechos no sentido RJ-SP</h5>
                </div>
                <div class="card-body"> 
                    <?php
                        include_once('conexao_ccr.php');

                        echo "<div class='d-flex justify-content-center'>";
                        echo "<table class='table table-striped text-center'>";
                        echo "<thead><tr><th>Cidade</th><th>Km Inicial</th><th>Km Final</th></tr></thead>";
                        echo "<tbody>";
                        
                        // Pega o km inicial e final de cada cidade
                        $consulta = "SELECT * FROM locais ORDER BY km_ini ASC";
                        $resultado = mysqli_query($conn, $consulta);
                        while($dados = mysqli_fetch_assoc($resultado)){
                            echo "<tr><td>" . $dados["cidade"]. "</td><td>" . $dados["km_ini"]. "</td><td>" . $dados["km_fim"]. "</td></tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        echo "</div>";                 
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>