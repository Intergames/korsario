<?php session_start(); 
  require_once('../Connections/conexion.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../css/MainStyle.css" rel="stylesheet" type="text/css" />
    <link href="../menu/menu_style.css" rel="stylesheet" type="text/css" />
    <link href="../assets/tiptip/tipTip.css" rel="stylesheet" type="text/css" />
    <!-- Inicializacion JQuery -->
    <link type="text/css" href="../jquery/css/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
    <script type="text/javascript" src="../jquery/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="../jquery/js/jquery-ui-1.8.20.custom.min.js"></script>
    <script type="text/javascript" src="../assets/tiptip/jquery.tipTip.js"></script>
    <!-- Finalizacion JQuery -->
    <script type="text/javascript">
    $(function(){
        $(".CajaTexto").tipTip({maxWidth: "auto", defaultPosition:"right"});
    });
    </script>
    <?php
    if (!function_exists("GetSQLValueString")) {
        function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
        {
          if (PHP_VERSION < 6) {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
          }
          $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
          switch ($theType) {
            case "text":
              $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL"; 
              break;    
            case "long":
            case "int":
              $theValue = ($theValue != "") ? intval($theValue) : "NULL";
              break;
            case "double":
              $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
              break;
            case "date":
              $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
              break;
            case "defined":
              $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
              break;
          }
          return $theValue;
        }
    }
    ?>
    <?php
    $Folio = $_POST['FolioPedido'];
    mysql_select_db($database_conexion, $conexion);
    $query_pedido = "SELECT * FROM pedidos WHERE Folio = '$Folio' ";
    $pedido = mysql_query($query_pedido, $conexion) or die(mysql_error());
    $detalle_pedido = mysql_fetch_assoc($pedido);   
    
    $FolioCliente = $detalle_pedido['IdCliente'];
    $query_cliente = "SELECT * FROM clientes WHERE Folio = '$FolioCliente'";
    $cliente = mysql_query($query_cliente, $conexion) or die(mysql_error());
    $detalle_cliente = mysql_fetch_assoc($cliente);
    ?>
<title>Detalle de Sucursal - Bardahl</title>
</head>
<body>
    <div id="Cabecera">
        <div id="ContenedorCabeceraSuperior">
           <img src="../assets/logo.png" />
        </div><!-- Fin ContenedorCabeceraSuperior -->
        <div id="FondoMenu">
           
        </div><!-- Fin FondoMenu -->
    </div><!-- Fin Cabecera --> 
    <form name="form1" method="post" >
        <input type="hidden" name="Verificar" value="Verificar" id="Verificar"/>
        <div id="MainBody">
        <div id="TituloFormulario"><p align="center">Detalle del pedido: <?php echo $Folio; ?></p></div>
           <div id="FondoFormularios">
            <center>
              <table border="0">
                <tr>
                  <td>Nombre del cliente:</td>
                    <td><?php echo $detalle_cliente['Nombre']; ?></td>
                </tr>
                <tr>
                  <td>Nombre del vendedor:</td>
                    <td><?php echo $detalle_pedido['NombreUsuario']; ?></td>
                </tr> 
                <tr>
                  <td>Fecha del pedido:</td>
                    <td><?php echo $detalle_pedido['TimeStamp']; ?></td>
                </tr>                
              </table>
              <br>
              <br>
              <?php 
                echo "
                <table border='0' width = '960px' class='normal'>";
                echo "
                <tr>
                    <th scope='col' width='100'>Imágen</td>
                    <th scope='col' width='100'>Descripción</td>
                    <th scope='col' width='100'>Cantidad</td>
                    <th scope='col' width='100'>Precio Venta</td>
                    <th scope='col' width='100'>Sub Total</td>
                </tr>";
                $FolioCliente = $detalle_pedido['IdCliente'];
                $SubTotal = 0;
                // $query_pedido = "SELECT * FROM pedidos WHERE Folio = '$Folio'";
                $query_pedido = "SELECT DISTINCT pedidos.Id, pedidos.Cantidad, productos.PrecioVenta, pedidos.fecha, productos.Descripcion, productos.RutaImagen FROM pedidos JOIN productos ON pedidos.id = productos.IdProducto WHERE Folio = '$Folio'";
                $result_pedido = mysql_query($query_pedido, $conexion) or die(mysql_error());
                while($row = mysql_fetch_array($result_pedido)) { ?>
                   <tr>
                   <?php $SubTotal = $SubTotal + ($row['Cantidad'] * $row['PrecioVenta']);?>
                    <td align="center"><img src=http://www.uruapanmovil.com/ventas/assets/img/<?php echo $row['RutaImagen']; ?> width="15%"></td>
                    <td align="center"><?php echo $row['Descripcion']; ?></td>
                    <td align="center"><?php echo $row['Cantidad']; ?></td>
                    <td align="center"><?php echo "$".$row['PrecioVenta']; ?></td>
                    <td align="center"><?php echo "$".$row['Cantidad'] * $row['PrecioVenta']; ?></td>
                 </tr>
              <?php
              }//Fin de while($row = mysql_fetch_array($result))
              echo "</table>"; 
              $IVA = $SubTotal * .16;
              $Total = $SubTotal + $IVA;
              ?>
            </center>
            <br>
            <br>
            <div style="float:right;">
              <table border='0' width = '160px'>
                <tr><td>SubTotal:</td><td><?php echo "$".$SubTotal; ?></td></tr>  
                <tr><td>IVA: </td><td><?php echo "$".$IVA; ?></td></tr>  
                <tr><td><h2>Total: </h2></td><td><h2><?php echo "$".$Total; ?></h2></td></tr>  
              </table>
            </div>
          </div><!-- Fin FondoFormularios -->
        </div><!-- Fin MainBody -->
    </form>
    <div id="footer">
	<?php include("../assets/Footer.php"); ?>
    </div><!-- Fin footer -->
</body>
</html>