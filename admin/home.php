<?php
	//iniciar a sessao
	session_start();

	if ( !isset( $_SESSION["admin"]["id"] ) ) {
		//direcionar para o index
		header( "Location: index.php" );
	}

	//incluir o arquivo para conectar no banco
	include "../config/conecta.php";

  //funcao para formatar o valor
  function formatarvalor($valor) {
    $valor = str_replace( ".", "", $valor);
    //busca - valor para substituir - variavel
    
    $valor = str_replace( ",", ".", $valor);
    
    //retornar um valor
    return $valor;
  }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>PAINEL ADM</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!--  CSS do menu -->
    <link rel="stylesheet" href="style5.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <script>
  	$(function () { 
      //validação dos campos
  		$("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); 
      //colocar a máscara nos campos .valor - classes
      $(".valor").maskMoney({
          thousands : ".",
          decimal: ","
      });
  	} );
	</script>

</head>

<body>

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
                    </ul>
                </li>
                <li>
                    <!-- teste de outro link <a href="#">teste</a>-->
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">RELATÓRIOS</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="membros">Membros</a>
                        </li>
                        <li>
                            <a href="dizimos">Dizimos</a>
                        </li>
                        <li>
                            <a href="outros">Outros</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="pdOracoes">PEDIDOS DE ORAÇÔES</a>
                </li>
                <li>
                    <a href="contatos">CONTATOS</a>
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

    

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>
</body>

</html>