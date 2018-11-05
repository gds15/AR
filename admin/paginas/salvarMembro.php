<?php
	//VERIFICAR SE FOI POST

	if ( $_POST ) {

		$id 				= trim ( $_POST["id"] );
		$nome		 		= trim ( $_POST["nome"] );
		$funcao_id          = trim ( $_POST["funcao_id"] );
		$email				= trim ( $_POST["email"] );
		$datanascimento 	= trim ( $_POST["datanascimento"] );
		$datanascimento 	= explode("/", $datanascimento);
		$dia 				= $datanascimento[0];
		$mes 				= $datanascimento[1];
		$ano 				= $datanascimento[2];
		$datanascimento  	= $ano."-".$mes."-".$dia;
		$telefone			= trim ( $_POST["telefone"] );
		$cpf				= trim ( $_POST["cpf"] );
		$endereco			= trim ( $_POST["endereco"] );
		$cidade				= trim ( $_POST["cidade"] );
		$estado 			= trim ( $_POST["estado"] );
		$bairro				= trim ( $_POST["bairro"] );
		$cep 				= trim ( $_POST["cep"] );
		

		if( empty( $id ) ) {

			//NOVO CADASTRO DE MEMBRO INSERIR NOVO CADASTRO

			$sql 			= "INSERT INTO membro (id, nome, funcao_id, cpf, email, datanascimento, telefone, endereco, cidade, estado, bairro, cep ) VALUES ( NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";
			$consulta 		= $pdo->prepare( $sql );
			$consulta 		->bindParam(1,$nome );
			$consulta       ->bindParam(2, $funcao_id );
			$consulta 		->bindParam(3,$cpf );
			$consulta 		->bindParam(4,$email );
			$consulta 		->bindParam(5,$datanascimento );
			$consulta 		->bindParam(6,$telefone );
			$consulta		->bindParam(7,$endereco);
			$consulta 		->bindParam(8,$cidade);
			$consulta 		->bindParam(9,$estado);
			$consulta 		->bindParam(10,$bairro);
			$consulta 		->bindParam(11,$cep);

		} else {
			//atualizar os Membros função atualizar 

			$sql 			= "UPDATE membro SET nome = ?, funcao_id = ?, cpf = ?, email = ?, datanascimento = ?, telefone = ?, endereco = ?, cidade = ?, estado = ?, bairro = ?, cep = ? WHERE id = ? LIMIT 1";
			$consulta		= $pdo->prepare( $sql );
			$consulta		->bindParam(1, $nome);
			$consulta       ->bindParam(2, $funcao_id );
			$consulta 		->bindParam(3,$cpf);
			$consulta 		->bindParam(4,$email);
			$consulta 		->bindParam(5,$datanascimento);
			$consulta 		->bindParam(6,$telefone);
			$consulta		->bindParam(7,$endereco);
			$consulta 		->bindParam(8,$cidade);
			$consulta 		->bindParam(9,$estado);
			$consulta 		->bindParam(10,$bairro);
			$consulta 		->bindParam(11,$cep);
			$consulta		->bindParam(12,$id);

		}

		if( $consulta->execute() ) {

			echo "<script>alert('Membro Salvo Com Sucesso'); location.href='listaMembros'</script>";

		} else {

			echo "<script>alert('ERRO ao salvar membro'); history.back();</script>";

		}

	}  else {

		//mensagem de erro ao acessar diretamente o arquivo
		echo "<div class='alert alert-danger container'>
		ERRO: tentativa inválida</div>";

	}