<?php 
include_once("conexion.php");
include_once("orden_producto.php");
/**
 * 
 */
class Orden {
	private $Folio = "";
	private $Subtotal = 0;
	private $Descuento = 0;	
	private $Neto = 0;
	private $IEPS = 0;
	private $IVA = 0;
	private $Monto = 0;
	private $Factura = "";
	private $Envio = "";
	private $Usuario = 0;

	private $Name = "";
	private $RFC = "";
	private $Domicilio = "";

	function setFolio($pFolio){
		$this->Folio = $pFolio;
	}
	function getFolio(){
		return $this->Folio;
	}

	function setSubtotal($pSubtotal){
		$this->Subtotal = $pSubtotal;
	}
	function getSubtotal(){
		return $this->Subtotal;
	}

	function setDescuento($pDescuento){
		$this->Descuento = $pDescuento;
	}
	function getDescuento(){
		return $this->Descuento;
	}

	function setNeto($pNeto){
		$this->Neto = $pNeto;
	}
	function getNeto(){
		return $this->Neto;
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

	function setMonto($pMonto){
		$this->Monto = $pMonto;
	}
	function getMonto(){
		return $this->Monto;
	}

	function setUsuario($pUsuario){
		$this->Usuario = $pUsuario;
	}
	function getUsuario(){
		return $this->Usuario;
	}

	function setName($pName){
		$this->Name = $pName;
	}
	function getName(){
		return $this->Name;
	}

	function setDomicilio($pDomicilio){
		$this->Domicilio = $pDomicilio;
	}
	function getDomicilio(){
		return $this->Domicilio;
	}

	function setRFC($pRFC){
		$this->RFC = $pRFC;
	}
	function getRFC(){
		return $this->RFC;
	}

	function getFactura(){
		return $this->Factura;
	}
	function getEnvio(){
		return $this->Envio;
	}

	function find_client_name(){
	$Connection=new conexion();
    $sQuery="";
    $Result=null;
    $bRet = false;
	    if ($this->Usuario==0)
	    	throw new Exception("Orden->find_client_name(): Error, No de ha especificado un Usuario Asocido");
	    else{
	        if ($Connection->conectar()){
	        	$sQuery = " SELECT nombre FROM public.usuario WHERE id_usuario = ".$this->Usuario;
	        	$Result = $Connection->ejecutarConsulta($sQuery);
	         	$Connection->desconectar();
	          	if ($Result){
	            	$this->Name = $Result[0][0];
	            	$bRet = true;
	          	}
	        }
	    }
	    return $bRet;    
	}

	function find_info_client(){
	$Connection=new conexion();
   	$sQuery="";
   	$Result=null;
   	$bRet = false;
      	if ($this->Usuario==0)
        	throw new Exception("Orden->find_info_client(): Error, No de ha especificado un Número de Folio");
      	else{
        	if ($Connection->conectar()){
          	$sQuery = " SELECT dom_fiscal, rfc FROM public.info_cliente WHERE id_usuario = ".$this->Usuario;
          	$Result = $Connection->ejecutarConsulta($sQuery);
          	$Connection->desconectar();
          	if ($Result){
            	$this->Domicilio = $Result[0][0];
            	$this->RFC = $Result[0][1];
            	$bRet = true;
          	}
        	}
      	}
    	return $bRet;
	}

	function search(){
 	$Connection=new conexion();
  	$sQuery="";
  	$Result=null;
  	$bRet = false;
  		if ($this->Folio == "")
  			throw new Exception("Orden->search(): Error, No de ha especificado un Número de Folio");
  		else{
  			if ($Connection->conectar()){
  		 		$sQuery = " SELECT subtotal, descuento, neto, ieps_total, iva_total, monto_total, 
  		 						   cast((factura) as varchar(256)), cast((envio_dom) as varchar(256)), usuario
							FROM public.venta WHERE folio = '".$this->Folio."'";
  				$Result = $Connection->ejecutarConsulta($sQuery);
  				$Connection->desconectar();
  				if ($Result){
  					$this->Subtotal = $Result[0][0];
  					$this->Descuento = $Result[0][1];
  					$this->Neto = $Result[0][2];
  					$this->IEPS = $Result[0][3];
            		$this->IVA = $Result[0][4];
            		$this->Monto = $Result[0][5];
            		$this->Factura = $Result[0][6];
            		$this->Envio = $Result[0][7];
            		$this->Usuario = $Result[0][8];
  					$bRet = true;
  				}
  			} 
  		}
		return $bRet;
	}

	function search_all(){
	$Conection=new conexion();
	$sQuery="";
	$arrRS=null;
	$aLinea=null;
	$j=0;
	$Orden=null;
	$arrResultado=false;
		if ($Conection->conectar()){
		 	$sQuery = "SELECT folio, usuario FROM public.venta ORDER BY folio";
			$arrRS = $Conection->ejecutarConsulta($sQuery);
			$Conection->desconectar();
			if ($arrRS){
				foreach($arrRS as $aLinea){
					$Orden = new Orden();
					$Orden->setFolio($aLinea[0]);
					$Orden->setUsuario($aLinea[1]);
            		$arrResultado[$j] = $Orden;
					$j=$j+1;
                }
			}
			else
				$arrResultado = false;
        }
		return $arrResultado;
	}

	function search_products(){
	$Conection=new conexion();
	$sQuery="";
	$arrRS=null;
	$aLinea=null;
	$j=0;
	$Orden_Product=null;
	$arrResultado=false;
		if ($this->Folio == "")
  			throw new Exception("Orden->search(): Error, No de ha especificado un Número de Folio");
  		else{
			if ($Conection->conectar()){
			 	$sQuery = "SELECT porductocodigo, cantidad, desc_cant, ieps_cant, iva_cant, total_cant 
			 	FROM public.porducto_venta WHERE ventafolio = '".$this->Folio."'";
				$arrRS = $Conection->ejecutarConsulta($sQuery);
				$Conection->desconectar();
				if ($arrRS){
					foreach($arrRS as $aLinea){
						$Orden_Product = new Orden_Producto();
						$Orden_Product->setCodigo_Producto($aLinea[0]);
						$Orden_Product->setCantidad($aLinea[1]);
						$Orden_Product->setDesc_Cant($aLinea[2]);
						$Orden_Product->setIEPS_Cant($aLinea[3]);
						$Orden_Product->setIVA_Cant($aLinea[4]);
						$Orden_Product->setTotal($aLinea[5]);
						$Orden_Product->search_info_product();
	            		$arrResultado[$j] = $Orden_Product;
						$j=$j+1;
	                }
				}
				else
					$arrResultado = false;
	        }
	    }
		return $arrResultado;
	}

	function delete(){
		$this->delete_products();
		$this->delete_orden();
	}

	function delete_products(){
	$Conection=new conexion();
	$sQuery="";
	$nAfectados=-1;
		if ($this->Folio == "")
			throw new Exception("Orden->delete_products(): faltan datos");
		else{
			if ($Conection->conectar()){
		 		$sQuery = "DELETE FROM public.porducto_venta 
							WHERE ventafolio = '".$this->Folio."'";
				$nAfectados = $Conection->ejecutarComando($sQuery);
				$Conection->desconectar();
			}
		}
		return $nAfectados;
	}

	function delete_orden(){
	$Conection=new conexion();
	$sQuery="";
	$nAfectados=-1;
		if ($this->Folio == "")
			throw new Exception("Orden->delete_orden(): faltan datos");
		else{
			if ($Conection->conectar()){
		 		$sQuery = "DELETE FROM public.venta 
							WHERE folio = '".$this->Folio."'";
				$nAfectados = $Conection->ejecutarComando($sQuery);
				$Conection->desconectar();
			}
		}
		return $nAfectados;
	}

}

 ?>