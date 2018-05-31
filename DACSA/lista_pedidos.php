<?php 
  include_once("modelo\iniciar_sesion_db.php");
  include_once("modelo\orden.php");
  session_start();
  $sErr = "";
  $Usuario=new Usuario();
  $arrayOrden = null;
  $Orden = new Orden();
 
  if (isset($_SESSION["usu"])){
    $Usuario = $_SESSION["usu"];
    try {
      $arrayOrden = $Orden->search_all();
    } catch (Exception $e) {
      error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
      $sErr = "Error en base de datos, comunicarse con el administrador";
    }
  }
  else
    $sErr = "Debe estar firmado";
 ?>

<?php  include_once("menu.php");  ?><br><br>
<?php  include_once("header.html"); ?><br>

<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
</head>
<body>

  <section class="container-fluid ">

    <center><h3>Lista de Pedidos</h3></center><br>

    <article class="row">
      <div class="col">
        <form name="order_table" method="post" action="pedido.php">
          <input type="hidden" name="folio">
          <input type="hidden" name="operation">

          <table class="table table-bordered table-hover">
            <thead class="">
              <tr>
                <td>Folio</td>
                <td>Cliente</td>
                <td>Direcci&oacute;n</td>
                <td>Acci&oacute;n</td>
              </tr>
            </thead>
<?php 
            if($arrayOrden != null){
              foreach ($arrayOrden as $Orden) {
                $Orden->find_client_name();
                $Orden->find_info_client();
?>
                <tr>
                  <td><?php echo $Orden->getFolio(); ?></td>
                  <td><?php echo $Orden->getName(); ?></td>
                  <td><?php echo $Orden->getDomicilio(); ?></td>
                  <td>
                    <input type="submit" value="Ver Pedido" class="btn btn-success" 
                    onClick="folio.value=<?php echo $Orden->getFolio(); ?>; operation.value='v'">
                    <input type="submit" value="Elminar Pedido" class="btn btn-danger" 
                    onClick="folio.value=<?php echo $Orden->getFolio(); ?>; operation.value='e'">
                  </td>
                </tr>
<?php
              }
            }
 ?>
          </table>
        </form>
        </div>
      </article>
    <!--
    <br>
    <input type="submit" value="Ver Pedido" class="btn btn-success">
    <input type="submit" value="Elminar Pedido" class="btn btn-danger">
    -->
  </section>


  <script src="js/popper.min.js"></script>
  <script src="js/jquery-3.3.1.slim.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
include_once("footer.html");
?>
