<div class="container py-1">
    <div class="row">
        <div class="mx-auto col-sm-12">
                    <!-- form usuario -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Relatórios de Entradas e Saidas</h4>
                        </div>
                        <div class="card-body">
	                        <form name="form1" method="post" action="imprimeEntradasSaidas" novalidate>
								<fieldset>
									<legend>Informe as Datas:</legend>

									<label for="datai">Data Inicial</label>
									<input type="text" name="datai" class="form-control col-sm-3" required data-mask="99-99-9999">
									<label>Data Final</label>
									<input type="text" name="dataf" class="form-control col-sm-3" required data-mask="99-99-9999">
	
								    <br>
									<button type="submit" class="btn btn-outline-primary">Buscar</button>

									
                               


								</fieldset>
							</form>
                        </div>
                    </div>
        </div>
    </div>
</div>