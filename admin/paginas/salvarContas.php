<?php

	if ( $_POST ) {

		//print_r( $_POST );
		$id         = trim( $_POST["id"] );
		$data       = trim( $_POST["data"] );
		$descricao  = trim( $_POST["descricao"] );
		$valor      = trim( $_POST["valor"] );
		$valorPago  = trim( $_POST["valorPago"] );
		$multaJuros = trim( $_POST["multaJuros"] );

		$data = formatardata( $data );


		//verificar se o campo esta em branco
		if ( empty( $data ) ) {
			//mensagem com o javascript
			echo "<script>alert('Preencha a data);history.back();</script>";
		} else if ( empty( $descricao ) ) {
			//mensagem com o javascript
			echo "<script>alert('Preencha a descrição');history.back();</script>";
		}  else if ( empty( $valor ) ) {
			//mensagem com o javascript
			echo "<script>alert('Preencha o valor');history.back();</script>";
		}  else {

			//verificar se existe esta conta cadastrada
			$sql = "select * from conta
			where descricao = ? and data = ? limit 1";
			$consulta = $pdo->prepare($sql);
			$consulta->bindParam(1, $descricao);
			$consulta->bindParam(2, $data);
			$consulta->execute();
			$dados = $consulta->fetch(PDO::FETCH_OBJ);

			if ( !empty( $dados->id ) ) {
				//já existe um registro cadastrado
				echo "<script>alert('esta conta já esta cadastrada');history.back();</script>";
				exit;

			}

			//verificar se o id esta vazio - insert
			if ( empty ( $id ) ) {

				//gravar no banco de dados
				$sql = "insert into conta (id, data, descricao, valor, valorPago, multaJuros)
				values (NULL, ? , ?, ?, ?, ? )";
				$consulta = $pdo->prepare($sql);
				//passar o parametro
				$consulta->bindParam(1, $data);
				$consulta->bindParam(2, $descricao);
				$consulta->bindParam(3, $valor);
				$consulta->bindParam(4, $valorPago);
				$consulta->bindParam(5, $multaJuros);
			} else {
				//dar update
				$sql = "update conta 
					set data = ?, descricao = ?, valor = ?, valorPago = ?, multaJuros = ? where id = ? limit 1";
				$consulta = $pdo->prepare( $sql );
				$consulta->bindParam(1, $data);
				$consulta->bindParam(2, $descricao);
				$consulta->bindParam(3, $valor);
				$consulta->bindParam(4, $valorPago);
				$consulta->bindParam(5, $multaJuros);
				$consulta->bindParam(6, $id );
			}

			//verificar se executou corretamente
			if ( $consulta->execute() ) {

				echo "<script>alert('Registro Salvo');location.href='listaConta';</script>";

			} else {

				echo "<script>alert('Erro ao Salvar');history.back();</script>";

			}
		}
	} else {

		//mensagem de erro ao acessar diretamente o arquivo
		echo "<div class='alert alert-danger container'>
		ERRO: tentativa inválida</div>";

	}

