<?php 
  include_once("modelo\iniciar_sesion_db.php");
  session_start();
  $sErr = "";
  $Usuario=new Usuario();
 
  if (isset($_SESSION["usu"])){
    $Usuario = $_SESSION["usu"];
  }
  else
    $sErr = "Debe estar firmado"
 ?>

<?php  include_once("menu.php");  ?><br><br>
<?php  include_once("header.html"); ?><br>

<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
  <link href="css/personalizado.css" rel="stylesheet" type="text/css">
</head>
<body>

  <div id="demo" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
      <li data-target="demo" data-slide-to="0" class="active"></li>
      <li data-target="demo" data-slide-to="1"></li>
      <li data-target="demo" data-slide-to="2"></li>
    </ul>

    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/21.jpg" class="img-fluid">
      </div>
      <div class="carousel-item">
        <img src="img/9.jpg" class="img-fluid">
      </div>
      <div class="carousel-item">
        <img src="img/8.jpg" class="img-fluid">
      </div>
    </div>

    <a class="carousel-control-prev" href="#demo" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
    <a class="carousel-control-next" href="#demo" data-slide="next"><span class="carousel-control-next-icon"></span></a>
  </div>
  <br>
  <?php
  include_once("aside.html");
  ?>
  <section class="container-fluid">

    <article class="row">
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 border mx-auto sombra">
        <header>
          <h1 class="mision">Misi&oacute;n</h1>
        </header>
        <p class="parrafoD">Ofrecer un amplio catalogo de producos con el fin de satisfacer la demanda del cliente.</p>
        <p class="parrafoD">Proporcionar una cordial y satisfactoria atención hacia los clientes.</p>
      </div>
    </article>
    <br><br><br>
    <article class="row" >
      <div class="col-xs-12 col-sm-12  col-md-8 col-lg-8 col-xl-8 border mx-auto sombra">
        <header>
          <h1 class="vision">Visi&oacute;n</h1>
        </header>
        <p class="parrafoD">Lograr una superación como trabajadores. Extender la presencia de la empresa a lo largo </p>
        <p class="parrafoD">de Córdoba y los municipios cercanos.</p>
      </div>
    </article>
    <br><br><br>
    <article class="row">
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 border mx-auto sombra">
        <header>
          <h1 class="valores">Valores</h1>
        </header>
        <p class="parrafoD">
          Calidad •
          Honestidad •
          Confianza •
          Responsabilidad •
          Eficiencia •
          Compromiso •
          Cordialidad •
          Competitividad
        </p>
      </div>
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
