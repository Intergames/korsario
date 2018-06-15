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
    mysql_select_db($database_conexion, $conexion);
    $query_sucursales = "SELECT IdSucursal, NombreSucursal FROM sucursales ORDER BY IdSucursal ASC";
    $sucursales = mysql_query($query_sucursales, $conexion) or die(mysql_error());
    $row_sucursales = mysql_fetch_assoc($sucursales);
    ?>
    <?php
    $IdSucursal = $_GET['recordID'];
    echo "Este es el id de la sucursal: ".$IdSucursal;
    $query_sucursal = "SELECT * FROM sucursales WHERE IdSucursal = '$IdSucursal'";
    $sucursal = mysql_query($query_sucursal, $conexion) or die(mysql_error());
    $detalle_sucursal = mysql_fetch_assoc($sucursal);
    
    ?>
<title>Detalle de Sucursal - Bardahl</title>
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
        <div id="TituloFormulario"><p align="center">Detalle del producto: <?php echo $detalle_producto['Descripcion']; ?></p></div>
          <div id="FondoFormularios">
            <center>
              <table border="0">
                <tr>
                  <td>Sucursal:</td>
                    <td><?php echo $detalle_sucursal['NombreSucursal']; ?></td>
                </tr>
                <tr>
                  <td>Direcci&oacute;n:</td>
                    <td><?php echo $detalle_sucursal['Direccion']; ?></td>
                </tr>
                <tr>
                  <td>Codigo:</td>
                  <td><?php echo $detalle_sucursal['Codigo']; ?></td>
                </tr>                
                <tr>
                  <td>Cantidad:</td>
                  <td><?php echo $detalle_sucursal['Cantidad']; ?></td>
                </tr>
                <tr>
                  <td>Descripci&oacute;n:</td>
                  <td><?php echo $detalle_sucursal['Descripcion']; ?></td>
                </tr>
                <tr>
                  <td>Marca:</td>
                  <td><?php echo $detalle_sucursal['Marca']; ?></td>
                </tr>
                <tr>
                  <td>Precio de compra:</td>
                  <td><?php echo $detalle_sucursal['PrecioCompra']; ?></td>
                </tr>
                <tr>
                  <td>Precio de venta:</td>
                  <td><?php echo $detalle_sucursal['PrecioVenta']; ?></td>
                </tr>
                <tr>
                  <td>Precio de venta especial:</td>
                  <td><?php echo $detalle_sucursal['PrecioVentaEspecial']; ?></td>
                </tr>
                <tr>
                  <td>Inventario Bajo:</td>
                  <td><?php echo $detalle_sucursal['InventarioBajo']; ?></td>
                </tr>
                <tr>
                  <td>Medida:</td>
                  <td><?php echo $detalle_sucursal['Medida']; ?></td>
                </tr>
                <tr>
                  <td>Unidad de Medida:</td>
                  <td><?php echo $detalle_sucursal['UnidadMedida']; ?></td>
                </tr>
                <tr>
                  <td>Comentario:</td>
                  <td><?php echo $detalle_sucursal['Comentario']; ?></td>
                </tr>
                <tr>
                  <td colspan="2" align="center"><a href="./buscarProducto.php">Regresar</a></td>
                </tr>
              </table>
            </center>
          </div><!-- Fin FondoFormularios -->
        </div><!-- Fin MainBody -->
    </form>
    <div id="footer">
	<?php include("../assets/Footer.php"); ?>
    </div><!-- Fin footer -->
</body>
</html>