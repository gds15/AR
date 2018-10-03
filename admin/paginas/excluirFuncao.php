<?php


	$id = "";
	//recuperar o id enviado por GET
	if ( isset ( $_GET["id"] ) ) {
		$id = trim ( $_GET["id"] );
	}

	//verificar se existe membro com esta funcao
	$sql = "select * from membro
		where funcao_id = ? limit 1";

	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $id);
	$consulta->execute();

	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	//verificar se trouxe o registro
	if ( empty($dados->funcao_id) ) {
		//excluir

		$sql = "delete from funcao 
			where id = ? limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $id);
		//verificar se executou corretamente
		if ( $consulta->execute() ) {
			//enviar para a listagem
			echo "<script>location.href='listaFuncao';</script>";
		} else {
			//deu erro avisar
			echo "<script>alert('Erro ao excluir registro!');history.back();</script>";
		}

	} else {
		//mensagem de erro
		echo "<script>alert('Não é possível excluir, pois existe um membro cadastrado com esta funcao');history.back();</script>";

	}
