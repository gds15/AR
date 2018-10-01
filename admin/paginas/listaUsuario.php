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

	
		<table class="table-dark table-striped table table-bordered" width="100%" id="dataTable" cellspacing="0">
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
						<a href='admin.php?id=$id'
						class='btn btn-outline-primary'>
							<i class='fa fa-pencil'></i>
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