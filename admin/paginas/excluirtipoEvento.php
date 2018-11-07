<?php


	$id = "";
	//recuperar o id enviado por GET
	if ( isset ( $parametro[1] ) ) {
		$id = trim ( $parametro[1] );
	}

	//verificar se existe membro com esta funcao
	$sql = "select * from culto
		where tipo_id = ? limit 1";

	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $id);
	$consulta->execute();

	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	//verificar se trouxe o registro
	if ( empty($dados->tipo_id) ) {
		//excluir

		$sql = "update tipoevento set ativo = 'n' where id = ? limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $id);
		//verificar se executou corretamente
		if ( $consulta->execute() ) {
			//enviar para a listagem
			echo "<script>location.href='listaTipoevento';</script>";
		} else {
			//deu erro avisar
			echo "<script>alert('Erro ao excluir registro!');history.back();</script>";
		}

	} else {
		//mensagem de erro
		echo "<script>alert('Não é possível excluir, pois existe um eventoo cadastrado com este tipo');history.back();</script>";

	}
