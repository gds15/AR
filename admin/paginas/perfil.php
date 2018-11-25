<?php
   		$id = $_SESSION["admin"]["id"];
		
		//selecionar os dados do banco
		$sql = "select * from usuario where id = ? limit 1";
		//prepare
		$consulta = $pdo->prepare( $sql );
		//passar um parametro
		$consulta->bindParam( 1, $id );
		//executa
		$consulta->execute();
		//separar os dados
		$dados = $consulta->fetch(PDO::FETCH_OBJ);

		$id    = $dados->id;
		$email = $dados->email;
		$nome  = $dados->nome;
		$login = $dados->login;
		$ativo = $dados->ativo;
		$nivel = $dados->nivel;
?>


<div class="container py-1">
    <div class="row">
        <div class="mx-auto col-sm-12">
                    <!-- form usuario -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Perfil do Usuario</h4>
                        </div>
                        <div class="card-body">
                        <form name="formcadastro" method="post" action="salvarPerfil" novalidate>
			<fieldset>
				<legend>Informações da Conta:</legend>

				<div class="control-group">
					<label for="id">ID:</label>
					<div class="controls">
						<input type="text" name="id"
						class="form-control" id="id"
						readonly
						value="<?=$id;?>">
					</div>
				</div>

				<div class="control-group">
					<label for="nome">
					Nome do Usuário:</label>
					<div class="controls">
						<input type="text" 
						name="nome"
						class="form-control"
						required
						data-validation-required-message="Preencha o nome completo"
						value="<?=$nome;?>">
					</div>
				</div>

				<div class="control-group">
					<label for="email">
					E-mail do Usuário:</label>
					<div class="controls">
						<input type="text" 
						name="email"
						class="form-control"
						required
						data-validation-required-message="Preencha o e-mail"
						value="<?=$email;?>">
					</div>
				</div>

				<div class="control-group">
					<label for="login">
					Login do Usuário:</label>
					<div class="controls">
						<input type="text" 
						name="login" id="loginusuario"
						class="form-control"
						required onblur="verificaLogin(this.value)"
						data-validation-required-message="Preencha o login"
						readonly
						value="<?=$login;?>">
					</div>
				</div>

				<div class="control-group">
					<label for="senha">
					Senha:</label>
					<div class="controls">
						<input type="password" 
						name="senha"
						class="form-control"
						<?php if ( empty ( $senha ) ) echo "required data-validation-required-message='Preencha a senha' "; ?>
						
						>
					</div>
				</div>

				<div class="control-group">
					<label for="senha">
					Re-digite a Senha:</label>
					<div class="controls">
						<input type="password" 
						class="form-control"
						data-validation-match-match="senha"
						data-validation-match-message="As senhas digitadas são diferentes"
						>
					</div>
				</div>

                <br>

				<button type="submit" class="btn btn-outline-primary"><i class="fas fa-save"></i> Atualizar</button>

				<a href='excluirPerfil' class='btn btn-outline-danger'><i class='fa fa-trash'></i></a>

				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajudaPerfil">
				  AJUDA!!!
				</button>

			</fieldset>
		</form>
             	</div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
		//funcao para verificar o login 
		function verificaLogin( login ) {
			//mostrar a mascara
			$("#mascara").show("fast");

			id = $("#id").val();

			if ( login != "") {
				//ajax
				$.get("paginas/login.php",
					{login:login,id:id},
					function(dados){

					if ( dados != "ok" ) {
						alert(dados);
						$("#loginusuario").focus();
						$("#loginusuario").val('');
					}
				})
			}
			$("#mascara").hide("fast");
		}
	</script>

</div>