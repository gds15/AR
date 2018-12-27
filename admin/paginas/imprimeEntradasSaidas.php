
  <div class="container">

  <div class="row">
    <div class="col-md-3">
      <h1>ARSYSTEM</h1>
    </div>
    <div class="col-md-9">
      <p class="text-center">
        Av. Paraná 1681, Centro
        <br>
        Umuarama - PR
      </p>
    </div>
  </div>

    <?php
        
         $datai = $_POST["datai"];
         $dataf = $_POST["dataf"];

         $d1 = $datai;
         $d2 = $dataf;
         //formatar datas
         $datai = formatardata($datai);
         $dataf = formatardata($dataf);

        if ( strtotime( $datai ) > strtotime( $dataf ) ) {
        echo "<script>alert('A data inicial não pode ser maior que a data final');history.back();</script>";

        } else {

     
        $sql = "SELECT SUM(valorPago) AS vp FROM conta WHERE dataPagamento >= ? and dataPagamento <= ?";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $datai);
        $consulta->bindParam(2, $dataf);
        $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        $vp = $dados->vp;

        //echo "$vp";

        //echo "<br>";

        $sql2 = "SELECT SUM(valor) AS vd FROM dizimo WHERE data >= ? and data <= ?";

        $consulta2 = $pdo->prepare($sql2);
        $consulta2->bindParam(1, $datai);
        $consulta2->bindParam(2, $dataf);
        $consulta2->execute();
        $dados2 = $consulta2->fetch(PDO::FETCH_OBJ);

        $vd = $dados2->vd;

        //echo "$vd";


        $lucro = $vd - $vp;

        //echo "<br>";

        //echo "$lucro";

        $vd = number_format( $vd , 2 , "," , "." );
        $vp = number_format( $vp , 2 , "," , "." );
        $lucro = number_format( $lucro , 2 , "," , "." );

      }
 
      

    ?>

    <h1>Entradas e Saidas</h1>
    <p>De <?=$d1;?> a <?=$d2;?></p>

    <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">Entradas</th>
      <th scope="col">Saidas</th>
      <th scope="col">Lucros</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>R$ <?=$vd;?></td>
      <td>R$ <?=$vp;?></td>
      <td>R$ <?=$lucro;?></td>
    </tr>
  </tbody>
</table>
