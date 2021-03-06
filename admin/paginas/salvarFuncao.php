<?php
	
	if ( $_POST ) {

		//recuperar os dados do formulário
		//print_r( $_POST );
		$id = trim( $_POST["id"] );
		$funcao = trim( $_POST["funcao"] );

		//verificar se o campo esta em branco
		if ( empty( $funcao ) ) {
			//mensagem com o javascript
			echo "<script>alert('Preencha a funcao');history.back();</script>";
		} else {

			//verificar se o registro já existe
			$sql = "select * from funcao
			where funcao = ? 
			and id <> ? limit 1";
			$consulta = $pdo->prepare($sql);
			$consulta->bindParam(1, $funcao);
			$consulta->bindParam(2, $ativo);
			$consulta->bindParam(3, $id);
			$consulta->execute();
			$dados = $consulta->fetch(PDO::FETCH_OBJ);

			if ( !empty( $dados->funcao ) ) {
				//já existe um registro cadastrado
				echo "<script>alert('Já existe um cadastro com esta funcao');history.back();</script>";
				exit;

			}

			//verificar se o id esta vazio - insert
			if ( empty ( $id ) ) {
				//gravar no banco de dados
				$sql = "insert into funcao (id, funcao, ativo)
				values (NULL, ?, 's' )";
				$consulta = $pdo->prepare($sql);
				//passar o parametro
				$consulta->bindParam(1, $funcao);
			
			} else {
				//dar update
				$sql = "update funcao 
					set funcao = ?,
					ativo = 's' 
					where id = ? 
					limit 1";
				$consulta = $pdo->prepare( $sql );
				$consulta->bindParam( 1, $funcao );
				$consulta->bindParam( 2, $id );

			}

			//verificar se executou corretamente
			if ( $consulta->execute() ) {

				echo "<script>alert('Registro Salvo');location.href='listaFuncao';</script>";

			} else {

				echo "<script>alert('Erro ao Salvar');history.back();</script>";

			}
		}
	} else {

		//mensagem de erro ao acessar diretamente o arquivo
		echo "<div class='alert alert-danger container'>
		ERRO: tentativa inválida</div>";

	}



