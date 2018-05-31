<?php
/*************************************************************/
/* Archivo:  inicio.php
 * Objetivo: página de sesión iniciada
 * Autor:  BAOZ  
 *************************************************************/
include_once("modelo\iniciar_sesion_db.php");
session_start();
$sErr = "";
$Nombre="";
$Usuario=new Usuario();
 
	if (isset($_SESSION["usu"])){
		$Usuario = $_SESSION["usu"];
		$Nombre = $Usuario->getData()->getNombre();
	}
	else
		$sErr = "Debe estar firmado";
	
	if ($sErr == ""){
		include_once("menu.php"); 	?>
		<br><br>
<?php	include_once("header.html");
	}
	else{
		/*header("Location: error.php?sErr=".$sErr);*/
		exit();
	}
 ?>
        <section>
			<center><h1>Bienvenid@: <?php echo $Nombre;?></h1></center>
		</section>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
include_once("footer.html");
?>