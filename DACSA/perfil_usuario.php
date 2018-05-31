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

<?php  include_once("menu.php"); ?><br><br>
<?php  include_once("header.html");  ?><br>

<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
  <link href="css/personalizado.css" rel="stylesheet" type="text/css">
</head>
<body>
  <br>
<?php 
  if ($Usuario->getData()->getTipo() == 1) {
?>
  <section class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-6 mx-auto">
    <article class="card ">
      <div class="card-header">
        <p class="title-perfil">Cliente</p>
      </div>
      <img src="img/user.jpg">
      <div class="card-body">
        <label class="card-text"><b>Nombre:</b></label> <br>
        <label class="card-text"><?php echo $Usuario->getData()->getNombre() ?></label> <br>
        <label class="card-text"><b>RFC:</b></label> <br>
        <label class="card-text"><?php echo $Usuario->getData()->getRFC() ?></label> <br>
        <label class="card-text"><b>Domicilio Fiscal:</b></label> <br>
        <label class="card-text"><?php echo $Usuario->getData()->getDomicilio() ?></label> <br>
        <label class="card-text"><b>Tel&eacute;fono:</b></label> <br>
        <label class="card-text"><?php echo $Usuario->getData()->getTelefono() ?></label> <br>
        <label class="card-text"><b>Correo Electr&oacute;nico:</b></label> <br>
        <label class="card-text"><?php echo $Usuario->getData()->getEmail() ?></label> <br>
        <label class="card-text"><b>Nombre de Usuario:</b></label> <br>
        <label class="card-text"><?php echo $Usuario->getData()->getUser_Name() ?></label> <br>
        <form method="post" action="modificar_perfil.php">
          <center><input type="submit" value="Editar" class="btn btn-success"></center>
        </form>
      </div>
    </article>
  </section>
<?php    
  }else{
 ?>
  <section class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-6 mx-auto">
    <article class="card ">
      <div class="card-header">
        <p class="title-perfil">Encargado</p>
      </div>
      <img src="img/user.jpg">
      <div class="card-body">
        <label class="card-text"><b>Nombre:</b></label> <br>
        <label class="card-text"><?php echo $Usuario->getData()->getNombre() ?></label> <br>
        <label class="card-text"><b>Tel&eacute;fono:</b></label> <br>
        <label class="card-text"><?php echo $Usuario->getData()->getTelefono() ?></label> <br>
        <label class="card-text"><b>Correo Electr&oacute;nico:</b></label> <br>
        <label class="card-text"><?php echo $Usuario->getData()->getEmail() ?></label> <br>
        <label class="card-text"><b>Nombre de Usuario:</b></label> <br>
        <label class="card-text"><?php echo $Usuario->getData()->getUser_Name() ?></label> <br>
        <form method="post" action="modificar_perfil.php">
          <center><input type="submit" value="Editar" class="btn btn-success"></center>
        </form>
      </div>
    </article>
  </section>
<?php 
  } 
?>
  <script src="js/popper.min.js"></script>
  <script src="js/jquery-3.3.1.slim.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
include_once("footer.html");
?>
