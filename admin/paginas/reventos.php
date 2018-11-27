
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
  <h1>Eventos</h1>
  <table class="table table-striped table-bordered">
    <thead bgcolor="#ccc">
      <tr>
        <td>ID</td>
        <td>Responsavel</td>
        <td>Data</td>
        <td>hora</td>
        <td>Local</td>
        <td>Tipo</td>
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
        $sql = "select c.id, c.responsavel, date_format(c.data, '%d-%m-%Y') data, c.hora, c.local, t.tipo from culto c inner join tipoevento t on (t.id = c.tipo) where c.data >= ? and c.data <= ? order by c.data";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $datai);
        $consulta->bindParam(2, $dataf);
        $consulta->execute();

        while ( $dados = $consulta->fetch(PDO::FETCH_OBJ ) ) {
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
          </tr>";
        }
      }

    ?>
