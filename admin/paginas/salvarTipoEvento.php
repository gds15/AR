<?php

	if ( $_POST ) {

		//recuperar os dados do formulário
		//print_r( $_POST );
		$id   = trim( $_POST["id"] );
		$tipo = trim( $_POST["tipo"] );

		//verificar se o campo esta em branco
		if ( empty( $tipo ) ) {
			//mensagem com o javascript
			echo "<script>alert('Preencha o tipo do evento');history.back();</script>";
		} else {

			//verificar se o registro já existe
			$sql = "select * from tipoevento
			where tipo = ? 
			and id <> ? limit 1";
			$consulta = $pdo->prepare($sql);
			$consulta->bindParam(1, $tipo);
			$consulta->bindParam(2, $id);
			$consulta->execute();
			$dados = $consulta->fetch(PDO::FETCH_OBJ);

			if ( !empty( $dados->tipo ) ) {
				//já existe um registro cadastrado
				echo "<script>alert('Já existe um cadastro com este tipo');history.back();</script>";
				exit;

			}

			//verificar se o id esta vazio - insert
			if ( empty ( $id ) ) {
				//gravar no banco de dados
				$sql = "insert into tipoevento (id, tipo, ativo)
				values (NULL, ?, 's' )";
				$consulta = $pdo->prepare($sql);
				//passar o parametro
				$consulta->bindParam(1, $tipo);
			
			} else {
				//dar update
				$sql = "update tipoevento 
					set tipo = ?,
					ativo = 's' 
					where id = ? 
					limit 1";
				$consulta = $pdo->prepare( $sql );
				$consulta->bindParam( 1, $tipo );
				$consulta->bindParam( 2, $id );

			}

			//verificar se executou corretamente
			if ( $consulta->execute() ) {

				echo "<script>alert('Registro Salvo');location.href='listaTipoEvento';</script>";

			} else {

				echo "<script>alert('Erro ao Salvar');history.back();</script>";

			}
		}
	} else {

		//mensagem de erro ao acessar diretamente o arquivo
		echo "<div class='alert alert-danger container'>
		ERRO: tentativa inválida</div>";

	}



