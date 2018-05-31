<?php
include_once("menu.php");
?>
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
</head>
<body>
  <center><h1>Bienvenido</h1></center>
  <section class="container col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
    <article>
      <br><br>
      <form method="post" action="iniciar_sesion_cont.php">

        <input type="text" name="iuser" placeholder="Nombre de Usuario" maxlength="15" class="form-control"><br> <br>

        <input type="password" name="ipass" placeholder="Contraseña" maxlength="15" class="form-control"><br><br>

        <center><input type="submit" value="Ingresar" class="btn btn-success"></center>
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
