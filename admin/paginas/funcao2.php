<?php
	

	$id = $funcao = "";

	//verificar se está editando
	if ( isset ( $_GET["id"] ) ) {

		//recuperar o id por get
		$id = trim( $_GET["id"] );
		//selecionar os dados do banco
		$sql = "select * from funcao where id = ? limit 1";
		//prepare
		$consulta = $pdo->prepare( $sql );
		//passar um parametro
		$consulta->bindParam( 1, $id );
		//executa
		$consulta->execute();
		//separar os dados
		$dados = $consulta->fetch(PDO::FETCH_OBJ);

		$id = $dados->id;
		$funcao = $dados->funcao;
	
}


?>

<div class="container">
	<div class="well">
		<h1>Cadastro de Função</h1>

		<a href="funcao.php" 
		class="btn btn-success pull-right">
			<i class="glyphicon glyphicon-file"></i>
			Novo Cadastro
		</a>
		<a href="listarfuncao.php" 
		class="btn btn-primary pull-right">
			<i class="glyphicon glyphicon-search"></i> Listar Funções
		</a>

		<div class="clearfix"></div>

		<form name="formcadastro" method="post" action="salvarFuncao" novalidate>
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
					<label for="funcao">
					Função:</label>
					<div class="controls">
						<input type="text" 
						name="funcao"
						class="form-control"
						required
						data-validation-required-message="Preencha a funcao"
						value="<?=$funcao;?>">
					</div>
				</div>

				<button type="submit" class="btn btn-success">Salvar Dados</button>


			</fieldset>
		</form>

	</div>
</div>








