<?php


	$id = $nome = $funcao_id = $cpf = $funcao_id = $email = $datanascimento =  $telefone = $endereco = $cidade = $estado = $bairro = $cep =  "";

	
	//VERIFICAR SE ESTA EDITANDO
	if ( isset ($_GET["id"] ) ) {

		//RECUPERAR ID POR GET
		$id = trim ( $_GET["id"] );
		//SELECIONAR OS DADOS DO BANCO
		$sql = "select *, from membro where id = ? limit 1";
		//PREPARE
		$consulta = $pdo->prepare($sql);
		//PASSAR UM PARAMETRO
		$consulta->bindParam(1, $id);
		//EXECUTA
		if ( !$consulta->execute() ) {
			//trazer uma mensagem de erro
			echo $consulta->errorInfo()[2];

		} else {
			$dados = $consulta->fetch(PDO::FETCH_OBJ);
			$id = $dados->id;
			$nome = $dados->nome;
			$funcao_id = $dados->funcao_id;
			$cpf = $dados->cpf;
			$datanascimento = $dados->dt;
			$email = $dados->email;
			$telefone = $dados->telefone;
			$endereco = $dados->endereco;
			$cidade = $dados->cidade; 
			$estado = $dados->estado;
			$bairro = $dados->bairro;
			$cep = $dados->cep;
			$foto = $dados->foto;
		}

	}


?>
<div class="container py-1">
    <div class="row">
        <div class="mx-auto col-sm-12">
                    <!-- form funcao -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Cadastro de Membros</h4>
                        </div>
                        <div class="card-body">
                        <form name="form1" method="post" 
						action="salvarMembro" 
						enctype="multipart/form-data"
						novalidate>

			<div class="control-group">
				<label for="id">ID:</label>
				<div class="controls">
					<input type="text" readonly 
					name="id" id="id" 
					class="form-control"
					value="<?=$id;?>">
				</div>
			</div>

			<div class="control-group">
				<label for="nome">Nome:</label>
				<div class="controls">
					<input type="text" name="nome"
					required data-validation-required-message="Preencha seu nome completo"
					class="form-control"
					placeholder="Nome Completo"
					value="<?=$nome;?>">
				</div>
			</div>

			<div class="control-group">
				<label for="funcao_id">
				Selecione a Função:
				</label>
				<div class="controls">
					<select name="funcao_id"
					class="form-control"
					required id="funcao_id"
					data-validation-required-message="Selecione uma Função">
						<option value="">
							Selecione uma Função
						</option>
						<?php
						//selecionar as funcaos
						$sql = "select * from funcao order by funcao";
						//preparar o sql e executar
						$consulta = $pdo->prepare($sql);
						$consulta->execute();

						while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {

							$id = $dados->id;
							$funcao = $dados->funcao;

							echo "<option value='$id'>$funcao</option>";

						}
						?>
					</select>
					<script type="text/javascript">
						$("#funcao_id").val('<?=$funcao_id;?>');
					</script>
				</div>
			</div>

			<div class="control-group">
				<label for="email">E-mail:</label>
				<div class="controls">
					<input type="email" name="email"
					required data-validation-required-message="Preencha seu e-mail"
					data-validation-email-message="Digite um e-mail válido"
					class="form-control"
					placeholder="E-mail válido"
					value="<?=$email;?>">
				</div>
			</div>

			<div class="control-group">
				<label for="cpf">CPF:</label>
				<div class="controls">
					<input type="text" name="cpf"
					id="cpf" required
					data-validation-required-message="Preencha seu CPF" class="form-control" placeholder="Digite somente número"
					data-mask="999.999.999-99"
					value="<?=$cpf;?>" onblur="verificaCpf(this.value)">

					<div id="msgcpf"></div>
				</div>
			</div>

			<div class="control-group">
				<label for="datanascimento">Data de Nascimento:</label>
				<div class="controls">
					<input type="text" name="datanascimento" 
					id="datanascimento" 
					required
					data-validation-required-message="Digite sua data de nascimento"
					data-mask="99/99/9999"
					onblur="verificaData(this.value)"
					placeholder="Data Nascimento"
					value="<?=$datanascimento;?>"
					class="form-control">
				</div>
			</div>

			<div class="control-group">
				<label for="telefone">Telefone:</label>
				<div class="controls">
					<input type="text" name="telefone"
					required
					data-validation-required-message="Digite um telefone"
					data-mask="(99) 9999-9999?9"
					placeholder="Telefone"
					value="<?=$telefone;?>"
					class="form-control">
				</div>
			</div>

			<div class="control-group">
				<label for="nome">Endereço:</label>
				<div class="controls">
					<input type="text" name="endereco"
					required data-validation-required-message="Preencha seu Endereço"
					class="form-control"
					placeholder="Endereço"
					value="<?=$endereco;?>">
				</div>
			</div>

			<div class="control-group">
				<label for="nome">Cidade:</label>
				<div class="controls">
					<input type="text" name="cidade"
					required data-validation-required-message="Preencha sua Cidade"
					class="form-control"
					placeholder="Cidade"
					value="<?=$cidade;?>">
				</div>
			</div>

			<div class="control-group">
				<label for="nome">Estado:</label>
				<div class="controls">
					<select	name="estado"
						class="form-control"
						required
						data-validation-required-message="Selecione o Estado"
						placeholder="Selecione o Estado">
							<option value=""></option>
							<option value="ac">Acre</option>
							<option value="al">Alagoas</option>
							<option value="ap">Amapá</option>
							<option value="al">Bahia</option>
							<option value="al">Ceará</option>
							<option value="al">Distrito Federal</option>
							<option value="al">Espirito Santo</option>
							<option value="al">Goiás</option>
							<option value="al">Maranhão</option>
							<option value="al">Mato Grosso</option>
							<option value="al">Mato Grosso do Sul</option>
							<option value="al">Minas Gerais</option>
							<option value="al">Pará</option>
							<option value="al">Paraíba</option>
							<option value="al">Paraná</option>
							<option value="al">Pernambuco</option>
							<option value="al">Piauí</option>
							<option value="al">Rio de Janeiro</option>
							<option value="al">Rio Grande do Norte</option>
							<option value="al">Rio Grande do Sul</option>
							<option value="al">Rondônia</option>
							<option value="al">Rondônia</option>
							<option value="al">Roraima</option>
							<option value="al">Santa Catarina</option>
							<option value="al">Sergipe</option>
							<option value="al">Tocantins</option>			

						</select>
					</div>

				
			<div class="control-group">
				<label for="nome">Bairro:</label>
				<div class="controls">
					<input type="text" name="bairro"
					required data-validation-required-message="Preencha seu Bairro"
					class="form-control"
					placeholder="Bairro"
					value="<?=$bairro;?>">
				</div>
			</div>

			
			<div class="control-group">
				<label for="cep">Cep:</label>
				<div class="controls">
					<input type="text" name="cep"
					placeholder="CEP"
					required
					data-validation-required-message="Digite um Cep Valido"
					data-mask="99999-999"
					value="<?=$cep;?>"
					class="form-control">
				</div>
			</div>

			<br>

			<button type="submit" class="btn btn-outline-primary"><i class="fas fa-save"></i> Salvar</button>

			<script type="text/javascript">
				function verificaCpf(cpf) {
					//console.log( cpf );
					//mostrar a mascara
					$("#mascara").show();

					id = $("#id").val();

					if ( cpf == "___.___.___-__" ) {

						alert("Preencha o CPF");
						$("#cpf").focus();


					} else {

						$.get("verificaCpf.php",
						{cpf:cpf, id:id},
						function(dados) {
							if ( dados != "ok" ) {
								alert( dados );
								//focar no campo

								$("#cpf").focus();
								$("#cpf").val("");
							}
							
						})
					}
					$("#mascara").hide();
				}

				//funcao para verificar a data
				function verificaData( data ) {
					//mostrar a mascara
					$("#mascara").show("fast");

					if ( data != "") {
						//ajax
						$.get("data.php",
							{data:data},
							function(dados){

							if ( dados != "ok" ) {
								alert(dados);
								$("#datanascimento").focus();
								$("#datanascimento").val('');
							}
						})
					}
					$("#mascara").hide("fast");
				}
			</script>

                        </div>
                    </div>
        </div>
    </div>
</div>






