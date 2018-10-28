
<?php

session_start();
if(!isset($_SESSION['NombreUsuario'])) {
	header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title></title>
		<meta name="keywords" content="Add keywords" />
		<meta name="author" content="_yourName_ for Codrops" />
		<link rel="shortcut icon" href="img/icon.png">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" href="css/styles.css">

		<link rel="stylesheet" type="text/css" href="dialog/bli/css/bootstrap-dialog.css" />
    	<link rel="stylesheet" type="text/css" href="dialog/bli/css/bootstrap-dialog.min.css" />
    	
    	<link rel="stylesheet" type="text/css" href="dialog/bli/css/bootstrap-theme.min.css">
    
    	<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>

    	<script src="dialog/bli/js/bootstrap.min.js"></script>
    	<script src="dialog/bli/js/bootstrap-dialog.js"></script>    
    	<script src="dialog/bli/js/bootstrap-dialog.min.js"></script>

		<script src="js/eventos.js" type="text/javascript" ></script>
		<script src="js/modernizr.custom.js"></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
	</head>
	<body>
		<div class="container">	
			<header class="clearfix">
				<h1>Cumple tus sueños y los de tu familia <span>El éxito está con tus conocidos y gente de confianza.</span></h1>	
			</header>
			<div class="main">
				<div class="side">
					<nav class="dr-menu">
						<div class="dr-trigger"><span class="dr-icon dr-icon-menu"></span><a class="dr-label">Cuenta</a></div>
						<ul>
							<li><a class="dr-icon dr-icon-user" 	href="#" id="btn-perfil">Perfil</a></li>
							<li><a class="dr-icon dr-icon-bullhorn" href="#" id="btn-solicitudes">Solicitudes</a></li>
							<li><a class="dr-icon dr-icon-download" href="#" ">Historia</a></li>
							<li><a class="dr-icon dr-icon-switch"   href="#" id="btnDestruirSesion" >Logout</a></li>
						</ul>
					</nav>
				</div>
				<div  class="form-group" id="form-perfil">
					<section id="contact-form-section" class="form-content-wrap">
						<div class="container">
							<div class="row">
								<div class="tab-content">
									<div class="col-sm-12">
										<div class="item-wrap">
											<div class="row">
												<div class="col-sm-12">
													<div class="item-content colBottomMargin">
														<div class="item-info">
															<h2 class="item-title text-center">Mi Perfil</h2>
														</div><!--End item-info -->
												   </div><!--End item-content -->
												</div><!--End col -->
												<div class="col-md-12">
												<form id="contactForm" name="contactform" data-toggle="validator" class="popup-form">
													<div class="row" style="margin-left: 3%; margin-top: 2%;">
														<div id="msgContactSubmit" class="hidden"></div>
														<div class="form-group col-sm-6">
															<div class="help-block with-errors"></div>
															<input id="inp-perfil-name" class="form-control" type="text" disabled="true"> 
															<div class="input-group-icon"><i class="fa fa-user"></i></div>
														</div><!-- end form-group -->
														<div class="form-group col-sm-6">
															<div class="help-block with-errors"></div>
															<input id="inp-perfil-correo" pattern=".*@\w{2,}\.\w{2,}" class="form-control" type="email" disabled="true">
															<div class="input-group-icon"><i class="fa fa-envelope"></i></div>
														</div><!-- end form-group -->
														<div class="clearfix"></div>
													</div><!-- end row -->
												</form><!-- end form -->
												<div id="js-Tabla-Perfil"></div>
												</div>
											</div><!--End row -->
											<!-- Popup end -->
										</div><!-- end item-wrap -->
									</div><!--End col -->
								</div><!--End tab-content -->
							</div><!--End row -->
						</div><!--End container -->
					</section>
				</div>
				<div id="js-Tabla-Solicitudes"></div>
  				<button class="btn" type="button" id="btn-NuevaS" data-toggle="modal" data-target="#myModal">Nueva Solicitud</button>
  				
				<!-- Modal Nueva Solicitud -->
				<div class="modal fade" id="myModal" role="dialog">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <form>
				          <div class="form-group">
				            <label for="recipient-name" class="col-form-label">Recipient:</label>
				            <input type="text" class="form-control" id="recipient-name">
				          </div>
				          <div class="form-group">
				            <label for="message-text" class="col-form-label">Message:</label>
				            <textarea class="form-control" id="message-text"></textarea>
				          </div>
				        </form>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-primary">Send message</button>
				      </div>
				    </div>
				  </div>
				</div><!-- Termina Modal Nueva Solicitud -->

				<!--TERMINA FORMULARIO HISTORIAL -->
			</div>
		</div><!-- /container -->
		<script src="js/ytmenu.js"></script>
	</body>
</html>