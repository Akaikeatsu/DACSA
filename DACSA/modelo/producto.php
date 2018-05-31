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

	private $Folio="";

	function setFolio($pFolio){
		$this->Codigo = $pFolio;
	}
	function getFolio(){
		return $this->Codigo;
	}
	
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

	function search_product(){
		$Connection=new conexion();
  		$sQuery="";
  		$Result=null;
  		$bRet = false;
	  		if ($this->Codigo==0)
	  			throw new Exception("Data->buscar(): faltan datos");
	  		else{
	  			if ($Connection->conectar()){
	  		 		$sQuery = " SELECT precio_u, descuento, ieps, iva
								FROM public.porducto 
								WHERE codigo = ".$this->Codigo;
	  				$Result = $Connection->ejecutarConsulta($sQuery);
	  				$Connection->desconectar();
	  				if ($Result){
	  					$this->Precio = $Result[0][0];
	  					$this->Descuento = $Result[0][1];
	  					$this->IEPS = $Result[0][2];
	  					$this->IVA = $Result[0][3];
	  					$bRet = true;
	  				}
	  			} 
	  		}
		return $bRet;
	}

	function add_to_order(){
		$Connection=new conexion();
	    $sQuery="";
	    $nAfectados=-1;
	      if ($this->Folio == "" OR $this->Codigo == 0)
	          throw new Exception("Data->registrar_usuario(): faltan datos");
	      else{
	        if ($Connection->conectar()){
	          $Total= $this->Precio - $this->Descuento + $this->IEPS + $this->IVA;
	          $sQuery = "INSERT INTO public.porducto_venta
	          				(porductocodigo, ventafolio, cantidad, desc_cant, ieps_cant, iva_cant, total_cant)
						 VALUES (".$this->Codigo.", '".$this->Folio."', 1, ".$this->Descuento.", ".$this->IEPS.", ".$this->IVA.", ".$Total.");";
	          $nAfectados = $Connection->ejecutarComando($sQuery);
	          $Connection->desconectar();     
	        }
	      }
	    return $nAfectados;
	}

}

 ?>