<?php



	if ( $_POST ) {

		//print_r( $_POST );
		$id          = trim( $_POST["id"] );
		$responsavel = trim( $_POST["responsavel"] );
		$data        = trim( $_POST["data"] );
		$hora        = trim( $_POST["hora"] );
		$local       = trim( $_POST["local"] );
		$tipo        = trim( $_POST["tipo"] );

		$data = formatardata( $data );


		//verificar se o campo esta em branco
		if ( empty( $responsavel ) ) {
			//mensagem com o javascript
			echo "<script>alert('Preencha o responsavel');history.back();</script>";
		} else if ( empty( $data ) ) {
			//mensagem com o javascript
			echo "<script>alert('Preencha a data');history.back();</script>";
		}  else if ( empty( $hora ) ) {
			//mensagem com o javascript
			echo "<script>alert('Preencha a hora');history.back();</script>";
		}  else if ( empty( $local ) ) {
			//mensagem com o javascript
			echo "<script>alert('Selecione o local');history.back();</script>";
		}  else if ( empty( $tipo ) ) {
			//mensagem com o javascript
			echo "<script>alert('Selecione o tipo');history.back();</script>";
		}  else {

			//verificar se existe culto nessa hora
			$sql = "select * from culto
			where hora = ? and data = ? limit 1";
			$consulta = $pdo->prepare($sql);
			$consulta->bindParam(1, $hora);
			$consulta->bindParam(2, $data);
			$consulta->execute();
			$dados = $consulta->fetch(PDO::FETCH_OBJ);

			if ( !empty( $dados->id ) ) {
				//já existe um registro cadastrado
				echo "<script>alert('Já existe um evento para esse horario e data');history.back();</script>";
				exit;

			}

			//verificar se o id esta vazio - insert
			if ( empty ( $id ) ) {

				//gravar no banco de dados
				$sql = "insert into culto (id, responsavel, data, hora, local, tipo)
				values (NULL, ? , ?, ?, ?, ? )";
				$consulta = $pdo->prepare($sql);
				//passar o parametro
				$consulta->bindParam(1, $responsavel);
				$consulta->bindParam(2, $data);
				$consulta->bindParam(3, $hora);
				$consulta->bindParam(4, $local);
				$consulta->bindParam(5, $tipo);
			} else {
				//dar update
				$sql = "update culto 
					set responsavel = ?, data = ?, hora = ?, local = ?, tipo = ? where id = ? limit 1";
				$consulta = $pdo->prepare( $sql );
				$consulta->bindParam( 1, $responsavel );
				$consulta->bindParam( 2, $data);
				$consulta->bindParam( 3, $hora);
				$consulta->bindParam( 4, $local);
				$consulta->bindParam( 5, $tipo);
				$consulta->bindParam( 6, $id );
			}

			//verificar se executou corretamente
			if ( $consulta->execute() ) {

				echo "<script>alert('Registro Salvo');location.href='listaCulto';</script>";

			} else {

				echo "<script>alert('Erro ao Salvar');history.back();</script>";

			}
		}
	} else {

		//mensagem de erro ao acessar diretamente o arquivo
		echo "<div class='alert alert-danger container'>
		ERRO: tentativa inválida</div>";

	}

