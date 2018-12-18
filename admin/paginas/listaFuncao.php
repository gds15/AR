
	<div class="well container">
			<ol class="breadcrumb">
         		<li class="breadcrumb-item active">Lista de Funções</li>
       	 	</ol>

		<a href="funcao" title="Cadastro de admin" class="btn btn-outline-success pull-right">
			<i class="fa fa-file"></i>
			Novo Cadastro
		</a>

		<div class="clearfix"></div>
		<br> 
	

		<?php

			$palavra = "";
			if ( isset ( $_GET["palavra"] ) ) $palavra = trim ( $_GET["palavra"] );

			$palavra = "%$palavra%";

			//buscar da funcao
			$sql = "select * from funcao where funcao like ? and ativo = 's' order by funcao";
			$consulta = $pdo->prepare($sql);
			$consulta->bindParam(1, $palavra);
			//executar o sql
			$consulta->execute();

			//conta as linhas de resultado
			$conta = $consulta->rowCount();

			echo "<p>Foram encontrados $conta 
			Registros:</p>";

		?>

		<table id="tabela" class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<td width="10%">ID</td>
					<td>Função</td>
					<td width="15%">Opções</td>
				</tr>
			</thead>
			<?php

			while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

				//separar os dados do banco de dados
				$id     = $dados->id;
				$funcao = $dados->funcao;

				echo "<tr>
					<td>$id</td>
					<td>$funcao</td>
					<td>
						<a href='funcao/$id'
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
				location.href = "excluirFuncao/"+id;
			}
		}

		$(document).ready( function(){
			//aplicar o dataTable na tabela
			$("#minhaTabela").dataTable({
				"language": {
		            "lengthMenu": "Mostrando _MENU_ registros por página",
		            "zeroRecords": "Nenhum dado encontrado - sorry",
		            "info": "Mostrando _PAGE_ de _PAGES_",
		            "infoEmpty": "Nenhum dado",
		            "infoFiltered": "(filtrado de _MAX_ total)",
		            "search": "Busca: ",
		            "paginate": {
				      "previous": "Anterior",
				      "next": "Próxima"
				    }
		        }
			});
		})
	</script>








