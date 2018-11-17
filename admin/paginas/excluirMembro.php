<?php


	$id = "";
	//recuperar o id enviado por GET
	if ( isset ( $_GET["id"] ) ) {
		$id = trim ( $_GET["id"] );
	}

	//verificar se existe um culto com esse responsavel
	$sql = "select * from culto  where responsavel = ? limit 1";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $id);
	$consulta->execute();

	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	//verificar se trouxe o registro
	if ( empty($dados->id) ) {
		//excluir
		$sql = "delete from membro where id = ? limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $id);
		//verificar se executou corretamente
		if ( $consulta->execute() ) {
			//enviar para a listagem
			echo "<script>location.href='listaMembros';</script>";
		} else {
			//deu erro avisar
			echo "<script>alert('Erro ao excluir registro ou esse membro é responsavel por algum evento !');history.back();</script>";
		}

	} 