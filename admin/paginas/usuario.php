<?php
    $id = $email = $nome = $login = $ativo = $nivel = "";

	//verificar se está editando
	if ( isset ( $_GET["id"] ) ) {

		//recuperar o id por get
		$id = trim( $_GET["id"] );
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

		$id = $dados->id;
		$email = $dados->email;
		$nome = $dados->nome;
		$login = $dados->login;
		$ativo = $dados->ativo;


	}
?>


<div class="container py-1">
    <div class="row">
        <div class="mx-auto col-sm-12">
                    <!-- form usuario -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Cadastro de Usuario</h4>
                        </div>
                        <div class="card-body">
                            <form name="formcadastro" class="form" method="" action="salvarUsuario" role="form" novalidate>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">ID:</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" readonly type="text" value="<?=$id;?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Nome:</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" value="<?=$nome;?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Email:</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="email" value="<?=$email;?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Login:</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="loginusuario" type="text"
                                        required onblur="verificaLogin(this.value)"
						                data-validation-required-message="Preencha o login" value="<?=$login;?>">
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Senha:</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" <?php if ( empty ( $senha ) ) echo "required data-validation-required-message='Preencha a senha' "; ?>
                                         type="password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Confirmar Senha:</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" data-validation-match-match="senha"
						                data-validation-match-message="As senhas digitadas são diferentes"
                                        type="password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Ativo:</label>
                                    <div class="col-lg-9">
                                        <select id="ativo" class="form-control" size="0"
                                        required
						                data-validation-required-message="Selecione o Ativo">
                                            <option value="sim">Sim</option>
                                            <option value="nao">Não</option>
                                        </select>
                                    </div>
                                    <script type="text/javascript">
						            $("#ativo").val("<?=$ativo;?>");
					                </script>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Nivel:</label>
                                    <div class="col-lg-9">
                                        <select id="nivel" class="form-control" size="0"
                                        required
						                data-validation-required-message="Selecione o Nivel">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>
                                    <script type="text/javascript">
						            $("#nivel").val("<?=$nivel;?>");
					                </script>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9"> 
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- /form user info -->
        </div>
    </div>

    <script type="text/javascript">
		//funcao para verificar a data
		function verificaLogin( login ) {
			//mostrar a mascara
			$("#mascara").show("fast");

			id = $("#id").val();

			if ( login != "") {
				//ajax
				$.get("login.php",
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