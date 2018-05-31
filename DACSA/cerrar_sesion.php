<?php
session_start();
$sErr="";
	/*Verificar que hayan llegado los datos*/
	if (isset($_SESSION["usu"])){
		session_destroy();
	}
	else
		$sErr = "Falta establecer el login";
	
	if ($sErr == "")
		header("Location: index.php");
	else
		/*header("Location: error.php?sError=".$sErr);*/
	exit();
?>