<?php
/*
Archivo:  login.php
Objetivo: verifica clave y contraseña contra repositorio a través de clases
Autor:   BAOZ
*/
include_once("modelo\iniciar_sesion_db.php");
session_start();
$sErr="";
$User_Name="";
$sNom="";
$Password="";
$User = new Usuario();
	/*Verificar que hayan llegado los datos*/
	if (isset($_POST["iuser"]) && !empty($_POST["iuser"]) && isset($_POST["ipass"]) && !empty($_POST["ipass"])){
		$User_Name = $_POST["iuser"];
		$Password = $_POST["ipass"];
		$User->setUser_Name($User_Name);
		$User->setPassword($Password);
		try{
			if ( $User->exist() ){
				$sNom = $User->getData()->getNombre();
				$_SESSION["usu"] = $User;
			}
			else{
				$sErr = "El nombre de usuario o la contraseña son incorrectos";
			}
		}catch(Exception $e){
			error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
			$sErr = "Error al acceder a la base de datos";
		}
	}
	else
		$sErr = "Faltan datos";

	if ($sErr == "")
		header("Location: test.php");
	else{	?>
		<html>
		<head>
			<title>Error</title>
		</head>
		<body>
		<script>alert("<?php echo $sErr ?>")</script>
		<script language="JavaScript">window.self.location="iniciar_sesion.php";</script>
		</body>
		</html>
<?php		
	}
?>
