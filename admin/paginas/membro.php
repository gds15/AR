<?php


	$id = $nome = $funcao_id = $cpf = $funcao_id = $email = $datanascimento =  $telefone = $endereco = $cidade = $estado = $bairro = $cep =  "";

	if ( isset ($parametro[1] ) ) {

	    //recuperar o id
	    $id = trim( $parametro[1] );
	    //selecionar os dados do banco
	    $sql = "select *, date_format(datanascimento,'%d/%m/%Y') datanascimento from membre where id = ? limit 1";
	    //prepare
	    $consulta = $pdo->prepare( $sql );
	    //passar um parametro
	    $consulta->bindParam( 1, $id );
	    //executa
	    $consulta->execute();
	    //separar os dados
	    $dados = $consulta->fetch(PDO::FETCH_OBJ);

	    $id 			= $dados->id;
		$nome 			= $dados->nome;
		$funcao_id 		= $dados->funcao_id;
		$cpf 			= $dados->cpf;
		$datanascimento = $dados->dt;
		$email 			= $dados->email;
		$telefone 		= $dados->telefone;
		$endereco		= $dados->endereco;
		$cidade 		= $dados->cidade; 
		$estado 		= $dados->estado;
		$bairro 		= $dados->bairro;
		$cep 			= $dados->cep;
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
                        <form name="formcadastro" method="post" action="salvarMembro" novalidate>
                            <fieldset>
                                <legend>Preencha os campos:</legend>

                                <div class="control-group">
                                    <label for="id">ID:</label>
                                    <div class="controls">
                                        <input type="text" name="id"
                                        class="form-control"
                                        readonly
                                        value="<?=$id;?>">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="nome">
                                    Nome:</label>
                                    <div class="controls">
                                        <input type="text" 
                                        name="nome"
                                        class="form-control"
                                        required
                                        data-validation-required-message="Preencha o nome"
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
											$sql = "select * from funcao where ativo = 's' order by funcao";
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
                                    <label for="email">
                                    E-mail:</label>
                                    <div class="controls">
                                        <input type="text" 
                                        name="email"
                                        class="form-control"
                                        required
                                        data-validation-required-message="Preencha o email"
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
								    <label for="calendario">Data Nascimento:</label>
								    <div class="controls">
								    	<input type="text" name="datanascimento" class="form-control col-sm-3" id="calendario" value="<?=$datanascimento;?>">
								    </div>	
								</div>

								<div class="control-group">
                                    <label for="telefone">
                                    Telefone:</label>
                                    <div class="controls">
                                        <input type="text" 
                                        name="telefone"
                                        class="form-control"
                                        required
                                        data-validation-required-message="Preencha o telefone"
                                        value="<?=$telefone;?>">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="endereco">
                                   	Endereço:</label>
                                    <div class="controls">
                                        <input type="text" 
                                        name="endereco"
                                        class="form-control"
                                        required
                                        data-validation-required-message="Preencha o Endereço"
                                        value="<?=$endereco;?>">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="bairro">
                                   	Bairro:</label>
                                    <div class="controls">
                                        <input type="text" 
                                        name="bairro"
                                        class="form-control"
                                        required
                                        data-validation-required-message="Preencha o bairro"
                                        value="<?=$bairro;?>">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="cidade">
                                   	Cidade:</label>
                                    <div class="controls">
                                        <input type="text" 
                                        name="cidade"
                                        class="form-control"
                                        required
                                        data-validation-required-message="Preencha a cidade"
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
												<option value="<?=$estado;?>"></option>
												<option value="ac">Acre</option>
												<option value="al">Alagoas</option>
												<option value="ap">Amapá</option>
												<option value="ba">Bahia</option>
												<option value="ce">Ceará</option>
												<option value="df">Distrito Federal</option>
												<option value="al">Espirito Santo</option>
												<option value="go">Goiás</option>
												<option value="ma">Maranhão</option>
												<option value="mt">Mato Grosso</option>
												<option value="ms">Mato Grosso do Sul</option>
												<option value="mg">Minas Gerais</option>
												<option value="pa">Pará</option>
												<option value="pb">Paraíba</option>
												<option value="pr">Paraná</option>
												<option value="pe">Pernambuco</option>
												<option value="pi">Piauí</option>
												<option value="rj">Rio de Janeiro</option>
												<option value="rn">Rio Grande do Norte</option>
												<option value="rs">Rio Grande do Sul</option>
												<option value="ro">Rondônia</option>
												<option value="rr">Roraima</option>
												<option value="sc">Santa Catarina</option>
												<option value="sp">São Paulo</option>
												<option value="se">Sergipe</option>
												<option value="to">Tocantins</option>			

											</select>
									</div>
								</div>

								<div class="control-group">
                                    <label for="cep">
                                   	CEP:</label>
                                    <div class="controls">
                                        <input type="text" 
                                        name="cep"
                                        class="form-control"
                                        required
                                        data-validation-required-message="Preencha o cep"
                                        data-mask="99999-999"
                                        value="<?=$cep;?>">
                                    </div>
                                </div>

                                <br>
                                
                                <button type="submit" class="btn btn-outline-primary"><i class="fas fa-save"></i> Salvar</button>


                                <!-- Button trigger modal -->
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajudaMembro">
								  AJUDA!!!
								</button>
                               

                            </fieldset>
		                </form>

                        </div>
                    </div>
        </div>
    </div>
</div>

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






