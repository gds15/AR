
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
      $mes = $_POST["mes"];

      // verificar se a data final e menor que a inicial
      if ( $mes > '12') {
        echo "<script>alert('O mes não pode ser maior que 12');history.back();</script>";
      } else {
        $sql = "SELECT SUM(valorPago) AS vp FROM conta WHERE mes = ?";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $mes);
        $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        $vp = $dados->vp;

        //echo "$vp";

        //echo "<br>";

        $sql2 = "SELECT SUM(valor) AS vd FROM dizimo WHERE mes = ?";

        $consulta2 = $pdo->prepare($sql2);
        $consulta2->bindParam(1, $mes);
        $consulta2->execute();
        $dados2 = $consulta2->fetch(PDO::FETCH_OBJ);

        $vd = $dados2->vd;

        //echo "$vd";


        $lucro = $vd - $vp;

        //echo "<br>";

        //echo "$lucro";
 
      }

    ?>

    <h1>Entradas e Saidas</h1>

    <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">Mes</th>
      <th scope="col">Entradas</th>
      <th scope="col">Saidas</th>
      <th scope="col">Lucros</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?=$mes;?></td>
      <td><?=$vd;?></td>
      <td><?=$vp;?></td>
      <td><?=$lucro;?></td>
    </tr>
  </tbody>
</table>
