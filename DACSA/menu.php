<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
		<?php
		include_once("modelo\iniciar_sesion_db.php");
		/*session_start();*/
		$sErr = "";
		$Tipo=0;
		$Usuario = new Usuario();

		if(isset($_SESSION["usu"]) && !empty($_SESSION["usu"])){
			$Usuario = $_SESSION["usu"];
			$Tipo = $Usuario->getData()->getTipo();
			if($Tipo==1){?>

				<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#uno">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="uno">
					<ul class="navbar-nav">
						<li class="nav-item"> <a href="catalogo.php" class="nav-link">Cat&aacute;logo</a> </li>
						<li class="nav-item"> <a href="realizarpedido.php" class="nav-link">Realizar Pedido</a> </li>
						<li class="nav-item"> <a href="perfil_usuario.php" class="nav-link">Tu Perfil</a> </li>
						<li class="nav-item"> <a href="cerrar_sesion.php" class="nav-link">Cerrar Sesi&oacute;n</a> </li>
					</ul>
				</div>

			<?php }else {?>

				<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#uno">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="uno">
					<ul class="navbar-nav">
						<li class="nav-item"><a href="lista_pedidos.php" class="nav-link">Lista Pedidos</a></li>
						<li class="nav-item"><a href="perfil_usuario.php" class="nav-link">Tu Perfil</a></li>
						<li class="nav-item"><a href="cerrar_sesion.php" class="nav-link">Cerrar Sesi&oacute;n</a></li>
					</ul>
				</div>
			<?php }

		}else{ ?>
			<img src="img/logo5.png" width=60px class="navbar-brand">
			<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#uno">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="uno">
				<ul class="navbar-nav">
					<li class="nav-item"><a href="index.php" class="nav-link">Inicio</a></li>
					<li class="nav-item"><a href="iniciar_sesion.php" class="nav-link">Ingresar</a>
						<li class="nav-item dropdown">
							<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="navbardrop">Registrarse</a>
							<div class="dropdown-menu">
								<a href="reg_client.php" class="dropdown-item">Cliente</a>
								<a href="reg_encarg.php" class="dropdown-item">Encargado</a>
							</div>
						</li>
						<li class="nav-item"><a href="recuperar_usuario_contrasena.php" class="nav-link">Recuperar Contraseña y Usuario</a></li>
					</ul>
				</div>
			<?php  } ?>

		</nav>
	</body>
	</html>
