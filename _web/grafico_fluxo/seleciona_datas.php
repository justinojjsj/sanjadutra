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
            $msg = "Data selecionada: " . htmlspecialchars($dataSelecionada);
        } else {
            $msg = "Nenhuma data foi selecionada.";
        }
    }

    // Consulta ao banco de dados
    $sql = "SELECT DISTINCT data_coleta FROM classificados;";
    $result = $conn->query($sql);
    
?>



























?>