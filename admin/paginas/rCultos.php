<div class="container">
	<div class="well">
		<h1>Relatório de Cultos/Eventos</h1>

		<form name="form1" method="post" action="imprimiRculto" class="form-inline">
			<label for="datai">Data Inicial</label>
			<input type="text" name="datai" class="form-control" required data-mask="99/99/9999">
			<label>Data Final</label>
			<input type="text" name="dataf" class="form-control" required data-mask="99/99/9999">

			<button type="submit" class="btn btn-success">Buscar</button>

		</form>

	</div>
</div>