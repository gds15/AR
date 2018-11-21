<?php
	if ( $_POST ) {

		//recuperar os dados do formulário
		//print_r( $_POST );
		$id    = trim( $_POST["id"] );
		$nome  = trim( $_POST["nome"] );
		$email = trim( $_POST["email"] );
		$login = trim( $_POST["login"] );
		$senha = trim( $_POST["senha"] );

		//verificar se o campo esta em branco
		if ( empty( $nome ) ) {
			//mensagem com o javascript
			echo "<script>alert('Preencha o nome');history.back();</script>";
		} else if ( empty( $email ) ) {
			//mensagem com o javascript
			echo "<script>alert('Preencha o e-mail');history.back();</script>";
		}  else if ( empty( $login ) ) {
			//mensagem com o javascript
			echo "<script>alert('Preencha o login');history.back();</script>";
		} else {

			//criptografar senha se não estiver vazia
			if ( ! empty ( $senha ) ) $senha = md5( $senha );

			//verificar se o id esta vazio - insert
				
				if ( empty ( $senha ) ) {
					//dar update
					$sql = "update usuario 
						set nome = ? , email = ?, login = ?
						where id = ? 
						limit 1";
					$consulta = $pdo->prepare( $sql );
					$consulta->bindParam( 1, $nome );
					$consulta->bindParam( 2, $email);
					$consulta->bindParam( 3, $login );
					$consulta->bindParam( 4, $id );
				} else {
					//dar update
					$sql = "update usuario 
						set nome = ? , email = ?, login = ?, senha = ?
						where id = ? 
						limit 1";
					$consulta = $pdo->prepare( $sql );
					$consulta->bindParam( 1, $nome );
					$consulta->bindParam( 2, $email);
					$consulta->bindParam( 3, $login );
                    $consulta->bindParam( 4, $senha );
					$consulta->bindParam( 5, $id );
				}

			//verificar se executou corretamente
			if ( $consulta->execute() ) {

				echo "<script>alert('Perfil Atualizado!!!o');location.href='perfil';</script>";

			} else {

				echo "<script>alert('Erro ao Editar Perfil');history.back();</script>";

			}
		}
	} else {

		//mensagem de erro ao acessar diretamente o arquivo
		echo "<div class='alert alert-danger container'>
		ERRO: tentativa inválida</div>";

	}

