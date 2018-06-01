<?php
	session_start();
	$sErr="";
	/*Verificar que hayan llegado los datos*/
	if (isset($_SESSION["usu"])){
		if ($_SESSION["orden"] != null) {
			$sErr = "Falta confirmar un pedido";
		}else
			session_destroy();
	}
	else
		$sErr = "Falta establecer el login";
	
	if ($sErr == ""){
		header("Location: index.php");
		exit();
	}else{
?>
		<html>
		<head>
			<title></title>
		</head>
		<body>
		<script>alert("Aun tiene tiene un pedio por confirmar")</script>
		<script language="JavaScript">window.self.location="realizarpedido.php";</script>
		</body>
		</html>
<?php		
	}
	
?>

<!--<?php
/*session_start();
$sErr="";
	
	if (isset($_SESSION["usu"])){
		session_destroy();
	}
	else
		$sErr = "Falta establecer el login";
	
	if ($sErr == "")
		header("Location: index.php");
	else
		exit();*/
?>-->