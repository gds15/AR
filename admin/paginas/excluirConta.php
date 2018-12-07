<?php

	$id = "";
	//recuperar o id enviado por GET
	if ( isset ( $parametro[1] ) ) {
		$id = trim ( $parametro[1] );
	}
	
	$sql = "select * from conta
			where id = ? limit 1";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $id);
	$consulta->execute();
	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	$valorPago = $dados->valorPago;

	if (empty($valorPago) || $valorPago == 0) {
		$sql = "update conta set ativo = 'n' where id = ? limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $id);
		//verificar se executou corretamente
		if ( $consulta->execute() ) {
			//enviar para a listagem
			echo "<script>location.href='listaConta';</script>";
		} else {
			//deu erro avisar
			echo "<script>alert('Erro ao excluir registro!');history.back();</script>";
		}

	} else {
		echo "<script>alert('Essa conta já foi paga, por favor verificar se é esta conta que deseja desativar, recomendamos estornar o valor.');history.back();</script>";
		exit();
	}

	

