<?php

	$id = $membro = $data = $mes = $valor = $desc = "";
	$data = date("d-m-Y");
	///teste $mes = date("m");


	//verificar se está editando
	if ( isset ($parametro[1] ) ) {

		//recuperar o id por get
		$id = trim( $parametro[1] );
		//selecionar os dados do banco
		$sql = "select *, date_format(data, '%d-%m-%Y') data from dizimo where id = ? limit 1";
		//prepare
		$consulta = $pdo->prepare( $sql );
		//passar um parametro
		$consulta->bindParam( 1, $id );
		//executa
		$consulta->execute();
		//separar os dados
		$dados = $consulta->fetch(PDO::FETCH_OBJ);

		$id     = $dados->id;
		$membro = $dados->membro;
		$data   = $dados->data;
		$valor  = $dados->valor;
		
	}
?>
<div class="container py-1">
    <div class="row">
        <div class="mx-auto col-sm-12">
                    <!-- form usuario -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Dizimos</h4>
                        </div>
                        <div class="card-body">
	                        <form name="formcadastro" method="post" action="salvarDizimo" novalidate>
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
									Membro:
									</label>
									<div class="controls">
										<select name="membro"
										class="form-control"
										required id="membro"
										data-validation-required-message="Selecione o Membro">
											<option value="<?=$membro;?>">Selecione o Memnbro</option>
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
											$("#membro").val('<?=$membro;?>');
										</script>
									</div>
								    </div>

								    <div class="control-group">
								    <label for="calendario">Data:</label>
								    <div class="controls">
								    	<input type="text" name="data" class="form-control col-sm-3" readonly  value="<?=$data;?>">
								    </div>	
								    </div>

								    <div class="control-group">
										<label for="valor">Valor:</label>
										<div class="controls">
											<input type="text" name="valor"
											class="form-control col-sm-3" id="valor"
											data-validation-required-message="Informe o valor"			
											value="<?=$valor;?>">
										</div>
									</div>

									<div class="control-group">
										<label for="desc">Descrição:</label>
										<div class="controls">
											<input type="text" name="desc"
											class="form-control" id="desc"
											data-validation-required-message="Informe a Descrição"	
											value="<?=$desc;?>">
										</div>
									</div>

									 
	
								    <br>
									<button type="submit" class="btn btn-outline-primary"><i class="fas fa-save"></i> Salvar</button>

									<!-- Button trigger modal -->
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajudaDizimos">
								  AJUDA!!!
								</button>
                               


								</fieldset>
							</form>
                        </div>
                    </div>
        </div>
    </div>
</div>
