<?php
	$servidor = "170.14.0.3:3306";
	$usuario = "root";
	$senha = "my-secret-pw";
	$dbname = "db_noticias";
	
	//Criar a conexao
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
	
	if(!$conn){
		die("Falha na conexao: " . mysqli_connect_error());
	}else{
		//echo "Conexao realizada com sucesso";
	}	
?>