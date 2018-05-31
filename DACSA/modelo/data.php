<?php
/*
Archivo:  Data.php
Objetivo: clase que encapsula la información de una persona que labora en el hospital
Autor:    
*/
include_once("conexion.php");
class Data {
	private $Id=0;
  private $UserName="";
  private $Password="";
	private $Nombre="";
	private $Telefono=0;
	private $Email="";
	private $Domicilio="";
	private $RFC="";
	private $Tipo=0;
   
	  function setId($pId){
       $this->Id = $pId;
    }   
    function getId(){
       return $this->Id;
    }

    function setUser_Name($pUserName){
       $this->UserName = $pUserName;
    }   
    function getUser_Name(){
       return $this->UserName;
    }

    function setPassword($pPassword){
       $this->Password = $pPassword;
    }   
    function getPassword(){
       return $this->Password;
    }

    function setNombre($pNombre){
       $this->Nombre = $pNombre;
    }   
    function getNombre(){
       return $this->Nombre;
    }

    function setTelefono($pTelefono){
       $this->Telefono = $pTelefono;
    }   
    function getTelefono(){
       return $this->Telefono;
    }

    function setEmail($pEmail){
       $this->Email = $pEmail;
    }   
    function getEmail(){
       return $this->Email;
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

    function setTipo($pTipo){
       $this->Tipo = $pTipo;
    }   
    function getTipo(){
       return $this->Tipo;
    }
	
  function is_registred(){
    $bRet = false;
    $sQuery = "";
    $Result = null;
    $Tipo=0;
      if ($this->UserName == "")
        throw new Exception("Data->is_registred(): faltan datos");
      else{
        $sQuery = "SELECT id_usuario
              FROM public.usuario
              WHERE nombre_usuario = '".$this->UserName."'";
        $Connection = new conexion();
        if ($Connection->conectar()){
          $Result = $Connection->ejecutarConsulta($sQuery);
          $Connection->desconectar();
          if ($Result != null){
            $bRet = true;
          }
        }
      }
      return $bRet;
  }

	function buscar(){
  	$Connection=new conexion();
  	$sQuery="";
  	$Result=null;
  	$bRet = false;
  		if ($this->Id==0)
  			throw new Exception("Data->buscar(): faltan datos");
  		else{
  			if ($Connection->conectar()){
  		 		$sQuery = " SELECT nombre, telefono, correo, tipo, nombre_usuario, contrasenia
  								FROM public.usuario WHERE id_usuario = ".$this->Id;
  				$Result = $Connection->ejecutarConsulta($sQuery);
  				$Connection->desconectar();
  				if ($Result){
  					$this->Nombre = $Result[0][0];
  					$this->Telefono = $Result[0][1];
  					$this->Email = $Result[0][2];
  					$this->Tipo = $Result[0][3];
            $this->UserName = $Result[0][4];
            $this->Password = $Result[0][5];
  					$bRet = true;
  				}
  			} 
  		}
		return $bRet;
	}

  function get_info_cliente(){
    $Connection=new conexion();
    $sQuery="";
    $Result=null;
    $bRet = false;
      if ($this->Id==0)
        throw new Exception("Data->buscar(): faltan datos");
      else{
        if ($Connection->conectar()){
          $sQuery = " SELECT dom_fiscal, rfc FROM public.info_cliente WHERE id_usuario = ".$this->Id;
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

  function getId_by_UserName(){
    $Connection=new conexion();
    $sQuery="";
    $Result=null;
    $bRet = false;
      if ($this->UserName == "")
        throw new Exception("Data->getId_by_UserName(): faltan datos");
      else{
        if ($Connection->conectar()){
          $sQuery = " SELECT id_usuario FROM public.usuario WHERE nombre_usuario = '".$this->UserName."'";
          $Result = $Connection->ejecutarConsulta($sQuery);
          $Connection->desconectar();
          if ($Result){
            $this->Id = $Result[0][0];
            $bRet = true;
          }
        } 
      }
    return $bRet;
  }

  function registrar_usuario(){
    $Connection=new conexion();
    $sQuery="";
    $nAfectados=-1;
      if ($this->UserName == "" OR $this->Password == "" OR $this->Nombre == "" OR $this->Telefono == 0 OR $this->Email == "" OR $this->Tipo==0)
          throw new Exception("Data->registrar_usuario(): faltan datos");
      else{
        if ($Connection->conectar()){
          $sQuery = "INSERT INTO public.usuario(nombre_usuario, contrasenia, nombre, telefono, correo, tipo) VALUES (
                    '".$this->UserName."', '".$this->Password."', '".$this->Nombre."', ".$this->Telefono.", '".$this->Email."',".$this->Tipo.");";
          $nAfectados = $Connection->ejecutarComando($sQuery);
          $Connection->desconectar();     
        }
      }
    return $nAfectados;
  }

  function add_info_cliente(){
    $Connection=new conexion();
    $sQuery="";
    $nAfectados=-1;
      if ($this->Id == 0 OR $this->Domicilio == "" OR $this->RFC == "")
          throw new Exception("Data->add_info_cliente(): faltan datos");
      else{
        if ($Connection->conectar()){
          $sQuery = "INSERT INTO public.info_cliente(dom_fiscal, rfc, id_usuario)
                      VALUES ('".$this->Domicilio."', '".$this->RFC."', ".$this->Id.");";
          $nAfectados = $Connection->ejecutarComando($sQuery);
          $Connection->desconectar();     
        }
      }
    return $nAfectados;
  }

  function update_user(){
    $Connection=new conexion();
    $sQuery="";
    $nAfectados=-1;
      if ($this->Id==0)
          throw new Exception("Data->update_user(): faltan datos");
      else{
        if ($Connection->conectar()){
          $sQuery = "UPDATE public.usuario
            SET nombre_usuario='".$this->UserName."', 
            contrasenia='".$this->Password."', 
            nombre='".$this->Nombre."', 
            telefono='".$this->Telefono."', 
            correo='".$this->Email."'
            WHERE id_usuario = ".$this->Id;
          $nAfectados = $Connection->ejecutarComando($sQuery);
          $Connection->desconectar();
        }
      }
      return $nAfectados;
  }

  function update_info_cliente(){
    $Connection=new conexion();
    $sQuery="";
    $nAfectados=-1;
      if ($this->Id==0)
          throw new Exception("Data->update_user(): faltan datos");
      else{
        if ($Connection->conectar()){
          $sQuery = "UPDATE public.info_cliente
            SET 
            dom_fiscal='".$this->Domicilio."', 
            rfc='".$this->RFC."'
            WHERE id_usuario = ".$this->Id;
          $nAfectados = $Connection->ejecutarComando($sQuery);
          $Connection->desconectar();
        }
      }
      return $nAfectados;
  }
	
}
?>