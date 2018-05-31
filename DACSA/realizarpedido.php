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

<?php  include_once("menu.php");  ?><br><br>
<?php  include_once("header.html");  ?><br>

<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
</head>
<body>

  <section class="container-fluid ">

    <center><h3>Realizar Pedido</h3></center><br>

    <article class="row">
      <div class="col">
        <table class="table table-bordered table-hover">
          <thead class="">
            <tr>
              <td>Cantidad</td>
              <td>Unidad de Medida</td>
              <td>Producto</td>
              <td>C&oacute;digo</td>
              <td>Precio Unitario</td>
              <td>Importe de Descuento</td>
              <td>IEPS</td>
              <td>IVA</td>
              <td>Total</td>
            </tr>
          </thead>
        </table>
      </div>
    </article>
    <br><br><br>

    <div class="row">

      <article class="col-xs-4 col-sm-5 col-md-5 col-lg-3 col-xl-3">
        <label>SUBTOTAL:</label> <br>
        <label></label> <br>
        <label>DESCUENTO:</label> <br>
        <label></label> <br>
        <label>NETO:</label> <br>
        <label></label> <br>
        <label>IEPS:</label> <br>
        <label></label> <br>
        <label>IVA:</label> <br>
        <label></label> <br>
        <label>TOTAL:</label> <br>
        <label></label> <br>
      </article>

      <div>
        <div class="form-check">
          <label for="facturar" class="form-check-label">
            <input type="checkbox"class="form-check-input">Facturar Orden
          </label>
        </div>
        <div class="form-check">
          <label for="entrega" class="form-check-label">
            <input type="checkbox"class="form-check-input">Entrega a Domicilio
          </label>
        </div>

      </div>
    </div>
    <br>
    <input type="submit" value="Confirmar" class="btn btn-success">
    <input type="submit" value="Cancelar" class="btn btn-danger">
  </section>
  

  <script src="js/popper.min.js"></script>
  <script src="js/jquery-3.3.1.slim.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
include_once("footer.html");
?>
