<?php 
  	include_once("modelo\iniciar_sesion_db.php");
  	session_start();
  	$sErr = "";
  	$Usuario=new Usuario();
  	$Tipo_Usuario = 0;

  	if (isset($_SESSION["usu"])) {
  		$Usuario = $_SESSION["usu"];
  	}else{
  		$sErr = "Debe estar firmado";
  	}

    if (isset($_POST["usuario"]) && !empty($_POST["usuario"]) && isset($_POST["pass"]) && !empty($_POST["pass"]) && isset($_POST["nombre"]) && !empty($_POST["nombre"]) && isset($_POST["tel"]) && !empty($_POST["tel"]) && isset($_POST["email"]) && !empty($_POST["email"])) {
    		$Usuario->getData()->setUser_Name($_POST["usuario"]);
    		$Usuario->getData()->setPassword($_POST["pass"]);
    		$Usuario->getData()->setNombre($_POST["nombre"]);
    		$Usuario->getData()->setTelefono($_POST["tel"]);
    		$Usuario->getData()->setEmail($_POST["email"]);
    		try {
    			$Usuario->getData()->update_user();
    			$Tipo_Usuario = $Usuario->getData()->getTipo();
		
				if ($Tipo_Usuario == 1) {
					if (isset($_POST["dom"]) && !empty($_POST["dom"]) && isset($_POST["rfc"]) && !empty($_POST["rfc"])) {
						$Usuario->getData()->setDomicilio($_POST["dom"]);
						$Usuario->getData()->setRFC($_POST["rfc"]);
						$Usuario->getData()->update_info_cliente();
					}
				}
    		} catch (Exception $e) {
    			error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
				$sErr = "Error en base de datos, comunicarse con el administrador";
    		}
    }

    if ($sErr == "") {
    	$_SESSION["usu"] = $Usuario;
    	header("Location: perfil_usuario.php");
    }else{
    	header("Location: modificar_usuario.php");
    }

 ?>