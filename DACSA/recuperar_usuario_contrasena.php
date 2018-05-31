<?php
include_once("menu.php");?>
<br><br>
<?php
include_once("header.html");
?>

<br>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
  <link href="css/personalizado.css" rel="stylesheet" type="text/css">
</head>
<body>
  <center><h1>Recuperar Contraseña y Nombre de Usuario</h1></center><br>
  <p class="parrafoD">Escriba su correo electr&oacute;nico</p>
  <p class="parrafoD">Le enviaremos su nombre de usuario y contraseña a su cuenta de correo electr&oacute;nico</p>
  <section class="container col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">

    <article>
      <br><br>
      <form action="iniciar_sesion_controlador.php">

        <input type="text"  name="txtcorreo" placeholder="Correo" maxlength="" pattern="" class="form-control">

        <br>
        <br>

        <center><input type="submit" value="Enviar" class="btn btn-success"></center>

      </form>

    </article>
  </section>
  <br>
  <br>
  <script src="js/popper.min.js"></script>
  <script src="js/jquery-3.3.1.slim.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>

<?php
include_once("footer.html");
?>
