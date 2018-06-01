<?php 
  	include_once("modelo\producto.php");
  	include_once("modelo\orden.php");
  	include_once("modelo\iniciar_sesion_db.php");
	session_start();
  	$sErr = "";
  	$Usuario=new Usuario();
  	$Producto = new Producto();
  	$Folio_Orden = "";
  	$Codgo = 0;

  	if (isset($_SESSION["usu"])){
	    $Usuario = $_SESSION["usu"];
	    $pUsuario=$Usuario->getData()->getId();
	}else
   		$sErr = "Debe estar firmado";

  if (!isset($_SESSION["orden"]) || $_SESSION["orden"] == null){
		$_SESSION["orden"] = new Orden();
		$_SESSION["orden"]->generate_folio();
		$_SESSION["orden"]->setUsuario($pUsuario);
		$_SESSION["orden"]->registrar();
	}

	if (isset($_SESSION["orden"]) && $_SESSION["orden"] != null) {
		$Folio_Orden = $_SESSION["orden"]->getFolio();
	}

    if (isset($_GET["codigo"]) && !empty($_GET["codigo"])/* && isset($_GET["folio"]) && !empty($_GET["folio"])*/) {
        $Codgo = $_GET["codigo"];
    	/*$Folio_Orden = $_GET["folio"];*/
    	echo $Codgo." - ";
    	/*echo $Folio_Orden." - ";*/
    	try {
    		$Producto->setCodigo($Codgo);
    		echo $Producto->getCodigo()." - ";

    		$Producto->search_product();
    		echo $Producto->getPrecio()." - ";
    		echo $Producto->getDescuento()." - ";
    		echo $Producto->getIEPS()." - ";
    		echo $Producto->getIVA()." - ";

    		$Producto->setFolio($Folio_Orden);
    		echo $Producto->getFolio()." - ";
    		
    		$Producto->Funct();
    	} catch (Exception $e) {
    		error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
    		$sErr = "Error al agregar producto";
    	}
    }else{
    	$sErr = "No hay Datos";
  	}

    if ($sErr == "") {
    	header("Location: catalogo.php");
    }else
    	echo $sErr;
 ?>
