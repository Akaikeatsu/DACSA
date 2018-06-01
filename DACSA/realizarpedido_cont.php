<?php 
	include_once("modelo\orden.php");
	session_start();
	$Orden = new Orden();
	$sErr = "";
	$Operacion = "";
	$Factura = "";
  	$Envio = "";

  	if (isset($_POST["operation"]) && !empty($_POST["operation"])) {
  		$Operacion = $_POST["operation"];
  		echo $Operacion." - ";
	  	if (isset($_POST['check1'])) {
	  		$Factura = "true";
	  	}else
	  		$Factura = "false";
	  	if (isset($_POST['check2'])) {
	  		$Envio = "true";
	  	}else
	  		$Envio = "false";
	  	/*echo $Factura." - ";
	  	echo $Envio;*/
	  	if (isset($_SESSION["orden"]) && $_SESSION["orden"] != null) {
	  		$_SESSION["orden"]->setFactura($Factura);
	  		$_SESSION["orden"]->setEnvio($Envio);
	  		/*echo $_SESSION["orden"]->getFactura()." - ";
	  		echo $_SESSION["orden"]->getEnvio();*/
	  		if ($Operacion == 'confirm') {
	  			$_SESSION["orden"]->confirm_orden();
	  			$_SESSION["orden"]=null;
	  		}elseif ($Operacion == 'cancel') {
	  			$_SESSION["orden"]->delete();
	  			$_SESSION["orden"]=null;
	  		}
	  	}else
	  		$sErr = "No hay ordenes";
  	}else
  		$sErr = "Faltan Datos";

  	if ($sErr == "") {
 ?>
  		<html>
		<head>
			<title></title>
		</head>
		<body>
		<script>alert("Operacion Exitosamente Realizada")</script>
		<script language="JavaScript">window.self.location="test.php";</script>
		</body>
		</html>
<?php
  	}else
  		echo $sErr;

 ?>