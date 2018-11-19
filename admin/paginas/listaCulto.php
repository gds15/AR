
	<div class="well container">
			<ol class="breadcrumb">
         		<li class="breadcrumb-item active">Lista de Cultos/Eventos</li>
       	 	</ol>

		<a href="culto" title="Cadastro de cultos" class="btn btn-outline-success pull-right">
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

			//buscar do evento
			$sql = "select c.id, m.nome, date_format(c.data, '%d-%m-%Y') data, c.hora, c.local, t.tipo from 
			culto c inner join membro m on (c.responsavel = m.id) inner join tipoevento t on (c.tipo = t.id) ";


			$consulta = $pdo->prepare($sql);
			$consulta->bindParam(1, $palavra);
			//executar o sql
			$consulta->execute();

			//conta as linhas de resultado
			$conta = $consulta->rowCount();

			echo "<p>Foram encontrados $conta 
			Registros:</p>";

		?>
		
		
		<table class="table-dark table-striped table table-bordered">
			<thead>
				<tr>
					<td width="10%">ID</td>
					<td>Responsavel</td>
					<td>Data</td>
					<td>Hora</td>
					<td>Local</td>
					<td>Tipo</td>
					<td width="15%">Opções</td>
				</tr>
			</thead>
			<?php
			//mostrar os resultados da busca
			while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

				//separar os dados do banco de dados
				$id          = $dados->id;
				$responsavel = $dados->responsavel;
				$data        = $dados->data;
				$hora        = $dados->hora;
				$local       = $dados->local;
				$tipo        = $dados->tipo;

				echo "<tr>
					<td>$id</td>
					<td>$responsavel</td>
					<td>$data</td>
					<td>$hora</td>
					<td>$local</td>
					<td>$tipo</td>
					<td>
						<a href='culto/$id'
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
				location.href = "excluirCulto/"+id;
			}
		}
	</script>








