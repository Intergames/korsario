<?php 
    require_once('../Connections/conexion.php');
?>        
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <!-- Hace que los acentos se vean apropiadamente -->
    <link href="../css/MainStyle.css" rel="stylesheet" type="text/css" />
    <link href="../menu/menu_style.css" rel="stylesheet" type="text/css" />
    <!-- Inicializacion JQuery -->
    <link type="text/css" href="../jquery/css/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
    <script type="text/javascript" src="../jquery/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="../jquery/js/jquery-ui-1.8.20.custom.min.js"></script>    
    <!-- Finalizacion JQuery -->
    <link href="../assets/tiptip/tipTip.css" rel="stylesheet" type="text/css" />
    <link href="../css/Paginacion.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../assets/tiptip/jquery.tipTip.js"></script>
    <title>B&uacute;squeda de Clientes - Bardahl</title>
</head>
<body >
<div id="Cabecera">
    <div id="ContenedorCabeceraSuperior">
        <img src="../assets/logo.png" />
    </div> 		 
    <div id="FondoMenu">
        <div id="ContenedorMenu">	
            <!-- <?php include("../menu/menu.php"); ?>  -->
        </div> <!-- Fin ContenedorMenu -->
    </div> <!-- Fin FondoMenu -->
</div><!-- Fin Cabecera -->
<div id="MainBody">
    <div id="TituloFormulario">
      <p align="center">Consulta de pedido.</p>
    </div><!-- Fin TituloFormulario -->
    <div id="FondoFormularios">
    <p align="center"> </p>
    <form id="FrmBusquedaGeneral" action="procesarConsultaPedido.php" method="post" enctype="multipart/form-data" target="_blank">
    <center>
      <table width="360" border="0"> 
        <tr>
          <td>Nombre</td>
          <td><input type="text" class="NombreCliente"></td>
        </tr>
        <tr>
          <td>Folio: </td>
          <td><input type="text" name="FolioPedido" id="FolioPedido" class="FolioPedido"></td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="center"><input type="submit" value="Mostar pedido"></td>
        </tr>
      </table>
    </center>                 
    <input type="hidden" name="TxtFechaInicialHidden" class="TxtFechaInicialHidden" id="TxtFechaInicialHidden" />
    <input type="hidden" name="TxtFechaFinalHidden" class="TxtFechaFinalHidden" id="TxtFechaFinalHidden" />
    </form>
</div><!-- Fin MainBody -->
</div> <!-- Fin footer-->
</body>