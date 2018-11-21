<div class="well container">
            <ol class="breadcrumb">
         		<li class="breadcrumb-item active">Lista de Membros</li>
       	 	</ol>

		<a href="membro" title="Cadastro de Membros" class="btn btn-outline-success pull-right">
			<i class="fa fa-file"></i>
			Novo Cadastro
		</a>

		<div class="clearfix"></div>

		
		<?php

			
			//buscar da categoria
			$sql = "select * from membro order by nome";
			$consulta = $pdo->prepare($sql);
			$consulta->bindParam(1, $palavra);
			//executar o sql
			$consulta->execute();

			//conta as linhas de resultado
			$conta = $consulta->rowCount();

			echo "<p>Foram encontrados $conta  Registros:</p>";

		?>

		<table class="table-dark table-striped table table-bordered">
			<thead>
				<tr>
					<td width="10%">ID</td>
					<td>Nome</td>
					<td>CPF</td>
					<td width="15%">Opções</td>
				</tr>
			</thead>
			<?php
			//mostrar os resultados da busca
			while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

				//separar os dados do banco de dados
				$id = $dados->id;
				$nome = $dados->nome;
				$cpf = $dados->cpf;

				echo "<tr>
					<td>$id</td>
					<td>$nome</td>
					<td>$cpf</td>
					<td>
						<a href='membro/$id'
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
				location.href = "excluirMembro/"+id;
			}
		}

		$(document).ready( function(){
			//aplicar o dataTable na tabela
			$(".table").dataTable({
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