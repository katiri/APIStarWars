<?php
	$servername = "localhost";
	$dbname = $_ENV['DB_NAME'];
	$username = $_ENV['DB_USER'];
	$password = $_ENV['DB_PASSWORD'];

	try{
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $erro){
		echo "Falha na Conexao: " . $erro->getMessage();	
	}