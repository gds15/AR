<?php

	$id = $responsavel = $data = $hora = $local = $tipo = "";
	$data = date("d/m/Y");

	//verificar se está editando
	if ( isset ($parametro[1] ) ) {

		//recuperar o id por get
		$id = trim( $parametro[1] );
		//selecionar os dados do banco
		$sql = "select * from culto where id = ? limit 1";
		//prepare
		$consulta = $pdo->prepare( $sql );
		//passar um parametro
		$consulta->bindParam( 1, $id );
		//executa
		$consulta->execute();
		//separar os dados
		$dados = $consulta->fetch(PDO::FETCH_OBJ);

		$id          = $dados->id;
		$responsavel = $dados->responsavel;
		$data        = $dados->dt;
		$hora        = $dados->hora;
		$local       = $dados->local;
		$tipo_id        = $dados->tipo_id;
	}
?>
<div class="container py-1">
    <div class="row">
        <div class="mx-auto col-sm-12">
                    <!-- form usuario -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Cadastro de Culto</h4>
                        </div>
                        <div class="card-body">
	                        <form name="formcadastro" method="post" action="salvarCulto" novalidate>
								<fieldset>
									<legend>Preencha os campos:</legend>

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
									<label for="responsavel">
									Responsavel:
									</label>
									<div class="controls">
										<select name="responsavel"
										class="form-control"
										required id="responsavel"
										data-validation-required-message="Selecione o Responsavel">
											<option value="">Selecione o Responsavel</option>
											<?php
											//selecionar todas as classes
											$sql = "select * from membro
												order by nome";
											//preparar o sql
											$consulta = $pdo->prepare($sql);
											//executar o sql
											$consulta->execute();
											//laço para pegar registro por registro
											while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
												//separar os dados
												$id = $dados->id;
												$nome = $dados->nome;
												echo "<option value='$id'>
												$nome</option>";
											}
											?>
										</select>
										<script type="text/javascript">
											$("#responsavel").val('<?=$responsavel;?>');
										</script>
									</div>
								    </div>

								    <div class="control-group">
								    <label for="calendario">Data:</label>
								    <div class="controls">
								    	<input type="text" name="data" class="form-control col-sm-3" id="calendario">
								    </div>	
								    </div>

								    <div class="control-group">
										<label for="hora">Hora:</label>
										<div class="controls">
											<input type="text" name="hora"
											class="form-control col-sm-3" id="hora"
											data-mask="99:99"
											value="<?=$hora;?>">
										</div>
									</div>

									<div class="control-group">
										<label for="local">Local:</label>
										<div class="controls">
											<input type="text" name="local"
											class="form-control" id="local"
											value="<?=$local;?>">
										</div>
									</div>

									<div class="control-group">
									<label for="tipo">
									Tipo Evento:
									</label>
									<div class="controls">
										<select name="tipo"
										class="form-control"
										required id="tipo"
										data-validation-required-message="Selecione o Tipo">
											<option value="">Selecione o Tipo</option>
											<?php
											//selecionar todas as classes
											$sql = "select * from tipoevento where ativo = 's'
												order by tipo";
											//preparar o sql
											$consulta = $pdo->prepare($sql);
											//executar o sql
											$consulta->execute();
											//laço para pegar registro por registro
											while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
												//separar os dados
												$id = $dados->id;
												$tipo = $dados->tipo;
												echo "<option value='$id'>
												$tipo</option>";
											}
											?>
										</select>
										<script type="text/javascript">
											$("#tipo").val('<?=$tipo;?>');
										</script>
									</div>
								    </div>
	
								    <br>
									<button type="submit" class="btn btn-outline-primary"><i class="fas fa-save"></i> Salvar</button>


								</fieldset>
							</form>
                        </div>
                    </div>
        </div>
    </div>
</div>

