
	<div class="well container">
			<ol class="breadcrumb">
         		<li class="breadcrumb-item active">Lista de Contas Estornadas</li>
       	 	</ol>

		<div class="clearfix"></div>
		<br> 
		

		<?php

			$palavra = "";
			if ( isset ( $parametro[1] ) ) $palavra = trim ( $parametro[1] );

			$palavra = "%$palavra%";

			//buscar da funcao
			$sql = "select *, date_format(data, '%d-%m-%Y') data, date_format(dataPagamento, '%d-%m-%Y') dataPagamento from conta where tipo = 'e' order by descricao";
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
					<td>Motivo do Estorno</td>
					<td>Quem Estornou</td>
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
				$motivoEstorno = $dados->motivoEstorno;
				$quemEstornou  = $dados->quemEstornou;

				$valor = number_format( $valor , 2 , "," , "." );
				$valorPago = number_format( $valorPago , 2 , "," , "." );

				echo "<tr>
					<td>$id</td>
					<td>$data</td>
					<td>$descricao</td>
					<td>R$ $valor</td>
					<td>R$ $valorPago</td>
					<td>$dataPagamento</td>
					<td>$motivoEstorno</td>
					<td>$quemEstornou</td>
				</tr>";

			}

			?>
		</table>
	

	</div>
	








