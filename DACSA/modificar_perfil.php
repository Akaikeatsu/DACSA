<?php 
  include_once("modelo\iniciar_sesion_db.php");
  session_start();
  $sErr = "";
  $Usuario=new Usuario();
 
  if (isset($_SESSION["usu"])){
    $Usuario = $_SESSION["usu"];
  }
  else
    $sErr = "Debe estar firmado";
 ?>

<?php  include_once("menu.php");  ?>  <br><br>
<?php  include_once("header.html"); ?>  <br>

<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
</head>
<body>
  <center><h1>Modificar Perfil</h1></center>
  <br>
<?php 
  if ($Usuario->getData()->getTipo() == 1) {
?>
  <section class="container col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
    <article>
      <form method="post" action="modificar_perfil_cont.php">
        <input type="hidden" name="tipo" value=1>

        <input type="text"  name="nombre" placeholder="Nombre" maxlength="32" 
        pattern="([A-ZÁÉÍÓÚ]{1}[a-záéíóú]+){1}([\s][A-ZÁÉÍÓÚ]{1}[a-záéíóú]+)+|[A-ZÁÉÍÓÚ]{1}[a-záéíóú]+" class="form-control" 
        value="<?php echo $Usuario->getData()->getNombre() ?>"><br>
        
        <input type="text" name="rfc" placeholder="RFC" maxlength="13" pattern="[A-Z]{4}[0-9]{6}[A-Z0-9]{3}" class="form-control" value="<?php echo $Usuario->getData()->getRFC() ?>"><br>
        
        <input type="text"  name="dom" placeholder="Domicilio Fiscal" maxlength="30" class="form-control" 
        value="<?php echo $Usuario->getData()->getDomicilio() ?>"><br>
        
        <input type="text"  name="email" placeholder="Correo" maxlength="30" 
        pattern="\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+" class="form-control" 
        value="<?php echo $Usuario->getData()->getEmail() ?>"><br>
        
        <input type="text"  name="tel" placeholder="Tel&eacute;fono" maxlength="10" 
        pattern="[0-9]{3}[0-9]{3}[0-9]{4}" class="form-control" 
        value="<?php echo $Usuario->getData()->getTelefono() ?>"><br>
        
        <input type="text"  name="usuario" placeholder="Nombre de Usuario" maxlength="15" 
        pattern="[A-Za-z0-9]{8,10}|[A-Za-z]{8,15}" class="form-control" 
        value="<?php echo $Usuario->getData()->getUser_Name() ?>"><br>
        
        <input type="text"  name="pass" placeholder="Contraseña" maxlength="15" 
        pattern="[A-Za-z0-9]{8,15}" class="form-control" 
        value="<?php echo $Usuario->getData()->getPassword() ?>"><br>
        
        <center><input type="submit" value="Modificar" class="btn btn-success"></center>
      </form>
    </article>
  </section>
<?php    
  }else{
 ?>
  <section class="container col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
    <article><br>
      <form method="post" action="modificar_perfil_cont.php">
        <input type="hidden" name="tipo" value=2>
        
        <input type="text"  name="nombre" placeholder="Nombre" maxlength="32" 
        pattern="([A-ZÁÉÍÓÚ]{1}[a-záéíóú]+){1}([\s][A-ZÁÉÍÓÚ]{1}[a-záéíóú]+)+|[A-ZÁÉÍÓÚ]{1}[a-záéíóú]+" class="form-control" 
        value="<?php echo $Usuario->getData()->getNombre() ?>"><br>
        
        <input type="text"  name="email" placeholder="Correo" maxlength="30" 
        pattern="\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+" class="form-control" 
        value="<?php echo $Usuario->getData()->getEmail() ?>"><br>
        
        <input type="text"  name="tel" placeholder="Tel&eacute;fono" maxlength="10" 
        pattern="[0-9]{3}[0-9]{3}[0-9]{4}" class="form-control" 
        value="<?php echo $Usuario->getData()->getTelefono() ?>"><br>
        
        <input type="text"  name="usuario" placeholder="Nombre de Usuario" maxlength="15" 
        pattern="[A-Za-z0-9]{8,15}|[A-Za-z]{8,15}" class="form-control" 
        value="<?php echo $Usuario->getData()->getUser_Name() ?>"><br>
        
        <input type="text"  name="pass" placeholder="Contraseña" maxlength="15" 
        pattern="[A-Za-z0-9]{8,15}" class="form-control" 
        value="<?php echo $Usuario->getData()->getPassword() ?>"><br>
        
        <center><input type="submit" value="Modificar" class="btn btn-success"></center>
      </form>
    </article>
  </section>
 <?php 
  } 
?>
  <br>

  <script src="js/popper.min.js"></script>
  <script src="js/jquery-3.3.1.slim.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

</body>
</html>

<?php
include_once("footer.html");
?>
