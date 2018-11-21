<?php

	$id = $_SESSION["admin"]["id"];
	
	$sql = "update usuario set ativo = 'Nao' where id = ? limit 1";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $id);
	//verificar se executou corretamente
	if ( $consulta->execute() ) {
		//enviar para a listagem
		echo "<script>location.href='index';</script>";
	} else {
		//deu erro avisar
		echo "<script>alert('Erro ao excluir Perfil!!!');history.back();</script>";
	}





