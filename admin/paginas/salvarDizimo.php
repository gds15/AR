<?php

	if ( $_POST ) {

		print_r( $_POST );
		$id     = trim( $_POST["id"] );
		$membro = trim( $_POST["membro"] );
		$data   = trim( $_POST["data"] );
		$valor  = trim( $_POST["valor"] );
		$desc   = trim( $_POST["desc"] );
		

		$data       = formatardata( $data );
		$mes        = date("m");
		$usuariocds = $_SESSION["admin"]["id"];


		//verificar se o campo esta em branco
		if ( empty( $membro ) ) {
			//mensagem com o javascript
			echo "<script>alert('Preencha o membro');history.back();</script>";
		} else if ( empty( $data ) ) {
			//mensagem com o javascript
			echo "<script>alert('Preencha a data');history.back();</script>";
		}  else if ( empty( $valor ) ) {
			//mensagem com o javascript
			echo "<script>alert('Preencha o valor');history.back();</script>";
		}  else if ( empty( $desc ) ) {
			//mensagem com o javascript
			echo "<script>alert('Preencha a descrição');history.back();</script>";
		}  else {

			//verificar se o membro ja efetuou o pagamento neste mes
			$sql = "select * from dizimo
			where membro = ? and mes = ? limit 1";
			$consulta = $pdo->prepare($sql);
			$consulta->bindParam(1, $membro);
			$consulta->bindParam(2, $mes);
			$consulta->execute();
			$dados = $consulta->fetch(PDO::FETCH_OBJ);

			if ( !empty( $dados->id ) ) {
				//já existe um registro cadastrado
				echo "<script>alert('Já existe um cadastro para esse mes');history.back();</script>";
				exit;

			}

			//verificar se o id esta vazio - insert
			if ( empty ( $id ) ) {
				
				//gravar no banco de dados
				$sql = "insert into dizimo (id, membro, valor, desc, data, usuariocds, mes)
				values (NULL, ? , ?, ?, ?, ?, ? )";
				$consulta = $pdo->prepare($sql);
				//passar o parametro
				$consulta->bindParam(1, $membro);
				$consulta->bindParam(2, $valor);
				$consulta->bindParam(3, $desc);
				$consulta->bindParam(4, $data);
				$consulta->bindParam(5, $usuariocds);
				$consulta->bindParam(6, $mes);
			} else {
				//dar update
				$sql = "update dizimo 
					set membro = ?, valor = ?, desc = ?, data = ?, usuariocds = ? where id = ? limit 1";
				$consulta = $pdo->prepare( $sql );
				$consulta->bindParam( 1, $membro );
				$consulta->bindParam( 2, $valor);
				$consulta->bindParam( 3, $desc);
				$consulta->bindParam( 4, $data);
				$consulta->bindParam( 5, $usuariocds);
				$consulta->bindParam( 6, $id );
			}

			//verificar se executou corretamente
			if ( $consulta->execute() ) {

				echo "<script>alert('Registro Salvo');location.href='listaDizimo0';</script>";

			} else {

				echo "<script>alert('Erro ao Salvar');history.back();</script>";

			}
		}
	} else {

		//mensagem de erro ao acessar diretamente o arquivo
		echo "<div class='alert alert-danger container'>
		ERRO: tentativa inválida</div>";

	}

