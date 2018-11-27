<?php

	$id = $data = $descricao = $valor = $valorPago = $multaJuros =  "";
	$data = date("d-m-Y");

	//verificar se está editando
	if ( isset ($parametro[1] ) ) {

		//recuperar o id por get
		$id = trim( $parametro[1] );
		//selecionar os dados do banco
		$sql = "select *, date_format(data, '%d-%m-%Y') data from conta where id = ? limit 1";
		//prepare
		$consulta = $pdo->prepare( $sql );
		//passar um parametro
		$consulta->bindParam( 1, $id );
		//executa
		$consulta->execute();
		//separar os dados
		$dados = $consulta->fetch(PDO::FETCH_OBJ);

		$id          = $dados->id;
		$data        = $dados->data;
		$descricao   =$dados->descricao;
		$valor       = $dados->valor;
		$valorPago   = $dados->valorPago;
		$multaJuros  = $dados->multaJuros;

		//formatar o valor - passar p formato R$
		$valor = number_format( $valor, 2, "," , ".");
		$valorPago = number_format( $valorPago, 2, "," , ".");
		$multaJuros = number_format( $multaJuros, 2, "," , ".");
	}
?>
<div class="container py-1">
    <div class="row">
        <div class="mx-auto col-sm-12">
                    <!-- form usuario -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Contas a Pagar</h4>
                        </div>
                        <div class="card-body">
	                        <form name="formcadastro" method="post" action="salvarContas" novalidate>
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
								    <label for="calendario">Data Vencimento:</label>
								    <div class="controls">
								    	<input type="text" name="data" class="form-control col-sm-3" id="calendario" value="<?=$data;?>">
								    </div>	
								    </div>

								    <div class="control-group">
										<label for="descricao">Descrição:</label>
										<div class="controls">
											<input type="text" name="descricao"
											class="form-control" id="descricao"
											value="<?=$descricao;?>">
										</div>
									</div>

									<div class="control-group">
										<label for="valor">Valor:</label>
										<div class="controls">
											<input type="text" name="valor"
											class="form-control" id="valor"
											value="<?=$valor;?>">
										</div>
									</div>

									<div class="control-group">
										<label for="valorPago">ValorPago:</label>
										<div class="controls">
											<input type="text" name="valorPago"
											class="form-control" id="valorPago"
											value="<?=$valorPago;?>">
										</div>
									</div>

									<div class="control-group">
										<label for="multa">Multa/Juros:</label>
										<div class="controls">
											<input type="text" name="multaJuros"
											class="form-control" id="multaJuros"
											value="<?=$multaJuros;?>">
										</div>
									</div>

									
	
								    <br>
									<button type="submit" class="btn btn-outline-primary"><i class="fas fa-save"></i> Salvar</button>


									<!-- Button trigger modal -->
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajuda">
									  AJUDA!!!
									</button>

								</fieldset>
							</form>
                        </div>
                    </div>
        </div>
    </div>
</div>

