<?php 
/**
 */
include_once("conexion.php");
class Orden_Producto {
	private $Codigo_Producto = 0;
	private $Cantidad = 0;
	private $Desc_Cant = 0;
	private $IEPS_Cant = 0;
	private $IVA_Cant = 0;
	private $Total = 0;

	private $Nombre = "";
	private $Unidad = "";
	private $Precio_U = 0;

	private $Next=null;
	private $Previous=null;

	function setNext($pNext){
		$this->Next = $pNext;
	}
	function getNext(){
		return $this->Next;
	}

	function setPrev($pPrev){
		$this->Previous = $pPrevious;
	}
	function getPrev(){
		return $this->Previous;
	}

	function setFolio_Orden($pFolio){
		$this->Folio_Orden = $pFolio;
	}
	function getFolio_Orden(){
		return $this->Folio_Orden;
	}

	function setCodigo_Producto($pCodigo_Producto){
		$this->Codigo_Producto = $pCodigo_Producto;
	}
	function getCodigo_Producto(){
		return $this->Codigo_Producto;
	}

	function setCantidad($pCantidad){
		$this->Cantidad = $pCantidad;
	}
	function getCantidad(){
		return $this->Cantidad;
	}

	function setDesc_Cant($pDesc_Cant){
		$this->Desc_Cant = $pDesc_Cant;
	}
	function getDesc_Cant(){
		return $this->Desc_Cant;
	}

	function setIEPS_Cant($pIEPS_Cant){
		$this->IEPS_Cant = $pIEPS_Cant;
	}
	function getIEPS_Cant(){
		return $this->IEPS_Cant;
	}

	function setIVA_Cant($pIVA_Cant){
		$this->IVA_Cant = $pIVA_Cant;
	}
	function getIVA_Cant(){
		return $this->IVA_Cant;
	}

	function setTotal($pTotal){
		$this->Total = $pTotal;
	}
	function getTotal(){
		return $this->Total;
	}

	function getNombre_Producto(){
		return $this->Nombre;
	}
	function getUnidad_Medida(){
		return $this->Unidad;
	}
	function getPrecio_U(){
		return $this->Precio_U;
	}



	function search_info_product(){
 	$Connection=new conexion();
  	$sQuery="";
  	$Result=null;
  	$bRet = false;
  		if ($this->Codigo_Producto == 0) {
  			throw new Exception("Orden->search_products(): Error, No de ha especificado un Producto para buscar");
  		}else{
  			if ($Connection->conectar()){
  		 		$sQuery = " SELECT nombre, unidad_medida, precio_u
							FROM public.porducto WHERE codigo = ".$this->Codigo_Producto;
  				$Result = $Connection->ejecutarConsulta($sQuery);
  				$Connection->desconectar();
  				if ($Result){
  					$this->Nombre = $Result[0][0];
  					$this->Unidad = $Result[0][1];
  					$this->Precio_U = $Result[0][2];
  					$bRet = true;
  				}
  			}
  		}
		return $bRet;
	}

}

 ?>