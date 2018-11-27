<h2 id="homeContas">Contas que Vencem Hoje</h2>
<hr>
       
	<div class="container row">
        <?php
        	  $dt = date("Y-m-d");
        	  //pegar a hora
        	  date_default_timezone_set('America/Sao_Paulo');
			  $hora = date('H:i');
        	  
        	  

              $sql = "select *, date_format(data, '%d-%m-%Y') data from conta where data like ? and valorPago = '' order by descricao";
              $consulta = $pdo->prepare($sql);
              $consulta->bindParam(1, $dt);
              $consulta->execute();

              $conta = $consulta->rowCount();



              if (empty( $conta )) { 
              	echo "<div class='alert alert-success col-12 col-sm-12' role='alert'>
					  <h4 class='alert-heading' id='homeContas'>Sem Contas Para Hoje!!!!</h4>
					  <p>Você ainda não tem contas cadastradas com vencimento para hoje que ainda não foram pagas.</p>
					  <hr>
					  <p class='mb-0'>$hora</p>
					</div>";

          		}


            while ( $dados = $consulta->fetch(PDO::FETCH_OBJ)) {

                $id        = $dados->id;
                $data      = $dados->data;
                $descricao = $dados->descricao;
                $valor     = $dados->valor;
                

                ?>

	                  <div class="card" style="width: 18rem;">
	                  <div class="card-header">
	                   <h3>Descrição: <?=$descricao;?></h3>
	                  </div>
	                  <ul class="list-group list-group-flush">
	                  <li class="list-group-item">Data: <?=$data;?></li>
	                  <li class="list-group-item">Valor: <?=$valor;?></li>
	                  </ul>
                    <a href="contas/<?=+$id?>"
                    class='btn btn-outline-primary'>
                    <i class="fas fa-credit-card"></i>  Pagar
                    </a>
	                  </div>    
        <?php
            }
        ?>

    </div>

            

            