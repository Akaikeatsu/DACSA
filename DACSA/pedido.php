<?php 
  include_once("modelo\iniciar_sesion_db.php");
  include_once("modelo\orden.php");
  include_once("modelo\orden_producto.php");
  session_start();
  $sErr = "";
  $Usuario=new Usuario();
  $Orden = new Orden();
  $Producto = new Orden_Producto();
  $Operacion = "";
  $Factura = "";
  $Envio = "";
  $arrayProductos = null;
 
  if (isset($_SESSION["usu"])){
    $Usuario = $_SESSION["usu"];
      if (isset($_POST["folio"]) && !empty($_POST["folio"]) && isset($_POST["operation"]) && !empty($_POST["operation"])) {
        $Orden->setFolio($_POST["folio"]);
        $Operacion = $_POST["operation"];
      }
  }
  else{
    $sErr = "Debe estar firmado";
  }

 
  if ($Operacion == 'v') {
    $Orden->search();
    $Orden->find_client_name();
    $Orden->find_info_client();
    $arrayProductos = $Orden->search_products();
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
      <section class="container-fluid ">
        <label class="pedido"><b>Folio:&nbsp;</b></label><label class="pedido"><?php echo $Orden->getFolio(); ?></label><br>
        <label><b>Nombre:&nbsp;</b></label> <label><?php echo $Orden->getName(); ?></label> <br>
        <label><b>RFC:&nbsp;</b></label> <label><?php echo $Orden->getRFC(); ?></label> <br>
        <label><b>Domicilio Fiscal:&nbsp;</b></label> <label><?php echo $Orden->getDomicilio();; ?></label> <br>
        <article class="row">
          <div class="col">
            <table class="table table-bordered table-hover">
              <thead class="">
                <tr>
                  <td><b>Cantidad</b></td>
                  <td><b>Unidad de Medida</b></td>
                  <td><b>Producto</b></td>
                  <td><b>C&oacute;digo</b></td>
                  <td><b>Precio Unitario</b></td>
                  <td><b>Importe de Descuento<br>(xCant)</b></td>
                  <td><b>IEPS<br>(xCant)</b></td>
                  <td><b>IVA<br>(xCant)</b></td>
                  <td><b>Total</b></td>
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
          <article class="col-xs-2 col-sm25 col-md-2 col-lg-2 col-xl-2">
            <label><b>SUBTOTAL:&nbsp;</b></label>       <label>$ <?php echo $Orden->getSubtotal(); ?></label> <br>
            <label><b>DESCUENTO:&nbsp;</b></label>      <label>$ <?php echo $Orden->getDescuento(); ?></label> <br>
            <label><b>NETO:&nbsp;</b></label>           <label>$ <?php echo $Orden->getNeto(); ?></label> <br>
            <label><b>IEPS:&nbsp;</b></label>           <label>$ <?php echo $Orden->getIEPS(); ?></label> <br>
            <label><b>IVA:&nbsp;</b></label>            <label>$ <?php echo $Orden->getIVA(); ?></label> <br>
            <label><b>TOTAL:&nbsp;</b></label>          <label>$ <?php echo $Orden->getMonto() ?></label> <br>
          </article>

          <div>
            <?php if ($Orden->getFactura() == "true") {
              $Factura = "Sí";
            }else{
              $Factura = "No";
            } ?>
            <label><b>Facturar Orden:&nbsp;</b></label>         <label><?php echo $Factura; ?></label> <br>
            <?php if ($Orden->getEnvio() == "true") {
              $Envio = "Sí";
            }else{
              $Envio = "No";
            } ?>
            <label><b>Entrega a Domicilio:&nbsp;</b></label>    <label><?php echo $Envio ?></label> <br>
          </div>
        </div>
        
      </section>

        <div class="col align-self-end">
          <form action="lista_pedidos.php">
            <input type="submit" value="Volver" class="btn btn-success">
          </form>
        </div>
      
      <script src="js/popper.min.js"></script>
      <script src="js/jquery-3.3.1.slim.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
    </body>
    </html>

<?php  include_once("footer.html");
  }elseif ($Operacion == 'e') {
    $Orden->delete();
    echo "Eliminar papu :v";
    header("Location: lista_pedidos.php");
  }else{
    header("Location: lista_pedidos.php");
  }
?>
