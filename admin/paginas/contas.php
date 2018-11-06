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
								    	<input type="text" class="form-control col-sm-3" id="calendario">
								    </div>	
								    </div>

								     <div class="control-group">
								    <label for="calendario">Data Pagamento:</label>
								    <div class="controls">
								    	<input type="text" class="form-control col-sm-3" id="calendario">
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
										<label for="valor pago">Valor Pago:</label>
										<div class="controls">
											<input type="text" name="valor pago"
											class="form-control" id="valor pago"
											value="<?=$valorPago;?>">
										</div>
									</div>

									<div class="control-group">
										<label for="multa">Multa/Juros:</label>
										<div class="controls">
											<input type="text" name="multa"
											class="form-control" id="multa"
											value="<?=$multaJuros;?>">
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