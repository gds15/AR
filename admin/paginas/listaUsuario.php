<div class="content-wrapper">
		<div class="container-fluid">
	
			<ol class="breadcrumb">
         		<li class="breadcrumb-item active">Lista de Admins do Sistema</li>
       	 	</ol>

		<a href="usuario" title="Cadastro de admin" class="btn btn-outline-success pull-right">
			<i class="fa fa-file"></i>
			Novo Cadastro
		</a>

		<div class="clearfix"></div>
		<br>

		<?php
			
			//busca de admins
			$sql = "select * from usuario order by login";
			$consulta = $pdo->prepare($sql);
			//executar o sql
			$consulta->execute();

			//conta as linhas de resultado
			$conta = $consulta->rowCount();

			echo "<p>Foram encontrados $conta 
			registros:</p>";

		?>

	
		<table id="tabela" class="table table-bordered table-striped table-hover" width="100%" id="dataTable" cellspacing="0">
			<thead>
				<tr>
					<td>ID</td>
					<td>Login</td>
					<td>Ativo</td>
					<td>Tipo de Acesso</td>
					<th>Opções</th>
				</tr>
			</thead>
			 
			<?php
			//mostrar os resultados da busca
			while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

				//separar os dados do banco de dados
				$id = $dados->id;
				$login = $dados->login;
				$ativo = $dados->ativo;
				$nivel = $dados->nivel;

				
				

				echo "<tbody>
					<tr>
						<td>$id</td>
						<td>$login</td>
						<td>$ativo</td>
						<td>$nivel</td>
						<td>
						<a href='usuario/$id'
						class='btn btn-outline-primary'>
							<i class='fas fa-pen-square'></i>
						</a>
						<a href='javascript:deletar($id)' 
						class='btn btn-outline-danger'>
							<i class='fa fa-trash'></i>
						</a>
						</td>
					</tr>
				</tbody>";

			}

			?>
		</table>
	
		</div>
	</div>

	<script type="text/javascript">
		//funcao para perguntar se quer deletar
		function deletar(id) {
			if ( confirm("Deseja mesmo excluir?") ) {
				//enviar o id para uma página
				location.href = "excluirUsuario/"+id;
			}
		}

		$(document).ready( function(){
		//aplicar o dataTable na tabela
		$(".table").dataTable({
			"language": {
				"lengthMenu": "Mostrando _MENU_ registros por página", "zeroRecords": "Nenhum dado encontrado - sorry",
				"info": "Mostrando _PAGE_ de _PAGES_", "infoEmpty": "Nenhum dado", "infoFiltred": "(filtrado de _MAX_ total)", "search": "Buscar: ", "paginate": {
					"previous": "Anterior", "next": "Próxima"
				}
			}
		});
	})
	</script>