
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
  
  <table class="table table-striped table-bordered">
    <thead bgcolor="#ccc">
      <tr>
        <td>ID</td>
        <td>Data</td>
        <td>Descrição</td>
        <td>Valor</td>
        <td>Valor Pago</td>
        <td>Multa</td>
      </tr>
    </thead>

    <?php

      $datai = $_POST["datai"];
      $dataf = $_POST["dataf"];
      //formatar datas
      $datai = formatardata($datai);
      $dataf = formatardata($dataf);

      // verificar se a data final e menor que a inicial
      if ( strtotime( $datai ) > strtotime( $dataf ) ) {
        echo "<script>alert('A data inicial não pode ser maior que a data final');history.back();</script>";
      } else {
        $sql = "select *, date_format(data, '%d-%m-%Y') data from conta where valorPago <> '' order by data";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $datai);
        $consulta->bindParam(2, $dataf);
        $consulta->execute();

        while ( $dados = $consulta->fetch(PDO::FETCH_OBJ ) ) {
          $id         = $dados->id;
          $data       = $dados->data;
          $descricao  = $dados->descricao;
          $valor      = $dados->valor;
          $valorPago  = $dados->valorPago;
          $multa      = $dados->multaJuros;

          echo "<tr>
            <td>$id</td>
            <td>$data</td>
            <td>$descricao</td>
            <td>$valor</td>
            <td>$valorPago</td>
            <td>$multa</td>
          </tr>";
        }
      }

    ?>
