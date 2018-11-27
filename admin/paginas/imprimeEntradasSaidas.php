
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
      if ( $mes > 12) {
        echo "<script>alert('O mes não pode ser maior que 12');history.back();</script>";
      } else {
        $sql = "SELECT SUM(valorPago) FROM conta WHERE mes = ?";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $mes);
        $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_OBJ



        
      }

    ?>
