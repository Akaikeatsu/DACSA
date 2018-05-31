<?php 
include_once("conexion.php");

class Producto {
	private $Codigo=0;
	private $Nombre="";
	private $Unidad="";
	private $Precio=0;
	private $Descuento=0;
	private $IEPS=0;
	private $IVA=0;
	private $Existencia=0;
	
	function setCodigo($pCodigo){
		$this->Codigo = $pCodigo;
	}
	function getCodigo(){
		return $this->Codigo;
	}

	function setNombre($pNombre){
		$this->Nombre = $pNombre;
	}
	function getNombre(){
		return $this->Nombre;
	}

	function setUnidad($pUnidad){
		$this->Unidad = $pUnidad;
	}
	function getUnidad(){
		return $this->Unidad;
	}

	function setPrecio($pPrecio){
		$this->Precio = $pPrecio;
	}
	function getPrecio(){
		return $this->Precio;
	}

	function setDescuento($pDescuento){
		$this->Descuento = $pDescuento;
	}
	function getDescuento(){
		return $this->Descuento;
	}

	function setIEPS($pIEPS){
		$this->IEPS = $pIEPS;
	}
	function getIEPS(){
		return $this->IEPS;
	}

	function setIVA($pIVA){
		$this->IVA = $pIVA;
	}
	function getIVA(){
		return $this->IVA;
	}

	function setExistencia($pExistencia){
		$this->Existencia = $pExistencia;
	}
	function getExistencia(){
		return $this->Existencia;
	}

	

	function search_all(){
		$Conection=new conexion();
		$sQuery="";
		$arrRS=null;
		$aLinea=null;
		$j=0;
		$Product=null;
		$arrResultado=false;
		if ($Conection->conectar()){
		 	$sQuery = "SELECT * FROM public.porducto ORDER BY codigo";
			$arrRS = $Conection->ejecutarConsulta($sQuery);
			$Conection->desconectar();
			if ($arrRS){
				foreach($arrRS as $aLinea){
					$Product = new Producto();
					$Product->setCodigo($aLinea[0]);
					$Product->setNombre($aLinea[1]);
					$Product->setUnidad($aLinea[2]);
					$Product->setPrecio($aLinea[3]);
					$Product->setDescuento($aLinea[4]);
					$Product->setIEPS($aLinea[5]);
					$Product->setIVA($aLinea[6]);
					$Product->setExistencia($aLinea[7]);
            		$arrResultado[$j] = $Product;
					$j=$j+1;
                }
			}
			else
				$arrResultado = false;
        }
		return $arrResultado;
	}

}

 ?>