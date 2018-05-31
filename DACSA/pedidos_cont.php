<?php 
  	include_once("modelo\producto.php");
	
  	$sErr = "";
  	$Producto = new Producto();
  	$Folio_Orden = "";
  	$Codgo = 0;

    if (isset($_POST["folio"]) && !empty($_POST["folio"]) && isset($_POST["codigo"]) && !empty($_POST["codigo"])) {
        $Codgo = $_POST["codigo"];
    	$Folio_Orden = $_POST["folio"];
    	$Producto->setCodigo($Codgo);
    	$Producto->search_product();
    	$Producto->setFolio($Folio_Orden);
    	$Producto->add_to_order();
    }else{
    	$sErr = "Debe estar firmado";
  	}

    if ($sErr = "") {
    	header("Location: catalogo.php");
    }else
    	header("Location: test.php");


 ?>


