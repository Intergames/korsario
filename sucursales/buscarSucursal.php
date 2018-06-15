<?php session_start();
    require_once('../Connections/conexion.php'); 
    if ($_SESSION["TipoUsuarioGlobal"] =='root'):
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
    <script tyoe="text/javascript" src="../js/ajaxBuscarSucursales.js"></script> 
    <script type="text/javascript" src="../assets/tiptip/jquery.tipTip.js"></script>
    <title>B&uacute;squeda de sucursales - Bardahl</title>
</head>
<body onload="cargaXMLSucursales('rutinaBuscarSucursales.php','1')">
<div id="Cabecera">
    <div id="ContenedorCabeceraSuperior">
        <img src="../assets/logo.png" />
    </div> 		 
    <div id="FondoMenu">
        <div id="ContenedorMenu">	
            <?php include("../menu/menu.php"); ?> 
        </div> <!-- Fin ContenedorMenu -->
    </div> <!-- Fin FondoMenu -->
</div><!-- Fin Cabecera -->
<div id="MainBody">
    <div id="TituloFormulario">
      <p align="center">B&uacute;squeda de sucursales.</p>
    </div><!-- Fin TituloFormulario -->
    <div id="FondoFormularios">
    <p align="center"> </p>
    <form id="FrmBusquedaGeneral" action="imprimirSucursales.php" method="post" enctype="multipart/form-data" target="_blank">
    <table width="880" border="0"> 
      <tr>
        <td width="786">B&uacute;squeda por: Nombre:
        <input type="text" name="TxtBusqueda" id="TxtBusqueda" class="TxtBusqueda" value='<?php echo $busqueda; ?>' />
        </td>
        <td width="84"><input type="button" name="BtnBuscar" id="BtnBuscar" value="Buscar" onclick="cargaXMLProductos('rutinaBuscarSucursales.php','1')" /></td>
      </tr>
    </table>                 
    <table width="881">
      <tr>
          <td width="224">Mostrar
            <select name="Cantidad" id="Cantidad" class="Cantidad" onchange="cargaXMLProductos('rutinaBuscarSucursales.php','1')">
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="15">15</option>
              <option value="20">20</option>
          	</select> 
            resultados por p&aacute;gina
          </td>
          <td width="90">:</td>
          <td width="106">Ordenar Por:</td>
          <td width="77"><select name="LstOrdenar" id="LstOrdenar" class="LstOrdenar" onchange="cargaXMLProductos('rutinaBuscarSucursales.php','1')">
            <option value="NombreSucursal">Nombre</option>
            <option value="Direccion">Direccion</option>
            <option value="Colonia">Colonia</option>
            <option value="CodigoPostal">Codigo Postal</option>
            <option value="Ciudad">Ciudad</option>
            <option value="Estado">Estado</option>
          </select></td>
          <td width="134">&nbsp;</td>
          <td width="100">Tipo:</td>
          <td width="118"><select name="LstTipo" id="LstTipo" class="LstTipo" onchange="cargaXMLProductos('rutinaBuscarSucursales.php','1')"> ajax<option value="ASC">Ascendente</option>
            <option value="DESC">Descendente</option>
          </select></td>
      </tr>	
    </table>
    </form>
     <div id="FondoFormulariosDashboard">
	<div id="ListadoSucursales">           
       	
       </div><!-- Fin ListadoDashboard -->
     </div> <!-- Fin FondoFormulariosDashboard -->    
    </div>
</div><!-- Fin MainBody -->
<div id="footer">
  <?php include("../assets/footer.php"); ?>
</div> <!-- Fin footer-->
</body>
<?php
mysql_free_result($sucursales);
?>
<?php
else:
echo "<p align=center><font color=#FF0000 size=4 face=Verdana, Arial, Helvetica, sans-serif>&iexcl;No se tienen los privilegios necesarios para entrar a este m&oacute;duelo! </font></p>
<p align=center><font color=#000000 size=4>Establezca un nombre de usuario y contrase&ntilde;a
  para visualizar los datos.<p align=center>Si ha iniciado sesión pida al administrador del sitio que le otorga los privilegios necesarios</p></font></p>";
endif; ?>