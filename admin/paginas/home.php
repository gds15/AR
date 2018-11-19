<h2 id="homeContas">Contas que Vencem Hoje</h2>
<hr>
       
	<div class="container row">
        <?php
        	  $dt = date("Y-m-d");

              $sql = "select *, date_format(data, '%d-%m-%Y') data from conta where data like ? order by descricao";
              $consulta = $pdo->prepare($sql);
              $consulta->bindParam(1, $dt);
              $consulta->execute();

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
                  </div>

             
        <?php
            }
        ?>

    </div>
            

            