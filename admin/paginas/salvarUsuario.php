<?php
	if ( $_POST ) {

		//recuperar os dados do formulário
		//print_r( $_POST );
		$id    = trim( $_POST["id"] );
		$nome  = trim( $_POST["nome"] );
		$email = trim( $_POST["email"] );
		$login = trim( $_POST["login"] );
		$senha = trim( $_POST["senha"] );
        $ativo = trim( $_POST["ativo"] );
        $nivel = trim( $_POST["nivel"] );


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
		}  else if ( empty( $ativo ) ) {
			//mensagem com o javascript
			echo "<script>alert('Selecione o campo ativo');history.back();</script>";
		} else {

			//verificar se o registro já existe
			$sql = "select * from usuario
			where login = ? and id <> ? limit 1";
			$consulta = $pdo->prepare($sql);
			$consulta->bindParam(1, $login);
			$consulta->bindParam(2, $id);
			$consulta->execute();
			$dados = $consulta->fetch(PDO::FETCH_OBJ);

			if ( !empty( $dados->id ) ) {
				//já existe um registro cadastrado
				echo "<script>alert('Já existe um cadastro com este Login');history.back();</script>";
				exit;

			}

			//criptografar senha se não estiver vazia
			if ( ! empty ( $senha ) ) $senha = md5( $senha );

			//verificar se o id esta vazio - insert
			if ( empty ( $id ) ) {
				//gravar no banco de dados
				$sql = "insert into usuario (id, nome, email, login, senha, ativo, nivel)
				values (NULL, ? , ?, ?, ?, ?, ? )";
				$consulta = $pdo->prepare($sql);
				//passar o parametro
				$consulta->bindParam(1, $nome);
				$consulta->bindParam(2, $email);
				$consulta->bindParam(3, $login);
				$consulta->bindParam(4, $senha);
                $consulta->bindParam(5, $ativo);
                $consulta->bindParam(6, $nivel);
			} else {
				
				if ( empty ( $senha ) ) {
					//dar update
					$sql = "update usuario 
						set nome = ? , email = ?, login = ?, ativo = ?, nivel = ?
						where id = ? 
						limit 1";
					$consulta = $pdo->prepare( $sql );
					$consulta->bindParam( 1, $nome );
					$consulta->bindParam( 2, $email);
					$consulta->bindParam( 3, $login );
                    $consulta->bindParam( 4, $ativo );
                    $consulta->bindParam( 5, $nivel );
					$consulta->bindParam( 6, $id );
				} else {
					//dar update
					$sql = "update usuario 
						set nome = ? , email = ?, login = ?, ativo = ?, senha = ?, nivel = ?
						where id = ? 
						limit 1";
					$consulta = $pdo->prepare( $sql );
					$consulta->bindParam( 1, $nome );
					$consulta->bindParam( 2, $email);
					$consulta->bindParam( 3, $login );
					$consulta->bindParam( 4, $ativo );
                    $consulta->bindParam( 5, $senha );
                    $consulta->bindParam( 6, $nivel );
					$consulta->bindParam( 7, $id );
				}

			}

			//verificar se executou corretamente
			if ( $consulta->execute() ) {

				echo "<script>alert('Registro Salvo');location.href='listaUsuario';</script>";

			} else {

				echo "<script>alert('Erro ao Salvar');history.back();</script>";

			}
		}
	} else {

		//mensagem de erro ao acessar diretamente o arquivo
		echo "<div class='alert alert-danger container'>
		ERRO: tentativa inválida</div>";

	}

