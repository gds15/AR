
	<div class="well container">
			<ol class="breadcrumb">
         		<li class="breadcrumb-item active">Lista de Contas</li>
       	 	</ol>

		<a href="contas" title="Cadastro de admin" class="btn btn-outline-success pull-right">
			<i class="fa fa-file"></i>
			Novo Cadastro
		</a>

		<div class="clearfix"></div>
		<br> 
		

		<?php

			$palavra = "";
			if ( isset ( $parametro[1] ) ) $palavra = trim ( $parametro[1] );

			$palavra = "%$palavra%";

			//buscar da funcao
			$sql = "select *, date_format(data, '%d-%m-%Y') data, date_format(dataPagamento, '%d-%m-%Y') dataPagamento from conta where ativo = 's' order by descricao";
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
					<td>Data</td>
					<td>Descrição</td>
					<td>Valor</td>
					<td>Valor Pago</td>
					<td>data Pagamento</td>
					<td width="15%">Opções</td>
				</tr>
			</thead>
			<?php
			//mostrar os resultados da busca
			while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

				//separar os dados do banco de dados
				$id            = $dados->id;
				$data          = $dados->data;
				$descricao     = $dados->descricao;
				$valor         = $dados->valor;
				$valorPago     = $dados->valorPago;
				$dataPagamento = $dados->dataPagamento;

				$valor = number_format( $valor , 2 , "," , "." );
				$valorPago = number_format( $valorPago , 2 , "," , "." );

				echo "<tr>
					<td>$id</td>
					<td>$data</td>
					<td>$descricao</td>
					<td>R$ $valor</td>
					<td>R$ $valorPago</td>
					<td>$dataPagamento</td>
					<td>
						<a href='contas/$id'
						class='btn btn-outline-primary'>
							<i class='fas fa-pen-square'></i>
						</a>
						
						<a href='javascript:deletar($id)' 
						class='btn btn-outline-danger'>
							<i class='fa fa-trash'></i>
						</a>

						<a href='estorno/$id'
						class='btn btn-outline-primary'>
							<i class='fas fa-undo-alt'></i>
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
				location.href = "excluirConta/"+id;
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








