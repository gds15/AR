<!DOCTYPE html>
<html>
<head>
	<title>Login-Administração</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap-inputmask.min.js"></script>
	<script type="text/javascript" src="../js/jqBootstrapValidation.js"></script>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
    <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/indexAdmin.css">

	<script>
		$(function () { 
			//validação dos campos
			$("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); 
			
		} );
	</script>

</head>
<body>

	<div class="modal-dialog text-center">
		<div class="col-sm-8 main-section">
			<div class="modal-content">
				

				<div class="col-12 user-img">
					<img src="../img/logo.png">
				</div>

				<form class="col-12" name="login" method="post" action="verifica.php" novalidate>

					<div class="form-group">
						<input type="text" name="login" class="form-control" placeholder="Login" 
						required data-validation-required-message="Preencha o login">
					</div>
					<div class="form-group">
						<input type="password" name="senha" class="form-control" placeholder="Senha"
						required data-validation-required-message="Preencha sua senha">
					</div>

					<button type="submit" class="btn"><i class="fas fa-sign-in-alt"></i>Login</button>

				</form>

				<div class="col-12 forgot">
					<a href="#">Perdeu a Senha?</a>
				</div>


			</div><!--fim do modal-content-->
		</div>
	</div>

</body>
</html>