<?php 
include_once("modelo\data.php");
session_start();
$sErr = "";
$Tipo_Usuario = 0;
$New_User = new Data();

if (isset($_POST["usuario"]) && !empty($_POST["usuario"]) && isset($_POST["pass"]) && !empty($_POST["pass"]) && isset($_POST["nombre"]) && !empty($_POST["nombre"]) && isset($_POST["tel"]) && !empty($_POST["tel"]) && isset($_POST["email"]) && !empty($_POST["email"])) {
	$Tipo_Usuario = $_POST["tipo"];
	$New_User->setUser_Name($_POST["usuario"]);

	if ($New_User->is_registred()) {
		$sErr = "El usuario ya existe";
	}else{
		
		$New_User->setPassword($_POST["pass"]);
		$New_User->setNombre($_POST["nombre"]);
		$New_User->setTelefono($_POST["tel"]);
		$New_User->setEmail($_POST["email"]);
		$New_User->setTipo($Tipo_Usuario);

		try{
			$nResultado = $New_User->registrar_usuario();
			if ($Tipo_Usuario == 1) {
				if (isset($_POST["dom"]) && !empty($_POST["dom"]) && isset($_POST["rfc"]) && !empty($_POST["rfc"])) {
					$New_User->setDomicilio($_POST["dom"]);
					$New_User->setRFC($_POST["rfc"]);
					$New_User->getId_by_UserName();
					$New_User->add_info_cliente();
				}
			}
		}catch(Exception $e){
			error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
			$sErr = "Error en base de datos, comunicarse con el administrador";
		}
	}

}

	if ($sErr == ""){	?>
		<html>
		<head>
			<title></title>
		</head>
		<body>
		<script>alert("Usuario Registrado exitosamente")</script>
		<script language="JavaScript">window.self.location="iniciar_sesion.php";</script>
		</body>
		</html>
<?php	
	}else{	
		if ($Tipo_Usuario == 1) {
?>
			<html>
			<head>
				<title>Error</title>
			</head>
			<body>
			<script>alert("<?php echo $sErr ?>")</script>
			<script language="JavaScript">window.self.location="reg_client.php";</script>
			</body>
			</html>
<?php			
		}else{
?>
			<html>
			<head>
				<title>Error</title>
			</head>
			<body>
			<script>alert("<?php echo $sErr ?>")</script>
			<script language="JavaScript">window.self.location="reg_encarg.php";</script>
			</body>
			</html>
<?php	
		}
	}
 ?>
