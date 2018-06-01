<?php 
  include_once("modelo\iniciar_sesion_db.php");
  include_once("modelo\orden.php");
  include_once("modelo\orden_producto.php");
  session_start();
  $sErr = "";
  $Usuario=new Usuario();
  $Orden = new Orden();
  $Producto = new Orden_Producto();
  $arrayProductos = null;
  $Subtotal=0;
  $Descuento=0;
  $Neto=0;
  $IEPS=0;
  $IVA = 0;
  $TOTAL=0;
 
  if (isset($_SESSION["usu"])){
    $Usuario = $_SESSION["usu"];
    if (isset($_SESSION["orden"]) && $_SESSION["orden"] != null) {
      $arrayProductos = $_SESSION["orden"]->search_products();
      $_SESSION["orden"]->claculate_values();
      $_SESSION["orden"]->calculate_subtotal();
      $Subtotal = $_SESSION["orden"]->getSubtotal();
      $Descuento = $_SESSION["orden"]->getDescuento();
      $Neto = $Subtotal - $Descuento;
      $_SESSION["orden"]->setNeto($Neto);
      $Neto = $_SESSION["orden"]->getNeto();
      $IEPS = $_SESSION["orden"]->getIEPS();
      $IVA = $_SESSION["orden"]->getIVA();
      $TOTAL = $_SESSION["orden"]->getMonto();
    }
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
<?php  
              if($arrayProductos != null){
                foreach ($arrayProductos as $Producto) {
?>
                  <tr>
                    <td><?php echo $Producto->getCantidad(); ?></td>
                    <td><?php echo $Producto->getUnidad_Medida(); ?></td>
                    <td><?php echo $Producto->getNombre_Producto(); ?></td>
                    <td><?php echo $Producto->getCodigo_Producto(); ?></td>
                    <td><?php echo $Producto->getPrecio_U(); ?></td>
                    <td><?php echo $Producto->getDesc_Cant(); ?></td>
                    <td><?php echo $Producto->getIEPS_Cant(); ?></td>
                    <td><?php echo $Producto->getIVA_Cant(); ?></td>
                    <td><?php echo $Producto->getTotal(); ?></td>
                  </tr>
<?php 
                }
              }
 ?>

        </table>
      </div>
    </article>
    <br><br><br>

    <div class="row">

      <article class="col-xs-4 col-sm-5 col-md-5 col-lg-3 col-xl-3">
        <label>SUBTOTAL:&nbsp;</label>            <label> <?php echo $Subtotal ?> </label> <br>
        <label>DESCUENTO:&nbsp;</label>           <label> <?php echo $Descuento ?> </label> <br>
        <label>NETO:&nbsp;</label>                <label> <?php echo $Neto; ?> </label> <br>
        <label>IEPS:&nbsp;</label>                <label> <?php echo $IEPS ?> </label> <br>
        <label>IVA:&nbsp;</label>                 <label> <?php echo $IVA ?> </label> <br>
        <label>TOTAL:&nbsp;</label>               <label> <?php echo $TOTAL ?> </label> <br>
      </article>

      <form name="order" method="post" action="realizarpedido_cont.php">
        <input type="hidden" name="operation">
        <div>
          <div class="form-check">
            <label for="facturar" class="form-check-label">
              <input type="checkbox" name="check1" class="form-check-input">Facturar Orden
            </label>
          </div>

          <div class="form-check">
            <label for="entrega" class="form-check-label">
              <input type="checkbox" name="check2" class="form-check-input">Entrega a Domicilio
            </label>
          </div>
        </div>
        <br>
        <input type="submit" value="Confirmar" class="btn btn-success" onclick="operation.value='confirm'">
        <input type="submit" value="Cancelar" class="btn btn-danger" onclick="operation.value='cancel'">
      </form>

  </section>
  

  <script src="js/popper.min.js"></script>
  <script src="js/jquery-3.3.1.slim.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
include_once("footer.html");
?>
