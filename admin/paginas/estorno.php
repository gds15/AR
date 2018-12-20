<?php
	date_default_timezone_set('America/Sao_Paulo');

	$id = $data = $descricao = $valor = $valorPago = $dataPagamento = $motivoEstorno =  "";
	$quemEstornou = $_SESSION["admin"]["login"];

	//verificar se está editando
	if ( isset ($parametro[1] ) ) {

		//recuperar o id por get
		$id = trim( $parametro[1] );
		//selecionar os dados do banco
		$sql = "select *, date_format(data, '%d-%m-%Y') data, date_format(dataPagamento, '%d-%m-%Y') dataPagamento  from conta where id = ? limit 1";
		//prepare
		$consulta = $pdo->prepare( $sql );
		//passar um parametro
		$consulta->bindParam( 1, $id );
		//executa
		$consulta->execute();
		//separar os dados
		$dados = $consulta->fetch(PDO::FETCH_OBJ);

		$id            = $dados->id;
		$data          = $dados->data;
		$descricao     = $dados->descricao;
		$valor         = $dados->valor;
		$valorPago     = $dados->valorPago;
		$dataPagamento = $dados->dataPagamento;
		$motivoEstorno = $dados->motivoEstorno;
		$quemEstornou  = $dados->quemEstornou;

		if ($quemEstornou == "") {
			$quemEstornou = $_SESSION["admin"]["login"];
		}

		//formatar o valor - passar p formato R$
		$valor = number_format( $valor, 2, "," , ".");
		$valorPago = number_format( $valorPago, 2, "," , ".");
		
	}
?>
<div class="container py-1">
    <div class="row">
        <div class="mx-auto col-sm-12">
                    <!-- form usuario -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Estorno de Contas</h4>
                        </div>
                        <div class="card-body">
	                        <form name="formcadastro" method="post" action="salvarEstorno" novalidate>
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
								    	<input type="text" name="data" class="form-control col-sm-3" id="calendario" readonly value="<?=$data;?>">
								    </div>	
								    </div>

								    <div class="control-group">
										<label for="descricao">Descrição:</label>
										<div class="controls">
											<input type="text" name="descricao"
											class="form-control" id="descricao"
											readonly
											data-validation-required-message="Preencha a descrição"
											value="<?=$descricao;?>">
										</div>
									</div>

									<div class="control-group">
										<label for="valor">Valor:</label>
										<div class="controls">
											<input type="text" name="valor"
											class="form-control valor" id="valor"
											readonly
											data-validation-required-message="Preencha o valor"
											value="<?=$valor;?>">
										</div>
									</div>

									<div class="control-group">
									<label for="dataPagamento">Data de Pagamento:</label>
									<div class="controls">
										<input type="text" name="dataPagamento" 
										id="dataPagamento" 
										data-mask="99-99-9999"
										readonly
										value="<?=$dataPagamento;?>"
										class="form-control">
									</div>
								</div>

									<div class="control-group">
										<label for="valorPago">Valor Pago:</label>
										<div class="controls">
											<input type="text" name="valorPago"
											class="form-control valor" id="valorPago"
											readonly
											value="<?=$valorPago;?>">
										</div>
									</div>

									<hr>

									<div class="control-group">
									<label for="motivoEstorno">Motivo do Estorno:</label>
										<div class="controls">
											<input type="text" name="motivoEstorno"
											class="form-control" id="motivoEstorno"
											data-validation-required-message="o motivo do estorno"
											value="<?=$motivoEstorno;?>">
										</div>
									</div>

									<div class="control-group">
									<label for="quemEstornou">Quem Estornou:</label>
										<div class="controls">
											<input type="text" name="quemEstornou"
											class="form-control" id="quemEstornou"
											readonly
											data-validation-required-message="Preencha quem estornou"
											value="<?=$quemEstornou;?>">
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

