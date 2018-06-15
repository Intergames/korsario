<?php session_start(); 
require_once('../Connections/conexion.php');
require_once('../assets/logs.php');
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
    $Folio = $_GET['recordID'];
    mysql_select_db($database_conexion, $conexion);
    $query_pedido = "SELECT * FROM pedidos WHERE Folio = '$Folio' ";
    $pedido = mysql_query($query_pedido, $conexion) or die(mysql_error());
    $detalle_pedido = mysql_fetch_assoc($pedido);    

    $FolioCliente = $detalle_pedido['IdCliente'];
    $query_cliente = "SELECT * FROM clientes WHERE Folio = '$FolioCliente'";
    $cliente = mysql_query($query_cliente, $conexion) or die(mysql_error());
    $detalle_cliente = mysql_fetch_assoc($cliente);


    ?>
<title>Detalle de pedido - Bardahl</title>
</head>
<body>
    <div id="Cabecera">
        <div id="ContenedorCabeceraSuperior">
           <img src="../assets/logo.png" />
        </div><!-- Fin ContenedorCabeceraSuperior -->
        <div id="FondoMenu">
           <div id="ContenedorMenu">	
            <?php include("../menu/menu.php"); ?>
           </div> <!-- Fin ContenedorMenu -->
        </div><!-- Fin FondoMenu -->
    </div><!-- Fin Cabecera --> 
    <form name="form1" method="post" action="procesarNuevoUsuario.php">
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
                <table border='0' width = '940px' class='normal'>";
                echo "
                <tr>
                    <th scope='col' width='40'>Codigo</td>
                    <th scope='col' width='40'>Imágen</td>
                    <th scope='col' width='100'>Descripción</td>
                    <th scope='col' width='40'>Cantidad</td>
                    <th scope='col' width='40'>Precio</td>
                    <th scope='col' width='40'>Neto</td>
                    <th scope='col' width='60'>Descuento1</td>
                    <th scope='col' width='60'>Descuento2</td>
                    <th scope='col' width='60'>IVA</td>
                    <th scope='col' width='60'>Total</td>
                </tr>";
                $FolioCliente = $detalle_pedido['IdCliente'];
                $SubTotal = 0;
                $SumantoriaDescuento = 0;
                $SumantoriaDescuento2 = 0;
                $SumantoriaIVA = 0;
                $SumantoriaTotal = 0;
                $query_pedido = "SELECT detalle_pedido.IdProducto, detalle_pedido.Cantidad, detalle_pedido.Precio, detalle_pedido.Descuento1, detalle_pedido.Descuento2, detalle_pedido.Neto, detalle_pedido.IVA ,detalle_pedido.Total, productos.RutaImagen, productos.Descripcion, productos.Codigo FROM detalle_pedido JOIN productos ON detalle_pedido.IdProducto = productos.IdProducto WHERE detalle_pedido.Folio = '$Folio' ORDER By detalle_pedido.Cantidad DESC";
                $result_pedido = mysql_query($query_pedido, $conexion) or die(mysql_error());
                while($row = mysql_fetch_array($result_pedido)) { ?>
                   <tr>
                   <?php 
                    $SubTotal = $SubTotal + $row['Neto'];
                    $SumatoriaDescuento = $SumatoriaDescuento + $row['Descuento1'];
                    $SumatoriaDescuento2 = $SumatoriaDescuento2 + $row['Descuento2'];
                    $SumatoriaIVA = $SumatoriaIVA + $row['IVA'];
                    $SumatoriaTotal = $SumatoriaTotal + $row['Total'];
                   ?>
                    <td align="left"><?php echo $row['Codigo']; ?></td> <!-- Descripcion -->
                    <td align="center"><img src=http://www.uruapanmovil.com/ventas/assets/img/<?php echo $row['RutaImagen']; ?> height="15%"></td> <!-- Imagen -->
                    <td align="left"><?php echo $row['Descripcion']; ?></td> <!-- Descripcion -->
                    <td align="right"><?php echo $row['Cantidad']; ?></td> <!-- Cantidad -->
                    <td align="right"><?php echo "$".number_format(round($row['Precio'], 2, PHP_ROUND_HALF_DOWN),2,".",","); ?></td> <!-- Precio -->
                    <td align="right"><?php echo "$".number_format(round($row['Cantidad'] * $row['Precio'], 2, PHP_ROUND_HALF_DOWN),2,".",","); ?></td> <!-- Neto -->
                    <td align="right"><?php echo "$".number_format(round($row['Descuento1'], 2, PHP_ROUND_HALF_DOWN),2,".",","); ?></td> <!-- Descuento1 -->
                    <td align="right"><?php echo "$".number_format(round($row['Descuento2'], 2, PHP_ROUND_HALF_DOWN),2,".",","); ?></td> <!-- Descuento2 -->
                    <td align="right"><?php echo "$".number_format(round($row['IVA'], 2, PHP_ROUND_HALF_DOWN),2,".",","); ?></td>
                    <td align="right"><?php echo "$".number_format(round($row['Total'], 2, PHP_ROUND_HALF_DOWN),2,".",","); ?></td>
                 </tr>
              <?php
              }//Fin de while($row = mysql_fetch_array($result))
              echo "</table>"; 
              $Total = $SubTotal + $IVA;
              $Descuentos = $SumatoriaDescuento + $SumatoriaDescuento2;
              ?>
            </center>
            <br>
            Comentario:  <?php echo $detalle_pedido['Comentario'];  ?>
            <br>
            <div style="float:right;">
              <table border='0' width = '160px'>
                <tr><td>SubTotal:</td><td align="right"><?php echo "$".number_format(round($SubTotal, 2, PHP_ROUND_HALF_DOWN),2,".",","); ?></td></tr>  
                <tr><td>Total descuentos: </td><td align="right"><?php echo "$".number_format(round($Descuentos, 2, PHP_ROUND_HALF_DOWN),2,".",","); ?></td></tr>  
                <tr><td>IVA: </td><td align="right"><?php echo "$".number_format(round($SumatoriaIVA, 2, PHP_ROUND_HALF_DOWN),2,".",","); ?></td></tr>  
                <tr><td><h2>Total: </h2></td><td align="right"><h2><?php echo "$".number_format(round($SumatoriaTotal,2,PHP_ROUND_HALF_EVEN), 2, ".", ","); ?></h2></td></tr>  
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