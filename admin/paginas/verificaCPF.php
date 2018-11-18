<?php

	//iniciar a sessao
	session_start();

	$msg = "";

	if ( !isset( $_SESSION["admin"]["id"] ) ) {
		//direcionar para o index
		$msg = "Você não está logado";
	}

	//incluir o arquivo para conectar no banco
	include "../config/conecta.php";
	if ( empty ( $msg ) ) {

		$cpf = "";
		if ( isset ( $_GET["cpf"] ) ) 
			$cpf = trim ( $_GET["cpf"] );

		$sql = "select * from cliente where cpf = ? limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $cpf);
		$consulta->execute();

		//pegar somente o cpf
		@$cpf = $consulta->fetch(PDO::FETCH_OBJ)->cpf;
		
		if ( empty ( $cpf ) ) 
			$msg = "ok";
		else
			$msg = "Já existe um cliente cadastrado com este CPF";

	}
	sleep(5);
	echo $msg;