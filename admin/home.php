<?php
	//iniciar a sessao
	session_start();

	if ( !isset( $_SESSION["admin"]["id"] ) ) {
		//direcionar para o index
		header( "Location: index.php" );
	}

	//incluir o arquivo para conectar no banco
	include "../config/conecta.php";

    function formatarvalor($valor) {
        $valor = str_replace( ".", "", $valor);
        //busca - valor para substituir - variavel
        
        $valor = str_replace( ",", ".", $valor);
        
        //retornar um valor
        return $valor;
    }

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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
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
                            <a href="rCultos">Eventos</a>
                        </li>
                        <li>
                            <a href="rdizimo">Todos Dizimos por data</a>
                        </li>
                        <li>
                            <a href="rContas">Contas</a>
                        </li>
                        <li>
                            <a href="rdizimo2">Dizimos por Membro e data</a>
                        </li>
                        <li>
                            <a href="entsai">Total Entradas e Saidas</a>
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
                        <li>
                            <a href="listaConta">Contas</a>
                        </li>  
                        <li>
                            <a href="listaDizimo">Dizimos</a>
                        </li>                     
                    </ul>
                </li>
                <li>
                    <a href="#submenupro" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">PROCESSOS</a>
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
                    <!--X para fechar menu-->
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
                            <li class="nav-item active">
                                <a class="nav-link" href="perfil">Perfil</a>
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

            if ($p == "contas" && $nv == "2") {
              //se o usuario for lvl 2 n pode cadastrar contas
                include "paginas/nv.php";

            }  else if ($p == "listaConta" && $nv == "2") {
                //se o nivel do usuario for 2 não vai poder ver a lista de contas
                include "paginas/nv.php";
            
            } else if ($p == "usuario" && $nv == "2") {  
                //verificar se o nivel de usuario e deferente de 1 para n deixar ele entrar no cadastro de usuarios
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

    <!--incluindo os modais das ajudas-->
    <?php
    include "modal.php"
    ?>

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
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
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

        $(document).ready( function () {
            $('#tabela').DataTable();
        } );
    </script>
</body>

</html>
