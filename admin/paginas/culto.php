<?php

	$id = $responsavel = $data = $hora = $local = $tipo = "";

	//verificar se está editando
	if ( isset ( $_GET["id"] ) ) {

		//recuperar o id por get
		$id = trim( $_GET["id"] );
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
		$data        = $dados->data;
		$hora        = $dados->hora;
		$local       = $dados->local;
		$tipo        = $dados->tipo;
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
								    	<input type="text" class="form-control col-sm-3" id="calendario">
								    </div>	
								    </div>

								    <div class="control-group">
										<label for="hora">Hora:</label>
										<div class="controls">
											<input type="text" name="hora"
											class="form-control col-sm-3" id="hora"
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
										<label for="tipo">Tipo:</label>
										<div class="controls">
											<select	name="tipo"
												class="form-control"
												required>
												<option value="">Selecione o Tipo</option>
												<option value="culto">culto</option>
												<option value="evento">evento</option>
												<option value="casamento">casamento</option>
												</select>
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

