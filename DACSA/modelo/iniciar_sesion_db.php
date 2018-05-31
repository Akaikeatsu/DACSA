<?php
/*
Archivo:  Usuario.php
Objetivo: clase que encapsula la información de un usuario
Autor:    
*/
include_once("conexion.php");
include_once("data.php");
class Usuario {
	private $User_Name = "";
	private $Password = "";
	private $Data = null;
	private $Connection = null;

	public function getData(){
		return $this->Data;
	}
	public function setData($valor){
		$this->Data = $valor;
	}

	public function getUser_Name(){
		return $this->User_Name;
	}
	public function setUser_Name($valor){
		$this->User_Name = $valor;
	}

	public function getPassword(){
		return $this->Password;
	}
	public function setPassword($valor){
		$this->Password = $valor;
	}
	
	public function exist(){
	$bRet = false;
	$sQuery = "";
	$Result = null;
	$Tipo=0;
		if (($this->User_Name == "" || $this->Password == "") )
			throw new Exception("Usuario->exist: faltan datos");
		else{
			$sQuery = "SELECT id_usuario
						FROM public.usuario
						WHERE nombre_usuario = '".$this->User_Name."' AND contrasenia = '".$this->Password."'";
			//Crear, conectar, ejecutar, desconectar
			$Connection = new conexion();
			if ($Connection->conectar()){
				$Result = $Connection->ejecutarConsulta($sQuery);
				$Connection->desconectar();
				if ($Result != null){
					$this->Data = new Data();
					$this->Data->setId($Result[0][0]);
					$this->Data->buscar();
					$Tipo=$this->Data->getTipo();
					if ($Tipo == 1) {
						$this->Data->get_info_cliente();
					}
					$bRet = true;
				}
			}
		}
		return $bRet;
	}
}
?>