<div class="container py-1">
    <div class="row">
        <div class="mx-auto col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Relatórios de Entradas e Saidas</h4>
                        </div>
                        <div class="card-body">
	                        <form name="form1" method="post" action="imprimeEntradasSaidas" novalidate>
								<fieldset>
									<legend>Informe o mes:</legend>

									<label for="mes">Mes</label>
									<input type="text" name="mes" class="form-control col-sm-2" required data-mask="99">
									
	
								    <br>
									<button type="submit" class="btn btn-outline-primary">Buscar</button>

									
                               


								</fieldset>
							</form>
                        </div>
                    </div>
        </div>
    </div>
</div>