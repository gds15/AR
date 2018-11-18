<?php
	//iniciar a sessao
	session_start();

	if ( !isset( $_SESSION["admin"]["id"] ) ) {
		//direcionar para o index
		header( "Location: index.php" );
	}

	//incluir o arquivo para conectar no banco
	include "../config/conecta.php";

    //funcao para formatar datas
      function formatardata($data) {
        // 29/09/2017 -> 2017-09-29
        $data = explode( "-", $data );
        $data = $data[2]."-".$data[1]."-".$data[0];
        return $data;
      }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>PAINEL ADM</title>
    <!-- para funcionar a parte da edicao etc-->
    <base href="http://localhost/AR/admin/">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- Datatables CSS -->
    <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
    <!--  CSS do menu -->
    <link rel="stylesheet" href="style5.css">
    <!--datepicker-->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

    <div id="mascara">
        <img src="../img/load.gif">
        Aguarde...
    </div>

    <div class="wrapper">
        <!-- Parte lateral do menu -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>ARSYSTEM</h3>
            </div>

            <ul class="list-unstyled components">
                <p>Painel de Controle</p>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">CADASTROS</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="usuario">Usuario</a>
                        </li>
                        <li>
                            <a href="funcao">Função</a>
                        </li>
                        <li>
                            <a href="membro">Membro</a>
                        </li>
                        <li>
                            <a href="culto">Culto</a>
                        </li>
                        <li>
                            <a href="fotos">Fotos</a>
                        </li>
                        <li>
                            <a href="tipoEvento">Tipo Eventos</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">RELATÓRIOS</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="rCultos">Cultos</a>
                        </li>
                        <li>
                            <a href="dizimos">Dizimos</a>
                        </li>
                        <li>
                            <a href="outros">Função</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">LISTAGENS</a>
                    <ul class="collapse list-unstyled" id="submenu">
                        <li>
                            <a href="listaUsuario">Usuarios</a>
                        </li>
                        <li>
                            <a href="listaFuncao">Função</a>
                        </li>
                        <li>
                            <a href="listaMembros">Membros</a>
                        </li>
                        <li>
                            <a href="listaCulto">Cultos/Eventos</a>
                        </li>
                        <li>
                            <a href="listaTipoEvento">Tipos de Eventos</a>
                        </li>                      
                    </ul>
                </li>
                <li>
                    <a href="#submenupro" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Processos</a>
                    <ul class="collapse list-unstyled" id="submenupro">
                        <li>
                            <a href="dizimo">Dizimos</a>
                        </li>
                        <li>
                            <a href="contas">Contas</a>
                        </li>                      
                    </ul>
                </li>

            </ul>
        </nav>

        <!-- parte de cima do menu -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="home">Home</a>
                            </li>
                            <li class="nav-item">               	        
                                <a class="nav-link" href="sair.php"> Olá <?php echo $_SESSION["admin"]["login"];?> - Sair</a>                                                             
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <main>
            <!--aqui e para fazer as paginas clicadas no menu aparecer-->
            <?php
			//recuperar o parametro p
			if ( isset ( $_GET["p"] ) ){
				$p = $_GET["p"];
                $parametro = explode("/", $p);
                $p = $parametro[0];
				//mostrar o conteudo
				//echo $p;

			} else {
				$p = "home";
			}

            $nv = $_SESSION["admin"]["nivel"];
            //verificar se o nivel de usuario e deferente de 1 para n deixar ele entrar no cadastro de usuarios
            if ($p == "usuario" && $nv == "2") {
                //se for o nivel 2 ele abre a pg nv.php
                include "paginas/nv.php";

            } else if ( $p == "funcao" && $nv == "2") {
                //se for o nivel 2 ele abre a pg nv.php
                include "paginas/nv.php";

            } else { //se for 1 vai fazer o processo normalmente

                //aqui a var pagina vai receber o nome pasta com as paginas mais o nome da variavel p 
                $pagina = "paginas/".$p.".php";
            
                //verificar se a pagina existe
                if ( file_exists( $pagina ) ) {
                    include $pagina;
                } else {
                    include "paginas/404.php";
                }
            }
			?>
            <!--final das paginas-->
           </main>
        </div>
    </div>



    <!-- Modal contas -->
    <div class="modal fade" id="ajuda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Ajuda Contas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Aqui você pode cadastrar tanto contas ja pagas como contasque ainda ira pagar.
            Para cadastrar uma conta já paga e simples basta informar a data do vencimento, 
            a descrição o valor da conta e o valor pago, ja o multa/juros e so preenchido 
            se a conta foi paga com atraso pois usamos essa informação para gerar o relatorio ,
            de contas pagas com atraso ou em dia.
            Já no cadastro de contas que ainda esta para vencer e simples também basta informar
            a data do vencimento, o valor e a descrição e salvar, na home sera mostradas as contas
            que ira vencer por primeiro. 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>
    <!--fim modal contas-->

    <!-- Modal usuario -->
    <div class="modal fade" id="ajudaUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Ajuda Usuarios</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            estes usuarios cadastrados aqui seram os responsaveis pelo sistema, e não os membros da igreja,
            os membros da igreja seram cadastrados na parte do cadastro de membros.  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>
    <!--fim modal usuarios-->

    <!-- Modal membros -->
    <div class="modal fade" id="ajudaMembro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Ajuda Membros</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            nesta tela seram cadastrados os membros da igreja, estes não poderam entrar no sistema.  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>
    <!--fim modal membros-->

    <!-- Modal funcao -->
    <div class="modal fade" id="ajudaFuncao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Ajuda Função</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            nesta tela seram cadastrados as funções que os membros possuirão  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>
    <!--fim modal funcao-->

    <!-- Modal culto -->
    <div class="modal fade" id="ajudaCulto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Ajuda Culto/Eventos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            nesta tela sera cadastrados os eventos ou cultos do dia ou semana.  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>
    <!--fim modal culto-->

    <!-- Modal tipo evento -->
    <div class="modal fade" id="ajudaTipoE" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Ajuda Tipo de Eventos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            nesta tela sera cadastrado os tipos de eventos que podem ser escolhidos na tela de cadastro de cultos.  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>
    <!--fim modal tipo evento-->

    

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!--datepicker-->
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
    <!-- Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script src="../js/dataTables.bootstrap4.min.js"></script>
    <!-- maskMoney -->
    <script type="text/javascript" src="../js/jquery.maskMoney.min.js"></script>

    <script type="text/javascript" src="../js/bootstrap-inputmask.min.js"></script>

    <script type="text/javascript" src="../js/jqBootstrapValidation.js"></script>
   

    <script type="text/javascript"
  src="../js/summernote.min.js"></script>
  <script type="text/javascript"
  src="../lang/summernote-pt-BR.js"></script>

    <script type="text/javascript">
          $(document).ready(function () {
              $('#sidebarCollapse').on('click', function () {
                  $('#sidebar').toggleClass('active');
                  $(this).toggleClass('active');
              });
          });

          $(function() {
              $("#calendario").datepicker({dateFormat: 'dd-mm-yy',
              dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
              dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
              dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
              monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
              monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],showOn: "button",
              buttonImage: "../img/calendario.png",
              buttonImageOnly: true});
          });
          $("#mascara").fadeOut("slow", function(){
          $("#mascara").hide();
          $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); 
          //colocar a máscara nos campos .valor - classes
          $(".valor").maskMoney({
              thousands : ".",
              decimal: ","
          });

        });
    </script>
</body>

</html>
