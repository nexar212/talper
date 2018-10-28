<?php

session_start();
if(isset($_SESSION['NombreUsuario'])) {
   header('location:index.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<!-- <link rel="shortcut icon" href="img/icon.png"> -->
	
	<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="js/lib/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/lib/bootstrap-toggle.min.js"></script>

	<script src="js/eventos.js" type="text/javascript" ></script>

</head>
<body>
<div class="Contenedor">
	<div class="cont-izquierda">
		
	<img src="img/login.jpg" id="img-fondo">
	<img src="img/concredito.png" id="img-concredito">
		
	</div>
	<div class="cont-derecha">
		<div class="container login-form">
			<h2 class="login-title">- Bienvenido -</h2>
			
			<div class="panel panel-default">
				<div class="panel-body" id="body-login">
					<form>
						<div class="input-group login-userinput">
							<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
							<input id="inp-usuario" type="text" class="form-control" name="usuario" placeholder="Nom. Usuario">
						</div>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
							<input  id="inp-correo" type="text" class="form-control" name="correo" placeholder="Correo Electronico">
						</div>
						<button class="btn btn-primary btn-block login-button" type="button" id="btnLogin"><i class="fa fa-sign-in"></i> Ingresar</button>	
					</form>			
				</div>
			</div>
			<div class="marco">
			</div>
		</div>
		</div>
</div>
</body>
</html>