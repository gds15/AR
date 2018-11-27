
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
        <td>Membro</td>
        <td>Valor</td>
        <td>Desc</td>
        <td>Data</td>
      </tr>
    </thead>

    <?php

      $membro = $_POST["membro"];
      $datai  = $_POST["datai"];
      $dataf  = $_POST["dataf"];
      //formatar datas
      $datai  = formatardata($datai);
      $dataf  = formatardata($dataf);

      // verificar se a data final e menor que a inicial
      if ( strtotime( $datai ) > strtotime( $dataf ) ) {
        echo "<script>alert('A data inicial não pode ser maior que a data final');history.back();</script>";
      } else {
        $sql = "select d.id, m.nome, d.valor, d.desc, date_format(d.data, '%d-%m-%Y') data from dizimo d inner join membro m on (d.membro = m.id) where m.nome = ? and d.data >= ? and d.data <= ? order by d.data";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $nome);
        $consulta->bindParam(2, $datai);
        $consulta->bindParam(3, $dataf);
        $consulta->execute();

        while ( $dados = $consulta->fetch(PDO::FETCH_OBJ ) ) {
          $id     = $dados->id;
          $nome = $dados->nome;
          $valor  = $dados->valor;
          $desc   = $dados->desc;
          $data   = $dados->data;

          echo "<tr>
            <td>$id</td>
            <td>$nome</td>
            <td>$valor</td>
            <td>$desc</td>
            <td>$data</td>
          </tr>";
        }
      }

    ?>
