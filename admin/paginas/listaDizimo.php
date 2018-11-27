
	<div class="well dizimoiner">
			<ol class="breadcrumb">
         		<li class="breadcrumb-item active">Lista de dizimo</li>
       	 	</ol>

		<a href="dizimo" title="Cadastro de admin" class="btn btn-outline-success pull-right">
			<i class="fa fa-file"></i>
			Novo Cadastro
		</a>

		<div class="clearfix"></div>
		<br> 
		<form name="formpesquisa" method="get"
		class="form-inline text-center">
			<label for="palavra">Palavra-chave:
			<input type="text" name="palavra"
			required placeholder="Digite uma palavra"
			class="form-control">
			</label>
			<button type="submit" class="btn btn-outline-success">
				<i class="fa fa-search">
				</i>
			</button>
		</form>

		<?php

			$palavra = "";
			if ( isset ( $_GET["palavra"] ) ) $palavra = trim ( $_GET["palavra"] );

			$palavra = "%$palavra%";

			//buscar da funcao
			$sql = "select *, date_format(data, '%d-%m-%Y') data from dizimo";
			$consulta = $pdo->prepare($sql);
			$consulta->bindParam(1, $palavra);
			//executar o sql
			$consulta->execute();

			//dizimo as linhas de resultado
			$dizimo = $consulta->rowCount();

			echo "<p>Foram encontrados $dizimo 
			Registros:</p>";

		?>
		
		
		<table class="table-dark table-striped table table-bordered">
			<thead>
				<tr>
					<td width="10%">ID</td>
					<td>membro</td>
					<td>Valor</td>
					<td>descrição</td>
					<td>data</td>
					<td width="15%">Opções</td>
				</tr>
			</thead>
			<?php
			//mostrar os resultados da busca
			while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

				//separar os dados do banco de dados
				$id     = $dados->id;
				$membro = $dados->membro;
				$valor  = $dados->valor;
				$desc   = $dados->desc;
				$data  = $dados->data;
			

				echo "<tr>
					<td>$id</td>
					<td>$membro</td>
					<td>$valor</td>
					<td>$desc</td>
					<td>$data</td>
					<td>
						<a href='dizimo/$id'
						class='btn btn-outline-primary'>
							<i class='fas fa-pen-square'></i>
						</a>
						
					<a href='javascript:deletar($id)' 
						class='btn btn-outline-danger'>
							<i class='fa fa-trash'></i>
						</a>
					</td>
				</tr>";

			}

			?>
		</table>
	

	</div>
	<script type="text/javascript">
		//funcao para perguntar se quer deletar
		function deletar(id) {
			if ( confirm("Deseja mesmo excluir?") ) {
				//enviar o id para uma página
				location.href = "excluirDizimo/"+id;
			}
		}
	</script>








