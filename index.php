<?php
  include "config/conecta.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="tcc">
    <meta name="author" content="gds15">

    <title>ARSYSTEM</title>

    <!-- Bootstrap CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'> 
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
    <!-- css apenas dessa pg de visitantes -->
    <link href="css/indexVisit.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Nav -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">ARSYSTEM</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#page-top">HOME</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#sobre">Sobre</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#eventos">Eventos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#midias">Midias</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contato">Contato</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Fim do nav -->

    <!-- Pg inicial-->
    <header class="masthead text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <strong>ARSYSTEM</strong>
            </h1>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5">BRASIL ACIMA DE TUDO E DEUS ACIMA DE TODOS</p>
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="#sobre">Ver Mais</a>
          </div>
        </div>
      </div>
    </header>
    <!-- Fim pg inicial-->

    <section class="bg-dark" id="sobre">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">Sobre a igreja!</h2>
            <hr class="light my-4">
            <p class="text-faded mb-4">Sistema desenvolvido para controle e gerenciamento de membros e entrada e saida de valores.</p>
            <a class="btn btn-light btn-xl js-scroll-trigger" href="#page-top">Voltar</a>
          </div>
        </div>
      </div>
    </section>

    <section id="eventos">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading">Cultos/Eventos</h2>
            <hr class="my-4">

            <p class="mb-5">Nossos Ultimos Eventos!!!</p>

            <div class="container row">
              <?php

              $sql = "SELECT c.*,  date_format(c.data, '%d-%m-%Y') data, t.tipo FROM culto c inner join tipoevento t  ORDER BY id DESC LIMIT 6";
              $consulta = $pdo->prepare($sql);
              $consulta->execute();

              while ( $dados = $consulta->fetch(PDO::FETCH_OBJ)) {

                $id = $dados->id;
                $data = $dados->data;
                $hora = $dados->hora;
                $local = $dados->local;
                $tipo = $dados->tipo;

                ?>

                  <div class="card" style="width: 18rem;">
                  <div class="card-header">
                   <h3>TIPO: <?=$tipo;?></h3>
                  </div>
                  <ul class="list-group list-group-flush">
                  <li class="list-group-item">Data: <?=$data;?></li>
                  <li class="list-group-item">Hora: <?=$hora;?></li>
                  <li class="list-group-item">Local: <?=$local;?></li>
                  </ul>
                  </div>

             
                  <?php
                    }
                  ?>

              </div>


           
        
 


          </div>
        </div>
      </div>
      
    </section>

    

    <section class="bg-dark text-white" id="midias">
      <div class="container text-center">
        <h2 class="mb-4">Galeria</h2>
        <a class="btn btn-light btn-xl sr-button" href="#page-top">topo!</a>
      </div>

    </div>
  </div>
</div>



      
    </section>

    <!-- Contato-->
    <section id="contato">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading">Nossos Contatos!</h2>
            <hr class="my-4">
            <p class="mb-5">Entre em contato conosco teremos o maior prazer em ajudar!</p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 ml-auto text-center">
            <i class="fas fa-phone fa-3x mb-3 sr-contact-1"></i>
            <p>(44) 3621-3700</p>
          </div>
          <div class="col-lg-4 mr-auto text-center">
            <i class="fas fa-envelope fa-3x mb-3 sr-contact-2"></i>
            <p>
              <a href="mailto:gugadellatorre@gmail.com">contato@arsystem.com.br</a>
            </p>
          </div>
        </div>
      </div>
    </section>
    <!-- Fim contato-->

    <!-- Bootstrap e JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- js especifico pg visitantes para n fica 40 linhas de js aqui-->
    <script src="js/indexVisit.js"></script>

  </body>

</html>
